<?php

namespace App\Http\Controllers;

use Socialite;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleProviderCallbackGoogle()
    {
        $user = Socialite::driver('google')->stateless()->user();

        // dd($user);

        $input_data = [
            'login_type' => 1,
            'member_name' => $user->getEmail(),
            'member_email' => $user->getEmail(),
            'member_realname' => $user->getName(),
            'avatar' => $user->getAvatar(),
            'token' => $user->token
        ];

        $edit_member = Members::updateOrCreate([
            'api_id' => $user->getId()
        ],$input_data);

        if(!$edit_member) return redirect('/frontend/member-center/signin_page')->with('front_system_message','系統錯誤');

        //自動登入
        Auth::guard('web')->login($edit_member);

        return redirect('/frontend/index')->with('front_system_message','您已加入會員，會員 '.$input_data['member_realname'].' 歡迎您');
    }

    public function redirectToProviderFB()
    {
        return Socialite::driver('facebook')->redirect();
    }
    
    public function handleProviderCallbackFB()
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        // dd($user);

        $input_data = [
            'login_type' => 2,
            'member_name' => $user->getEmail(),
            'member_email' => $user->getEmail(),
            'member_realname' => $user->getName(),
            'avatar' => $user->getAvatar(),
            'token' => $user->token
        ];

        $edit_member = Members::updateOrCreate([
            'api_id' => $user->getId()
        ],$input_data);

        if(!$edit_member) return redirect('/frontend/member-center/signin_page')->with('front_system_message','系統錯誤');

        //自動登入
        Auth::guard('web')->login($edit_member);

        return redirect('/frontend/index')->with('front_system_message','您已加入會員，會員 '.$input_data['member_realname'].' 歡迎您');
    }

}
