<?php

namespace App\Http\Controllers;

use Larinfo;
use App\Models\SysSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SysSettingController extends Controller
{
    

    public function edit_page(){

        $larinfo = Larinfo::getInfo();

        $sys_data = SysSettings::first()->toArray();

        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $sys_data[$field] = $v;
            }

        }else{
            
            $sys_data = SysSettings::first()->toArray();
            
        }
        
        $sys_data['sys_os'] = $larinfo['server']['software']['os'];
        $sys_data['sys_php_version'] = $larinfo['server']['software']['php'];
        $sys_data['sys_db_version'] = $larinfo['database']['driver']." ".$larinfo['database']['version'];

        // dd($sys_data);

        return view('backend.modules.sys_settings.edit_form',$sys_data);
    }

    public function update(Request $request){
        
        $input_data = $request->all();

        $validator = Validator::make($input_data,[
            'sys_name' => 'required',
        ], $messages = [
            'required' => ':attribute 欄位不得為空值',
        ],[
            'sys_name' => '系統名稱',
        ]);

        if ($validator->fails()) {
            return redirect('/backend/sys_settings')
                        ->withErrors($validator)
                        ->withInput($input_data);
        }

        if($request->hasfile('sys_logo')){
            $input_data['sys_logo'] = $request->file('sys_logo')->store('sys_logo','public');
        }

        
        $save = SysSettings::first()->update($input_data);

        if(!$save) return redirect('/backend/sys_settings')->withErrors($validator)->withInput($input_data);

        return redirect('/backend/sys_settings')->with('system_message','修改成功');;

    }

}
