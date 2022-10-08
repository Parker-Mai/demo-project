<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Larinfo;

class SysSettingController extends Controller
{
    

    public function edit_page(){
        
        $larinfo = Larinfo::getInfo();

        dd($larinfo);

        return view('backend.modules.sys_settings.edit_form');
    }

    public function update(Request $request){
        
    }

}
