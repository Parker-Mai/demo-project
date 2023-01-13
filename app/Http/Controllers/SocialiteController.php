<?php

namespace App\Http\Controllers;

use Socialite;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $input_data = [
            'login_type' => 1,
            'member_email' => $user->getEmail(),
            'member_realname' => $user->getName(),
            'google_avatar' => $user->getAvatar(),
            'google_token' => $user->token
        ];

        $edit_member = Members::updateOrCreate([
            'api_id' => $user->getId()
        ],$input_data);

        // dd($user);

        if(!$edit_member) return redirect('/frontend/member-center/signin_page')->with('front_system_message','系統錯誤');

        //自動登入
        Auth::guard('web')->login($edit_member);

        return redirect('/frontend/index')->with('front_system_message','您已加入會員，會員 '.$input_data['member_realname'].' 歡迎您');
    }

}
