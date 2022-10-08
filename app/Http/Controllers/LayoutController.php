<?php

namespace App\Http\Controllers;

use App\Models\Layouts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class LayoutController extends Controller
{

    public function list(Request $request){

        // $this->authorize('list', $product);

        $datas = Layouts::latest()->paginate(15);

        return view('backend.modules.layouts.list_table',[
            'datas' => $datas,
            'keyword' => $request->keyword,
        ]);
    }

    public function create_page(){

        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $columns = Schema::getColumnListing('lm_layouts'); //抓table欄位
            
            foreach($columns as $field){
                $out[$field] = "";
            }
        }

        $out['action'] = 'create';

        return view('backend.modules.layouts.edit_form',$out);
    }

    public function create(Request $request){

        $input_data = $request->all();

        $validator = Validator::make($input_data,[
            'layout_name'  => 'required',
            'layout_root'  => 'required',
        ], $messages = [
            'required'  => ':attribute 欄位不得為空值',
        ],[
            'layout_name'  => '佈局名稱',
            'layout_root'  => '佈局路徑',
        ]);

        if ($validator->fails()) {
            return redirect('/backend/layouts/create_page')
                        ->withErrors($validator)
                        ->withInput($input_data);
        }

        $input_data['layout_view_root'] = 'frontend.layouts.'.$input_data['layout_root'];

        Layouts::create($input_data);
        
        return redirect('/backend/layouts');
    }

    public function update_page(Layouts $layout){

        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $out = $layout;
            
        }
        
        $out['action'] = 'update/'.$layout['id'];


        return view('backend.modules.layouts.edit_form',$out);
    }

    public function update(Request $request,Layouts $layout){

        $input_data = $request->all();

        $validator = Validator::make($input_data,[
            'layout_name'  => 'required',
            'layout_root'  => 'required',
        ], $messages = [
            'required'  => ':attribute 欄位不得為空值',
        ],[
            'layout_name'  => '佈局名稱',
            'layout_root'  => '佈局路徑',
        ]);

        if ($validator->fails()) {
            return redirect('/backend/layouts/update_page/'.$layout['id'])
                        ->withErrors($validator)
                        ->withInput($input_data);
        }

        $input_data['layout_view_root'] = 'frontend.layouts.'.$input_data['layout_root'];

        $layout->update($input_data);
        
        return redirect('/backend/layouts');
    }

    public function delete(Layouts $layout){

        // if(!$layout->trashed()){
        //     $layout->delete();
        // }

        $layout->delete();
        
        return redirect('/backend/layouts');
    }

}
