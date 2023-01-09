<?php

namespace App\Http\Controllers;

use App\Models\Members;
use App\Models\Accounts;
use App\Models\SysSettings;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function login_page(Request $request){


       
        $sys_data = SysSettings::first()->toArray();

        //判斷系統是否下架關閉
        if(!empty($sys_data['sys_end_date'])){
           
            if(strtotime(date('Y/m/d')) > strtotime($sys_data['sys_end_date'])){
                return view('backend.layouts.close_error');
            }

        }

        //判斷是否有在不允許IP內
        if(!empty($sys_data['sys_deny_ip'])){
            
            $sys_deny_ip = explode(",",$sys_data['sys_deny_ip']);

            if(in_array($request->ip(),$sys_deny_ip)){
                return view('backend.layouts.general_error');
            }

        }

        return view('backend.layouts.login',$sys_data);
    }

    public function login(Request $request){

        $input_data = $request->all();

        //注意 attempt 的密碼鍵值 一定要用password
        if($this->guard()->attempt(['account_name' => $input_data['login_account'],'account_disabled' => 0,'password' => $input_data['login_password']])){

            $request->session()->regenerate();

            return redirect('/backend/index')->with('system_message','登入成功');

        }

        return  back()->with('system_message','登入失敗，請檢查帳號或密碼是否正確。');
        
    }

    public function logout(Request $request){

        $this->guard()->logout(); 

        // dd($request->session());

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/backend/login_page')->with('system_message','已成功登出');
    }

    public function front_login_page(){

        $web_name = SysSettings::first()->toArray();

        return view('frontend.layouts.login_page',['web_name' => $web_name['sys_name']]);
    }

    public function front_login(Request $request){
        
        $input_data = $request->all();

        //注意 attempt 的密碼鍵值 一定要用password
        if(Auth::guard('web')->attempt(['member_name' => $input_data['login_name'],'password' => $input_data['login_password']])){

            $request->session()->regenerate();

            return redirect('/frontend/member-center/profile')->with('front_system_message','登入成功');

        }

        return  back()->with('front_system_message','登入失敗，請檢查帳號或密碼是否正確。');

    }

    public function front_logout(Request $request){

        Auth::guard('web')->logout(); 

        // dd($request->session());

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/frontend/index')->with('front_system_message','已成功登出');
    }


    public function signin_page(){

        $web_name = SysSettings::first()->toArray();

        return view('frontend.layouts.signin_page',['web_name' => $web_name['sys_name']]);
    }

    public function signin(Request $request){
        
        $input_data = $request->all();

        $validator = Validator::make($input_data,[
            'member_name'       => ['required',Rule::unique('lm_members','member_name')],
            'member_password'   => ['required','confirmed'],
            'member_realname'   => 'required',
            'member_email'      => ['required',Rule::unique('lm_members','member_email')],
            'member_phone'      => 'required',
        ], $messages = [
            'required'  => ':attribute 欄位不得為空值',
            'confirmed' => '與確認密碼不一致',
            'unique'    => ':attribute已經存在'
        ],[
            'member_name'       => '登入帳號',
            'member_password'   => '登入密碼',
            'member_realname'   => '真實姓名',
            'member_email'      => '電子信箱',
            'member_phone'      => '手機號碼',
        ]);

        if ($validator->fails()) {
            return redirect('/frontend/member-center/signin_page')
                        ->withErrors($validator)
                        ->withInput($input_data);
        }

        $save_member = Members::create($input_data);

        if(!$save_member) return redirect('/frontend/member-center/signin_page')->with('front_system_message','系統錯誤');

        //自動登入
        Auth::guard('web')->login($save_member);

        return redirect('/frontend/index')->with('front_system_message','您已加入會員，會員 '.$input_data['member_realname'].' 歡迎您');

    }
    

}
