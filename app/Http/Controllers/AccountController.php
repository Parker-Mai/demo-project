<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\Accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{

    public function list(Request $request,Accounts $account){

        $this->authorize('list', $account);

        $datas = Accounts::latest()->filter([$request->keyword])->paginate(5);

        return view('backend.modules.accounts.list_table',[
            'datas' => $datas,
            'keyword' => $request->keyword,
        ]);
    }

    public function create_page(Accounts $account){

        $this->authorize('create', $account);

        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $columns = Schema::getColumnListing('lm_accounts'); //抓table欄位
            
            foreach($columns as $field){
                $out[$field] = "";
            }
        }

        $out['action'] = 'create';

        //抓所有角色
        $roles = Roles::all();
        $out['role_option'] = $roles;

        $out['user_role_id'] = '';

        return view('backend.modules.accounts.edit_form',$out);
    }

    public function create(Request $request){

        $input_data = $request->all();

        $validator = Validator::make($input_data,[
            'account_name'      => 'required',
            'account_password'  => 'required',
            'account_realname'  => 'required',
            'account_role'      => 'required',
            'account_email'     => 'email'
        ], $messages = [
            'required'  => ':attribute 欄位不得為空值',
            'email'     => ':attribute 格式錯誤',
        ],[
            'account_name'      => '系統帳號',
            'account_password'  => '系統密碼',
            'account_realname'  => '真實姓名',
            'account_role'      => '系統角色',
            'account_email'     => '電子信箱'
        ]);

        if ($validator->fails()) {
            return redirect('/backend/accounts/create_page')
                        ->withErrors($validator)
                        ->withInput($input_data);
        }


        if($request->hasfile('account_photo')){
            $input_data['account_photo'] = $request->file('account_photo')->store('account_photo','public');
        }

        Accounts::create($input_data);
        
        return redirect('/backend/accounts');
    }

    public function update_page(Accounts $account){

        $this->authorize('update', $account);

        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $out = $account;
            
        }
        
        $out['action'] = 'update/'.$account['id'];

        //抓所有角色
        $roles = Roles::all();
        $out['role_option'] = $roles;

        $out['user_role_id'] = $account['account_role'];

        return view('backend.modules.accounts.edit_form',$out);
    }

    public function update(Request $request,Accounts $account){

        $input_data = $request->all();

        if(empty($input_data['account_password'])){
            unset($input_data['account_password']);
        }

        $validator = Validator::make($input_data,[
            'account_name'      => 'required',
            'account_realname'  => 'required',
            'account_email'     => 'email'
        ], $messages = [
            'required'  => ':attribute 欄位不得為空值',
            'email'     => ':attribute 格式錯誤',
        ],[
            'account_name'      => '系統帳號',
            'account_realname'  => '真實姓名',
            'account_email'     => '電子信箱'
        ]);

        $validator_fails = $validator->fails();

        if(Auth::guard('admin')->user()->account_role == 1){
            
            if(empty($input_data['account_role'])){
                $validator->errors()->add(
                    'account_role', '系統角色 不得為空值'
                );

                $validator_fails = true;
            }
        }

        if ($validator_fails) {
            return redirect('/backend/accounts/update_page/'.$account['id'])
                        ->withErrors($validator)
                        ->withInput($input_data);
        }

        if($request->hasfile('account_photo')){
            $input_data['account_photo'] = $request->file('account_photo')->store('account_photo','public');
        }

        $account->update($input_data);
        
        return redirect('/backend/accounts');
    }

    public function delete(Accounts $account){

        $this->authorize('update', $account);

        if(!$account->trashed()){
            $account->delete();
        }
        
        return redirect('/backend/accounts');
    }
    

    public function disable(Request $request){
        
        $data = Accounts::find($request->id);

        if($data->account_disabled == '停用'){
            $data->account_disabled = 0;    
        }else{
            $data->account_disabled = 1;
        }

        $chk = $data->save();

        $out = ['status' => 'NO']; 
        if($chk){
           $out = ['status' => 'YES','val' => $data->account_disabled]; 
        }

        return json_encode($out,JSON_UNESCAPED_UNICODE);

    }
}
