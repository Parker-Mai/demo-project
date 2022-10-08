<?php

namespace App\Http\Controllers;

use App\Models\Layouts;
use App\Models\Modules;
use Illuminate\Http\Request;
use App\Models\SitemapFrames;
use App\Models\FrameFieldsValue;
use App\Models\FrameFieldsSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class SitemapFrameController extends Controller
{

    public function list(){

        $datas = SitemapFrames::where('parent_frame_id','=',0)->get();

        return view('backend.modules.sitemap_frames.list_table',[
            'datas' => $datas,
        ]);
    }

    public function create_page(){

        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $columns = Schema::getColumnListing('lm_sitemap_frames'); //抓table欄位
            
            foreach($columns as $field){
                $out[$field] = "";
            }

        }

        //抓所有模組
        $modules = Modules::all();
        $out['modules'] = $modules;

        //抓所有佈局
        $layouts = Layouts::all();
        $out['layouts'] = $layouts;

        $out['fields_setting'] = [];

        $out['action'] = 'create';

        return view('backend.modules.sitemap_frames.edit_form',$out);
    }

    public function create(Request $request){

        $input_data = $request->all();

        $validator = Validator::make($input_data,[
            'frame_name'            => 'required',
            'frame_display_name'    => 'required',
        ], $messages = [
            'required' => ':attribute 欄位不得為空值',
        ],[
            'frame_display_name'    => '架構名稱',
            'frame_name'            => '架構資料名稱',
        ]);

        $validator_fails = $validator->fails();

        if(!empty($input_data['is_external_link'])){
            

            if(empty($input_data['link_url'])){
                $validator->errors()->add(
                    'link_url', '連結網址 不得為空值'
                );

                $validator_fails = true;
            }
            
            $input_data['frame_type'] = 0;
            $input_data['use_module_model'] = 0;

        }else{

            $input_data['is_external_link'] = 0;
            
            if(empty($input_data['frame_type'])){

                $validator->errors()->add(
                    'frame_type', '畫面類型 必須選擇其中之一'
                );
                $validator_fails = true;

                $input_data['frame_type'] = 0;
                $input_data['use_module_model'] = 0;
            }else{
                
                if($input_data['frame_type'] != 4){

                    if(!empty($input_data['use_module_model'])){

                        if(empty($input_data['module_id'])){
                            $validator->errors()->add(
                                'module_id', '使用模組 必須選擇其中之一'
                            );
                            $validator_fails = true;
                        }
                        
                    }else{
                        $input_data['use_module_model'] = 0;
                    }

                }else{
                    $input_data['use_module_model'] = 0;
                }

            }

            

        }

        if ($validator_fails) {
            return redirect('/backend/sitemap_frames/create_page')
                        ->withErrors($validator)
                        ->withInput($input_data);
        }
        
        $save_controller = true;
        DB::beginTransaction();

        $save_sitemap_frame = SitemapFrames::create($input_data);

        if(!$save_sitemap_frame) $save_controller = false;

        if(count($input_data['field_name']['new_data']) > 0){

            for($i=0;$i<count($input_data['field_name']['new_data']);$i++){
            

                $create_frame_fields_setting = FrameFieldsSetting::create([
                    'frame_id'              => $save_sitemap_frame->id,
                    'field_display_name'    => $input_data['field_display_name']['new_data'][$i],
                    'field_name'            => $input_data['field_name']['new_data'][$i],
                    'field_type'            => $input_data['field_type']['new_data'][$i],
                    'field_option'          => empty($input_data['field_option']['new_data'][$i]) ? "" : $input_data['field_option']['new_data'][$i],
                ]);

                if(!$create_frame_fields_setting) $save_controller = false;
            
            }

        }

        if(!$save_controller){
            DB::rollBack();
        }else{
            DB::commit();
        }
        
        
        return redirect('/backend/sitemap_frames');
    }

    public function update_page(SitemapFrames $sitemap_frame){

        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $out = $sitemap_frame;

        }

        //抓所有模組
        $modules = Modules::all();
        $out['modules'] = $modules;

        //抓所有佈局
        $layouts = Layouts::all();
        $out['layouts'] = $layouts;

        //抓所有欄位變數設定
        $frame_fields_setting = $sitemap_frame->frame_fields_setting;
        $out['fields_setting'] = $frame_fields_setting;

        //變數類型選項
        $field_type_option = [
            '1' => 'INPUT',
            '2' => 'SELECT',
            '3' => 'CHECKBOX',
            '4' => 'RODIO',
            '5' => 'TEXTAREA',
            '6' => 'UPLOAD(IMAGE)',
            '7' => 'UPLOAD(FILE)',
        ];

        $out['field_type_option'] = $field_type_option;

        $out['action'] = 'update/'.$sitemap_frame['id'];


        return view('backend.modules.sitemap_frames.edit_form',$out);
    }

    public function update(Request $request,SitemapFrames $sitemap_frame){

        $input_data = $request->all();


        $validator = Validator::make($input_data,[
            'frame_name'            => 'required',
            'frame_display_name'    => 'required',
        ], $messages = [
            'required' => ':attribute 欄位不得為空值',
        ],[
            'frame_display_name'    => '架構名稱',
            'frame_name'            => '架構資料名稱',
        ]);

        $validator_fails = $validator->fails();

        if(!empty($input_data['is_external_link'])){
            

            if(empty($input_data['link_url'])){
                $validator->errors()->add(
                    'link_url', '連結網址 不得為空值'
                );

                $validator_fails = true;
            }
            
            $input_data['frame_type'] = 0;
            $input_data['use_module_model'] = 0;

        }else{

            $input_data['is_external_link'] = 0;
            
            if(empty($input_data['frame_type'])){

                $validator->errors()->add(
                    'frame_type', '畫面類型 必須選擇其中之一'
                );
                $validator_fails = true;

                $input_data['frame_type'] = 0;
                $input_data['use_module_model'] = 0;
            }else{
                
                if($input_data['frame_type'] != 4){

                    if(!empty($input_data['use_module_model'])){

                        if(empty($input_data['module_id'])){
                            $validator->errors()->add(
                                'module_id', '使用模組 必須選擇其中之一'
                            );
                            $validator_fails = true;
                        }
                        
                    }else{
                        $input_data['use_module_model'] = 0;
                    }

                }else{
                    $input_data['use_module_model'] = 0;
                }

            }

            

        }

        if ($validator_fails) {
            return redirect('/backend/sitemap_frames/update_page/'.$sitemap_frame['id'])
                        ->withErrors($validator)
                        ->withInput($input_data);
        }


        $save_controller = true;
        DB::beginTransaction();

        $save_sitemap_frame = $sitemap_frame->update($input_data);

        if(!$save_sitemap_frame) $save_controller = false;

        //新增 新資料
        if(count($input_data['new_data_counter']) > 1){

            for($i=0;$i<count($input_data['field_name']['new_data']);$i++){

                $create_frame_fields_setting = FrameFieldsSetting::create([
                    'frame_id'              => $sitemap_frame->id,
                    'field_display_name'    => $input_data['field_display_name']['new_data'][$i],
                    'field_name'            => $input_data['field_name']['new_data'][$i],
                    'field_type'            => $input_data['field_type']['new_data'][$i],
                    'field_option'          => empty($input_data['field_option']['new_data'][$i]) ? "" : $input_data['field_option']['new_data'][$i],
                ]);

                if(!$create_frame_fields_setting) $save_controller = false;
            
            }

        }

        //更新 舊資料
        if(count($input_data['old_data_counter']) > 1){

            foreach($input_data['field_name']['old_data'] as $id => $val){

                $update_frame_fields_setting = FrameFieldsSetting::find($id);

                $update_frame_fields_setting->update([
                    'field_display_name'    => $input_data['field_display_name']['old_data'][$id],
                    'field_name'            => $input_data['field_name']['old_data'][$id],
                    'field_type'            => $input_data['field_type']['old_data'][$id],
                    'field_option'          => empty($input_data['field_option']['old_data'][$id]) ? "" : $input_data['field_option']['old_data'][$id],
                ]);

                if(!$update_frame_fields_setting) $save_controller = false;

            }


        }

        if(!$save_controller){
            DB::rollBack();
        }else{
            DB::commit();
        }

        
        return redirect('/backend/sitemap_frames');
    }

    public function delete(SitemapFrames $sitemap_frame){

        $sitemap_frame->delete();
        
        return redirect('/backend/sitemap_frames');
    }


    public function delete_field_setting(Request $request){
        
        $input_data = $request->all();
        
        $frame_fields_setting = FrameFieldsSetting::find($input_data['id']); 

        $frame_fields_value = FrameFieldsValue::where('setting_id','=',$input_data['id'])->get();

        $out = ['status' => 'YES'];

        $save_controller = true;
        DB::beginTransaction();

        if(!$frame_fields_setting->trashed()){
            $chk_del_field_setting = $frame_fields_setting->delete();
        }

        if(!$chk_del_field_setting) $save_controller = false;

        foreach($frame_fields_value as $v){
            
            if(!$v->trashed()){
                $chk_del_field_value = $v->delete();
            }

            if(!$chk_del_field_value) $save_controller = false;
        }

        if(!$save_controller){
            DB::rollBack();
            $out = ['status' => 'NO'];
        }else{
            DB::commit();
        }

        return json_encode($out,JSON_UNESCAPED_UNICODE);

    }

}
