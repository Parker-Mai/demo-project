<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{

    public function list(Request $request,Banners $banner){

        // $this->authorize('list', $banner);

        // $datas = Banners::latest()->paginate(5);

        return view('backend.modules.banners.list_table',[
            // 'datas' => $datas,
            'keyword' => $request->keyword,
        ]);

    }

    public function create_page(Banners $banner){

        // $this->authorize('create', $banner);

        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $columns = Schema::getColumnListing('lm_banners'); //抓table欄位
            
            foreach($columns as $field){
                $out[$field] = "";
            }

        }


        $out['action'] = 'create';

        return view('backend.modules.banners.edit_form',$out);
    }

    public function create(Request $request){

        $input_data = $request->all();

        $validator = Validator::make($input_data,[
            'file_input' => 'required',
        ], $messages = [
            'required' => ':attribute 欄位不得為空值',
        ],[
            'file_input' => '欄位',
        ]);

        if ($validator->fails()) {
            return redirect('/backend/banners/create_page')
                        ->withErrors($validator)
                        ->withInput($input_data);
        }

        if($request->hasfile('product_img')){
            $input_data['product_img'] = $request->file('product_img')->store('product_img','public');
        }

        Banners::create($input_data);

        
        return redirect('/backend/banners');
    }

    public function update_page(Banners $banner){

        // $this->authorize('update', $banner);
        
        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $out = $banner;
            
        }

        $out['action'] = 'update/'.$banner['id'];

        return view('backend.modules.banners.edit_form',$out);
    }

    public function update(Request $request,Banners $banner){

        $input_data = $request->all();

        $validator = Validator::make($input_data,[
            'file_input' => 'required',
        ], $messages = [
            'required' => ':attribute 欄位不得為空值',
        ],[
            'file_input' => '欄位',
        ]);

        if ($validator->fails()) {
            return redirect('/backend/banners/update_page/'.$banner['id'])
                        ->withErrors($validator)
                        ->withInput($input_data);
        }


        $banner->update($input_data);
        
        return redirect('/backend/banners');
    }

    public function delete(Banners $banner){

        $this->authorize('delete', $banner);

        // if(!$banner->trashed()){
        //    $banner->delete();
        // }

        $banner->delete();
        
        return redirect('/backend/banners');
    }
}
