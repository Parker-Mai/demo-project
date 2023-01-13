<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use App\Models\Orders;
use App\Models\Members;
use App\Models\Products;
use Illuminate\Support\Arr;
use App\Models\ProductCarts;
use Illuminate\Http\Request;
use App\Models\MemberAddresses;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{

    public function list(Request $request,Members $member){

        $this->authorize('list', $member);

        $datas = Members::latest()->paginate(5);

        return view('backend.modules.members.list_table',[
            'datas' => $datas,
            'keyword' => $request->keyword,
        ]);
    }

    public function create_page(Members $member){

        $this->authorize('create', $member);

        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $columns = Schema::getColumnListing('lm_members'); //抓table欄位
            
            foreach($columns as $field){
                $out[$field] = "";
            }

            $out['member_addresses'] = [];
        }


        $out['action'] = 'create';

        

        return view('backend.modules.members.edit_form',$out);
    }

    public function create(Request $request){

        $input_data = $request->all();
        
        // dd($input_data);

        $validator = Validator::make($input_data,[
            'member_name'          => 'required',
            'member_password'      => 'required',
            'member_realname'      => 'required',
            'member_gender'        => 'required',
            'member_email'         => 'required|email|unique:lm_members',
            'member_phone'         => 'required',
        ], $messages = [
            'required'  => ':attribute 欄位不得為空值',
            'email'     => ':attribute 格式錯誤',
        ],[
            'member_name'        => '帳號',
            'member_password'    => '密碼',
            'member_realname'    => '真實姓名',
            'member_gender'      => '性別',
            'member_email'       => '信箱',
            'member_phone'       => '聯絡電話',
        ]);

        if ($validator->fails()) {
            return redirect('/backend/members/create_page')
                        ->withErrors($validator)
                        ->withInput($input_data);
        }

        $save_controller = true;
        DB::beginTransaction();

        $save_member = Members::create($input_data);

        if(!$save_member) $save_controller = false;
        
        if(isset($input_data['member_address_counter'])){

            for($i=0;$i<count($input_data['member_address_counter']);$i++){
                
                if(empty($input_data['member_addresses']['zipcode'][$i]) 
                || empty($input_data['member_addresses']['city'][$i]) 
                || empty($input_data['member_addresses']['area'][$i]) 
                || empty($input_data['member_addresses']['address'][$i])
                || empty($input_data['member_addresses']['addressee'][$i])){

                    continue;
                }

                $save_member_address = MemberAddresses::create([
                    'member_id'     => $save_member->id,
                    'zipcode'       => $input_data['member_addresses']['zipcode'][$i],
                    'city'          => $input_data['member_addresses']['city'][$i],
                    'area'          => $input_data['member_addresses']['area'][$i],
                    'address'       => $input_data['member_addresses']['address'][$i],
                    'addressee'     => $input_data['member_addresses']['addressee'][$i],
                ]);
                
                if(!$save_member_address) $save_controller = false;
            }

        }

        if(!$save_controller){
            DB::rollBack();
        }else{
            DB::commit();
        }
        
        return redirect('/backend/members');
    }

    public function update_page(Members $member){

        $this->authorize('update', $member);

        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $out = $member;

            //抓會員的地址

            $member_addresses_model = MemberAddresses::where('member_id','=',$member['id'])->get();

            //陣列做成
            $member_address_counter = []; //計數器
            $member_addresses = [];

            foreach($member_addresses_model->toArray() as $val){
                $member_address_counter[] = 1; 

                $member_addresses['zipcode'][] = $val['zipcode'];
                $member_addresses['city'][] = $val['city'];
                $member_addresses['area'][] = $val['area'];
                $member_addresses['address'][] = $val['address'];
                $member_addresses['addressee'][] = $val['addressee'];
            }

            $out['member_address_counter'] = $member_address_counter;
            $out['member_addresses'] = $member_addresses;
        }
        
        $out['action'] = 'update/'.$member['id'];


        return view('backend.modules.members.edit_form',$out);
    }

    public function update(Request $request,Members $member){

        $input_data = $request->all();

        $validator = Validator::make($input_data,[
            'member_realname'      => 'required',
            'member_gender'        => 'required',
            'member_email'         => ['required','email',Rule::unique('lm_members')->ignore($member->id),],
            'member_phone'         => 'required',
        ], $messages = [
            'required'  => ':attribute 欄位不得為空值',
            'email'     => ':attribute 格式錯誤',
        ],[
            'member_realname'    => '真實姓名',
            'member_gender'      => '性別',
            'member_email'       => '信箱',
            'member_phone'       => '聯絡電話',
        ]);

        if ($validator->fails()) {
            return redirect('/backend/members/update_page/'.$member['id'])
                        ->withErrors($validator)
                        ->withInput($input_data);
        }


        $save_controller = true;
        DB::beginTransaction();

        $save_member = $member->update($input_data);

        if(!$save_member) $save_controller = false;
        
        //刪除
        $delete_member_addresses = MemberAddresses::where('member_id','=',$member['id'])->delete();
        if(!$delete_member_addresses) $save_controller = false;

        if(isset($input_data['member_address_counter'])){

            for($i=0;$i<count($input_data['member_address_counter']);$i++){
                
                if(empty($input_data['member_addresses']['zipcode'][$i]) 
                || empty($input_data['member_addresses']['city'][$i]) 
                || empty($input_data['member_addresses']['area'][$i]) 
                || empty($input_data['member_addresses']['address'][$i])
                || empty($input_data['member_addresses']['addressee'][$i])){

                    continue;
                }

                $save_member_address = MemberAddresses::create([
                    'member_id'     => $member['id'],
                    'zipcode'       => $input_data['member_addresses']['zipcode'][$i],
                    'city'          => $input_data['member_addresses']['city'][$i],
                    'area'          => $input_data['member_addresses']['area'][$i],
                    'address'       => $input_data['member_addresses']['address'][$i],
                    'addressee'     => $input_data['member_addresses']['addressee'][$i],
                ]);
                
                if(!$save_member_address) $save_controller = false;
            }

        }

        if(!$save_controller){
            DB::rollBack();
        }else{
            DB::commit();
        }
        
        return redirect('/backend/members');
    }

    public function delete(Members $member){

        $this->authorize('delete', $member);

        if(!$member->trashed()){
            $member->delete();
        }
        
        return redirect('/backend/members');
    }
    

    public function disable(Request $request){
        
        $data = Members::find($request->id);

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


    public function front_data_switch($frame_data,$request,$view_root){

        //路徑檢查
        $path = Arr::last(explode("/",$request->path()));
        if($path != 'profile' && $path != 'cart_list' && $path != 'order_list'){
            return redirect()->to('../frontend/index')->with('front_system_message','路徑錯誤')->send();
        }

        //檢查是否登入
        if(!Auth::guard('web')->check()){
            return redirect()->to('../frontend/member-center/login_page')->send();
        }

        $member_id = Auth::guard('web')->user()->id;

        $out_data = [];

        // 開始抓資料

        switch($path){
            
            case 'profile': //抓基本資料
                // 基本資料
                $db_data = Members::find($member_id);

                // 地址資料
                $member_addresses = MemberAddresses::where('member_id','=',$member_id)->get();

                $out_data = [
                    'view_root' => $view_root,
                    'datas'  => $db_data,
                    'member_addresses' => $member_addresses,
                ];
                break;

            case 'cart_list': //購物車

                $cart = ProductCarts::where('member_id','=',$member_id)->where('order_id','=',null)->get()->toArray();

                $all_product_total = 0;
                foreach($cart as $k => $v){
                    
                    $product = Products::find($v['product_id'])->toArray();

                    $cart[$k]['product_detail'] = $product;

                    $all_product_total += $v['total'];
                }

                $out_data = [
                    'view_root' => 'frontend.layouts.member_center_cart_list',
                    'datas'  => $cart,
                    'all_product_total' => $all_product_total
                ];
                break;

            case 'order_list': //訂單列表

                $orders = Orders::where('member_id','=',$member_id)->get()->toArray();

                $out_data = [
                    'view_root' => 'frontend.layouts.member_center_order_list',
                    'datas' => $orders,
                ];
                break;
        }
        

        return $out_data;

    }


    public function save_addresses(Request $request){

        $out= ['status' => 'YES'];

        $input_data = [
            'member_id' => $request->member_id,
            'zipcode' => $request->input_zipcode,
            'city' => $request->input_city,
            'area' => $request->input_area,
            'address' => $request->input_address,
            'addressee' => $request->input_addressee,
        ];

        if($request->dataid == 'new'){
            
            $save_data = MemberAddresses::create($input_data);

        }else{
            $data = MemberAddresses::find($request->dataid);

            $save_data = $data->update($input_data);
    
        }
        
        if(!$save_data) $out= ['status' => 'NO'];
        $out['out_data'] = $save_data;

        return json_encode($out,JSON_UNESCAPED_UNICODE);

    }

    public function delete_addresses(Request $request){
        
        $out= ['status' => 'YES'];
        $delete_data = MemberAddresses::find($request->dataid)->delete();
        if(!$delete_data) $out= ['status' => 'NO'];
        return json_encode($out,JSON_UNESCAPED_UNICODE);
    }

    public function member_update_data(Request $request){

        $out= ['status' => 'YES'];

        $input_data = $request->all();

        $validator = Validator::make($input_data,[
            'member_realname'      => 'required',
            'member_gender'        => 'required',
            'member_email'         => ['required','email',Rule::unique('lm_members')->ignore($input_data['member_id']),],
            'member_phone'         => 'required',
        ], $messages = [
            'required'  => ':attribute 欄位不得為空值',
            'email'     => ':attribute 格式錯誤',
        ],[
            'member_realname'    => '真實姓名',
            'member_gender'      => '性別',
            'member_email'       => '信箱',
            'member_phone'       => '聯絡電話',
        ]);

        if ($validator->fails()) {

            $out_error_message = [];

            foreach($validator->errors()->toArray() as $field_name => $error_msg){
                $out_error_message[] = $field_name."@#".$error_msg[0];
            }

            $out= [
                'status' => 'NO',
                'message' => $out_error_message,
            ];

        }else{
            
            $save_data = Members::find($input_data['member_id'])->update($input_data);
            if(!$save_data) $out= [
                'status' => 'NO',
                'message' => ['db_error@#資料儲存失敗'],
            ];
        }

        return json_encode($out,JSON_UNESCAPED_UNICODE);

    }

    public function make_address_data(Request $request){

        

        //抓全部縣市
        $all_city = Areas::select('city')->orderBy('id')->groupBy('city')->get()->toArray();
        $out_all_city = [];
        foreach($all_city as $v){
            $out_all_city[] = $v['city'];
        }

        //抓對應縣市的所有區域
        if(!empty($request->city)){
            $all_area = Areas::select('area')->where('city','=',$request->city)->orderBy('id')->get()->toArray();
            foreach($all_area as $v){
                $out_all_area[] = $v['area'];
            }
            
            //抓郵遞區號
            if(!empty($request->area)){
                $get_zipcode = Areas::where('city','=',$request->city)->where('area','=',$request->area)->first();
                $out_zipcode = $get_zipcode->zipcode;
            }else{
                $out_zipcode = "";
            }

        }else{
            $out_all_area = [];
            $out_zipcode ="";
        }
        

        $out = [
            'status' => 'YES',
            'all_city' => $out_all_city,
            'all_area' => $out_all_area,
            'zipcode' => $out_zipcode,
            'in_city' => $request->city,
            'in_area' => $request->area,
        ];

        return json_encode($out,JSON_UNESCAPED_UNICODE);
        
    }
}
