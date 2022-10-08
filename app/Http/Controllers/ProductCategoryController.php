<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategorys;

class ProductCategoryController extends Controller
{
    
    public function list(){
        
        $datas = ProductCategorys::all();

        foreach($datas as $k => $v){

            $category_id[] = $v['id'];
            $category_name[] = $v['category_name'];
        }

        $out = ['id' => $category_id,'category_name' => $category_name];

        return json_encode($out,JSON_UNESCAPED_UNICODE);
    }

    public function save(Request $request){

        $input_data = $request->all();

        if($input_data['id'] != 'new_row'){

            $category = ProductCategorys::find($input_data['id']);

            $chk = $category->update($input_data);

        }else{
            
            $chk = ProductCategorys::create($input_data);

        }
        
        if($chk){
            $out = ['status' => 'YES','category_name' => $input_data['category_name']];
        }else{
            $out = ['status' => 'NO'];
        }
        

        return json_encode($out,JSON_UNESCAPED_UNICODE);
        
    }

    public function delete(Request $request){

        $input_data = $request->all();
        
        $category = ProductCategorys::find($input_data['id']);

        $out = ['status' => 'NO'];
        if(!$category->trashed()){
            
            $chk = $category->delete();

            if($chk){
                $out = ['status' => 'YES'];
            }

        }

        return json_encode($out,JSON_UNESCAPED_UNICODE);

    }
}
