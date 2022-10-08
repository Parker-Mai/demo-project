<?php

namespace App\Http\Controllers;

use App\Models\Modules;
use App\Models\Articles;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\SitemapFrames;
use App\Models\FrameFieldsValue;
use App\Models\FrameFieldsSetting;

class Frontendcontroller extends Controller
{

    public function page_switch(Request $request){

        

        $frame_name = explode("/",$request->path())[1];

        if(empty($frame_name)){
            die("路徑錯誤");
            return redirect('/frontend/index');
        }

        //抓架構佈局資料
        $frame_data = SitemapFrames::where('frame_name','=',$frame_name)->first();

        //判斷畫面類型
        $frame_type = $frame_data->frame_type;
        
        switch($frame_type){
            case 1: //純內容
                $output_layout = $frame_data->content_layouts->all();
                break;
            case 2: //純列表
                $output_layout = $frame_data->list_layouts->all();
                break;
            case 3: //列表+內容
                //如果有flag = detail 跟 有 ids 則為內容頁
                if($request->flag == 'detail' && !empty($request->ids)){
                    $output_layout = $frame_data->content_layouts->all();
                }else{
                    $output_layout = $frame_data->list_layouts->all();
                }
                break;
        }

        $view_root = $output_layout[0]->layout_view_root;

        //判斷是有跟模組做資料連動
        if($frame_data->use_module_model){
            //有 抓模組資料
            $out_data = $this->module_function($frame_data,$request,$view_root);

            $view_root = $out_data['view_root'];
        }else{ 
            //沒有 抓文章資料
            if(!$frame_data->is_index){ //排除首頁
                $out_data = $this->article_function($frame_data,$request->flag,$request->ids);
            }else{

                //首頁的 熱銷單品
                //抓熱銷單品
                $popular_products = Products::where('is_popular','=',1)->get();
                $out_data['datas'] = $popular_products;
            }
            
        }

        // dd($out_data);

        if(empty($view_root)){
            die("沒有設定佈局");
            return redirect('/frontend/index');
        }

        return view($view_root,['out_data' => $out_data]);
    }

    public function module_function($frame_data,$request,$view_root){
        
        //抓模組
        $module = Modules::find($frame_data->module_id);

        //呼叫controller抓資料
        $controller = new $module->module_controller_name;

        $out_data = $controller->front_data_switch($frame_data,$request,$view_root);
        

        return $out_data;

    }

    public function article_function($frame_data,$flag,$ids){
        
        // 開始抓文章資料
        switch($frame_data->frame_type){
            case 1:
                $article_data = Articles::where('frame_id','=',$frame_data->id)->first();
                $article_data = $this->article_data_process($article_data,1);
                break;
            case 2:
                $article_data = Articles::where('frame_id','=',$frame_data->id)->where('is_show','=',1)->get();
                $article_data = $this->article_data_process($article_data);
                break;
            case 3:
                if($flag == 'detail' && !empty($ids)){
                    $article_data = Articles::find($ids);
                    $article_data = $this->article_data_process($article_data,1);
                }else{
                    $article_data = Articles::where('frame_id','=',$frame_data->id)->where('is_show','=',1)->get();
                    $article_data = $this->article_data_process($article_data);
                }
                
                break;
        }

        

        return $article_data;

    }

    public function article_data_process($object,$level=2){

        if(empty($object)){
            return [];
        }
        
        $out_array = [];

        if($level == 2){

            foreach($object as $model_data_object){

                $model_data_array = json_decode(json_encode($model_data_object), true);

                //抓文章欄位資料
                $frame_fields_value = FrameFieldsValue::where('article_id','=',$model_data_object->id)->get();

                $frame_fields_array = [];
                foreach($frame_fields_value as $frame_fields_value_model){
                    
                    //抓文章欄位設定資料
                    $frame_fields_setting = FrameFieldsSetting::find($frame_fields_value_model->setting_id);


                    $model_data_array['db_'.$frame_fields_setting->field_name] = $frame_fields_value_model->field_value;
                }

                $out_array[] = $model_data_array;
            }

        }else{

            $out_array[] = json_decode(json_encode($object), true);
            
            //抓文章欄位資料
            $frame_fields_value = FrameFieldsValue::where('article_id','=',$object->id)->get();

            $frame_fields_array = [];
            foreach($frame_fields_value as $frame_fields_value_model){
                
                //抓文章欄位設定資料
                $frame_fields_setting = FrameFieldsSetting::find($frame_fields_value_model->setting_id);


                $out_array[0]['db_'.$frame_fields_setting->field_name] = $frame_fields_value_model->field_value;
            }

        }

        return $out_array;
    }
}
