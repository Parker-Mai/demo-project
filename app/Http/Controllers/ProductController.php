<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductCarts;
use Illuminate\Http\Request;

use App\Models\ProductCategorys;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function list(Request $request,Products $product){

        $this->authorize('list', $product);

        $datas = Products::latest()->filter([$request->keyword])->paginate(15);

        return view('backend.modules.products.list_table',[
            'datas' => $datas,
            'keyword' => $request->keyword,
            'tags' => $request->tags,
        ]);

    }

    public function create_page(Products $product){

        $this->authorize('create', $product);

        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $columns = Schema::getColumnListing('lm_products'); //抓table欄位
            
            foreach($columns as $field){
                $out[$field] = "";
            }
            $out['product_category'] = [];
        }

        $product_category = ProductCategorys::all();
        $product_category_option = [];
        foreach($product_category as $k => $v){
            $product_category_option[$v['id']] = $v['category_name'];
        }
        $out['product_category_option'] = $product_category_option;


        $out['product_main_category_option'] = [
            '1' => '經典巧克力',
            '2' => '經典蛋糕',
            '3' => '彌月蛋糕'
        ];

        $out['action'] = 'create';
        

        return view('backend.modules.products.edit_form',$out);
    }

    public function create(Request $request){

        $input_data = $request->all();

        
        $validator = Validator::make($input_data,[
            'product_name' => 'required',
            'product_unit' => 'required'
        ], $messages = [
            'required' => ':attribute 欄位不得為空值',
        ],[
            'product_name' => '商品名稱',
            'product_unit' => '商品單位'
        ]);

        if ($validator->fails()) {
            return redirect('/backend/products/create_page')
                        ->withErrors($validator)
                        ->withInput($input_data);
        }

        $input_data['product_category'] = "@#".implode("@#",$input_data['product_category'])."@#";

        if($request->hasfile('product_img')){
            $input_data['product_img'] = $request->file('product_img')->store('product_img','public');
        }

        Products::create($input_data);

        
        
        return redirect('/backend/products');
    }

    public function update_page(Products $product){

        $this->authorize('update', $product);
        
        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            // dd($product['product_category']);
            // $product['product_category'] = json_decode($product['product_category'],1);
            $out = $product;
            
        }


        $product_category = ProductCategorys::all();
        $product_category_option = [];
        foreach($product_category as $k => $v){
            $product_category_option[$v['id']] = $v['category_name'];
        }
        $out['product_category_option'] = $product_category_option;

        $out['product_main_category_option'] = [
            '1' => '經典巧克力',
            '2' => '經典蛋糕',
            '3' => '彌月蛋糕'
        ];


        $out['action'] = 'update/'.$product['id'];
        

        return view('backend.modules.products.edit_form',$out);
    }

    public function update(Request $request,Products $product){

        $input_data = $request->all();

        $validator = Validator::make($input_data,[
            'product_name' => 'required',
        ], $messages = [
            'required' => ':attribute 欄位不得為空值',
        ],[
            'product_name' => '商品名稱',
        ]);

        if ($validator->fails()) {
            return redirect('/backend/products/update_page/'.$product['id'])
                        ->withErrors($validator)
                        ->withInput($input_data);
        }

        $input_data['product_category'] = "@#".implode("@#",$input_data['product_category'])."@#";
        
        if($request->hasfile('product_img')){
            $input_data['product_img'] = $request->file('product_img')->store('product_img','public');
        }

        
        $product->update($input_data);
        
        return redirect('/backend/products');
    }

    public function delete(Products $product){

        $this->authorize('delete', $product);

        if(!$product->trashed()){
            $product->delete();
        }
        
        return redirect('/backend/products');
    }

    public function is_show(Request $request){
        
        $data = Products::find($request->id);

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

    public function is_popular(Request $request){
        
        $data = Products::find($request->id);

        if($data->is_popular == 0){
            $data->is_popular = 1;    
        }else{
            $data->is_popular = 0;
        }

        $chk = $data->save();

        $out = ['status' => 'NO']; 
        if($chk){
           $out = ['status' => 'YES','val' => $data->is_popular]; 
        }

        return json_encode($out,JSON_UNESCAPED_UNICODE);

    }



    
    public function front_data_switch($frame_data,$request,$view_root){

        $out_data = [];

        $change_level = 2;

        //架構分類 經典巧克力、經典蛋糕、彌月蛋糕
        switch($frame_data->frame_name){
            case 'chocolate' : $main_category = 1;break;
            case 'cake' : $main_category = 2;break;
            case 'miyuki-cake' : $main_category = 3;break;
        }

        // 開始抓資料
        switch($frame_data->frame_type){
            case 1:
                $db_data = Products::where('product_main_category','=',$main_category)->where('is_show','<>',0)->first();
                break;
            case 2:
                $db_data = Products::where('product_main_category','=',$main_category)->where('is_show','<>',0)->filter([])->paginate(9)->withQueryString();
                break;
            case 3:
                if($request->flag == 'detail' && !empty($request->ids)){
                    $db_data = Products::find($request->ids);
                    $change_level = 1;
                }else{
                    $db_data = Products::where('product_main_category','=',$main_category)->where('is_show','<>',0)->filter([])->paginate(9)->withQueryString();

                }
                break;
        }

        
        //抓相關產品的資料
        $related_products = Products::where('product_main_category','=',$main_category)->inRandomOrder()->limit(4)->get();

        $out_data = [
            'view_root' => $view_root,
            'title' => $frame_data->frame_display_name,
            'frame_name' => $frame_data->frame_name,
            'datas'  => $db_data,
            'related_products' => $related_products,
        ];

        return $out_data;

    }

    public function objectToarray($object,$level){
        
        $out_array = [];

        if($level == 2){

            foreach($object as $model_data_object){

                $model_data_array = json_decode(json_encode($model_data_object), true);
    
                $out_array[] = $model_data_array;
            }

        }else{

            
            $out_array[] = json_decode(json_encode($object), true);

        }

        

        return $out_array;
    }

    public function add_cart(Request $request){

        //檢查是否登入
        if(!Auth::guard('web')->check()){
            return json_encode(['status' => 'NO','error' => 'auth'],JSON_UNESCAPED_UNICODE);
        }

        
        //檢查是否已加入購物車
        $member_id = Auth::guard('web')->user()->id;
        $chk = ProductCarts::where('member_id','=',$member_id)->where('product_id','=',$request->product_id)->where('order_id','=',null)->get()->toArray();
        if(count($chk) > 0){
            return json_encode(['status' => 'NO','error' => 'exist'],JSON_UNESCAPED_UNICODE);
        }

        //檢查加入數量為正整數 及 不得低於 1
        if(!preg_match("/^[1-9][0-9]*$/",$request->quantity)){
            return json_encode(['status' => 'NO','error' => 'format'],JSON_UNESCAPED_UNICODE);
        }

        //檢查加入數量不得低於 1
        if($request->quantity < 1){
            return json_encode(['status' => 'NO','error' => 'less'],JSON_UNESCAPED_UNICODE);
        }

        //檢查加入數量是否超過庫存
        $get_product = Products::find($request->product_id);
        if($request->quantity > $get_product->product_quantity){
            return json_encode(['status' => 'NO','error' => 'quantity'],JSON_UNESCAPED_UNICODE);
        }

        //計算總計
        $total = $get_product->product_price * $request->quantity;

        //加入購物車
        $save_cart = ProductCarts::create([
            'member_id' => $member_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total' => $total
        ]);

        if(!$save_cart) return json_encode(['status' => 'NO','error' => 'save'],JSON_UNESCAPED_UNICODE);


        return json_encode($out = ['status' => 'YES'],JSON_UNESCAPED_UNICODE);
    
    }

    public function view_cart(){

        //檢查是否登入
        if(!Auth::guard('web')->check()){
            return json_encode(['status' => 'NO','error' => 'auth'],JSON_UNESCAPED_UNICODE);
        }

        //抓該會員的購物車資料
        $member_id = Auth::guard('web')->user()->id;
        $cart = ProductCarts::where('member_id','=',$member_id)->where('order_id','=',null)->get()->toArray();

        
        foreach($cart as $k => $v){
            
            $product = Products::find($v['product_id'])->toArray();

            $cart[$k]['product_detail'] = $product;
            
        }

        return json_encode($out = ['status' => 'YES','cart_data' => $cart],JSON_UNESCAPED_UNICODE);

    }

    public function delete_cart(Request $request){
        
        //檢查是否登入
        if(!Auth::guard('web')->check()){
            return json_encode(['status' => 'NO','error' => 'auth'],JSON_UNESCAPED_UNICODE);
        }

        //開始刪除
        $delete_cart = ProductCarts::find($request->cart_id)->delete();
        if(!$delete_cart) return json_encode(['status' => 'NO','error' => 'save'],JSON_UNESCAPED_UNICODE);


        return json_encode(['status' => 'YES'],JSON_UNESCAPED_UNICODE);


    }
}
