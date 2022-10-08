<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use Illuminate\Http\Request;
use App\Models\SitemapFrames;
use App\Models\FrameFieldsValue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{

    public function list(Request $request){

        // $this->authorize('list', $product);

        $datas = Articles::latest()->filter([$request->frame_id])->paginate(5);

        $row_datas = $this->objectToarray($datas);

        $frame_datas = SitemapFrames::where('parent_frame_id','=',0)->get();

        if(!empty($request->frame_id)){
            $frame_link_str = '?frame_id='.$request->frame_id;
        }else{
            $frame_link_str = "";
        }

        return view('backend.modules.articles.list_table',[
            'datas' => $datas,
            'row_datas' => $row_datas,
            'frame_datas' => $frame_datas,
            'frame_link_str' => $frame_link_str,
            'keyword' => $request->keyword,
        ]);
    }

    public function create_page(Request $request){


        if(!empty($request->frame_id)){

            $frame_data = SitemapFrames::find($request->frame_id);
            
            $frame_fields_setting = $this->objectToarray($frame_data->frame_fields_setting->all());

            if(count($frame_fields_setting) > 0){
                $out['frame_fields_setting'] = $frame_fields_setting;

                foreach($frame_fields_setting as $k => $v){
    
                    if($v['field_type'] == 3){
                        $field_setting[$v['id']] = [];
                    }else{
                        $field_setting[$v['id']] = "";
                    }
                    
                }
                
                $out['field_setting'] = $field_setting;
            }else{
                $out['frame_fields_setting'] = [];
                $out['field_setting'] = [];
            }
            


            if(count(old()) > 0){

                foreach(old() as $field => $v){
                    $out[$field] = $v;
                }

            }else{

                $columns = Schema::getColumnListing('lm_articles'); //抓table欄位
            
                foreach($columns as $field){
                    $out[$field] = "";
                }

                $out['frame_name'] = $frame_data['frame_display_name'];
                $out['frame_id'] = $request->frame_id;

            }

        
        }else{
            $out['frame_name'] = "";
            $out['frame_id'] = "";
            $out['data_title'] = "";
            $out['frame_fields_setting'] = [];
            $out['field_setting'] = [];
        }
        

        $frame_datas = SitemapFrames::where('parent_frame_id','=',0)->get();
        $out['frame_datas'] = $frame_datas;
        
        $out['action'] = 'create';

        // dd($out);

        return view('backend.modules.articles.edit_form',$out);
    }

    public function create(Request $request){

    
        $input_data = $request->all();

        // dd($request->file('field_setting'));
        

        $validator = Validator::make($input_data,[
            'frame_id'  => 'required',
            'data_title'  => 'required',
        ], $messages = [
            'required'  => ':attribute 欄位不得為空值',
        ],[
            'frame_id'  => '網站架構',
            'data_title'  => '資料標題',
        ]);

        if ($validator->fails()) {
            return redirect('/backend/articles/create_page?frame_id='.$input_data['frame_id'])
                        ->withErrors($validator)
                        ->withInput($input_data);
        }


        $save_controller = true;
        DB::beginTransaction();

        $save_article = Articles::create([
            'frame_id' => $input_data['frame_id'],
            'data_title' => $input_data['data_title'],
        ]);

        if(!$save_article) $save_controller = false;

        foreach($input_data['field_setting'] as $setting_id => $value){
            
            
            if($setting_id == 'flag' || is_object($value)){
                continue;
            }

            if(is_array($value)){
                $out_value_arr = [];

                foreach($value as $arr_val){
                    if(!empty($arr_val)){
                        $out_value_arr[] = $arr_val;
                    }
                }

                $value = implode(",",$out_value_arr);
            }
            
            $save_fields_value = FrameFieldsValue::create([
                'article_id' => $save_article->id,
                'setting_id' => $setting_id,
                'field_value' => $value,
            ]);

            if(!$save_fields_value) $save_controller = false;
            

        }

        if($request->hasfile('field_setting')){

            foreach($request->file('field_setting') as $setting_id => $file){

                $path = $file->store('article_file','public');

                if(!empty($path)){
                    
                    $save_fields_file_value = FrameFieldsValue::create([
                        'article_id' => $save_article->id,
                        'setting_id' => $setting_id,
                        'field_value' => $path,
                    ]);

                    if(!$save_fields_file_value) $save_controller = false;

                }else{

                    $save_controller = false;

                }

            }

        }
        

        if(!$save_controller){
            DB::rollBack();
        }else{
            DB::commit();
        }
        
        return redirect('/backend/articles');
    }

    public function update_page(Articles $article){


        $frame_data = SitemapFrames::find($article->frame_id);
            
        $frame_fields_setting = $this->objectToarray($frame_data->frame_fields_setting->all());
        
        // dd($frame_fields_setting);

        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $out = $article;
            
            $out['frame_name'] = $frame_data['frame_display_name'];

            //抓自訂欄位的值
            $frame_fields_value = FrameFieldsValue::where('article_id','=',$article->id)->get()->all();


            if(!empty($frame_fields_value)){

                foreach($frame_fields_value as $key => $model){

                    $frame_field_setting = $model->fields_setting->first();
    
    
                    if($frame_field_setting->field_type == 3){
                        $field_setting[$model->setting_id] = explode(",",$model->field_value);
                    }else{
                        $field_setting[$model->setting_id] = $model->field_value;
                    }
                    
                }
                
                
            }else{

                foreach($frame_fields_setting as $k => $v){

                    if($v['field_type'] == 3){
                        $field_setting[$v['id']] = [];
                    }else{
                        $field_setting[$v['id']] = "";
                    }
                    
                }

            }
            

        }

        if(count($frame_fields_setting) > 0){
            $out['frame_fields_setting'] = $frame_fields_setting;
            $out['field_setting'] = $field_setting;
        }else{
            $out['frame_fields_setting'] = [];
            $out['field_setting'] = [];
        }

       

        $frame_datas = SitemapFrames::where('parent_frame_id','=',0)->get();
        $out['frame_datas'] = $frame_datas;
        
        $out['action'] = 'update/'.$article['id'];


        return view('backend.modules.articles.edit_form',$out);
    }

    public function update(Request $request,Articles $article){

        $input_data = $request->all();

        // dd($input_data);

        $validator = Validator::make($input_data,[
            'frame_id'  => 'required',
            'data_title'  => 'required',
        ], $messages = [
            'required'  => ':attribute 欄位不得為空值',
        ],[
            'frame_id'  => '網站架構',
            'data_title'  => '資料標題',
        ]);

        if ($validator->fails()) {
            return redirect('/backend/articles/update_page/'.$article['id'])
                        ->withErrors($validator)
                        ->withInput($input_data);
        }

        $save_controller = true;
        DB::beginTransaction();

        $save_article = $article->update([
            'data_title' => $input_data['data_title'],
        ]);

        if(!$save_article) $save_controller = false;

        foreach($input_data['field_setting'] as $setting_id => $value){

            if($setting_id == 'flag'){
                continue;
            }

            if(is_array($value)){
                $value = implode(",",$value);
            }
            
            $save_fields_value = FrameFieldsValue::where('article_id','=',$article->id)->where('setting_id','=',$setting_id)->update(['field_value' => $value]);

            if(!$save_fields_value) $save_controller = false;

        }

        if($request->hasfile('field_setting')){

            foreach($request->file('field_setting') as $setting_id => $file){

                $path = $file->store('article_file','public');

                if(!empty($path)){
                    
                    $save_fields_file_value = FrameFieldsValue::create([
                        'article_id' => $save_article->id,
                        'setting_id' => $setting_id,
                        'field_value' => $path,
                    ]);

                    if(!$save_fields_file_value) $save_controller = false;

                }else{

                    $save_controller = false;

                }

            }

        }

        if(!$save_controller){
            DB::rollBack();
        }else{
            DB::commit();
        }
        
        return redirect('/backend/articles');
    }

    public function delete(Articles $article){


        $save_controller = true;
        DB::beginTransaction();

        if(!$article->trashed()){
            $chk = $article->delete();
        }

        if(!$chk) $save_controller = false;

        $frame_fields_value = FrameFieldsValue::where('article_id','=',$article->id)->get();

        foreach($frame_fields_value as $v){
            
            if(!$v->trashed()){
                $chk_field_value = $v->delete();
            }

            if(!$chk_field_value) $save_controller = false;
        }

        if(!$save_controller){
            DB::rollBack();
        }else{
            DB::commit();
        }
        
        return redirect('/backend/articles');
    }

    public function disable(Request $request){
        
        $data = Articles::find($request->id);

        if($data->is_show == 0){
            $data->is_show = 1;    
        }else{
            $data->is_show = 0;
        }

        $chk = $data->save();

        $out = ['status' => 'NO']; 
        if($chk){
           $out = ['status' => 'YES','val' => $data->is_show]; 
        }

        return json_encode($out,JSON_UNESCAPED_UNICODE);

    }

    public function objectToarray($object){
        
        $out_array = [];

        foreach($object as $model_data_object){

            $model_data_array = json_decode(json_encode($model_data_object), true);

            //自定義
            if(!empty($model_data_array['field_option'])){
                $model_data_array['field_option'] = explode(",",$model_data_array['field_option']);
            }

            if(!empty($model_data_array['frame_id'])){

                $frame_data = SitemapFrames::find($model_data_array['frame_id']);
                
                $model_data_array['frame_id'] = $frame_data['frame_display_name'];
            }

            $out_array[] = $model_data_array;
        }

        return $out_array;
    }

}
