<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModuleCategorys;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class ModuleCategoryController extends Controller
{

    public function list(Request $request,ModuleCategorys $module_category){

        $this->authorize('list', $module_category);

        // dd($request->keyword);

        $datas = ModuleCategorys::latest()->paginate(5);

        return view('backend.modules.module_categorys.list_table',[
            'datas' => $datas,
            'keyword' => $request->keyword,
        ]);

    }

    public function create_page(ModuleCategorys $module_category){

        $this->authorize('create', $module_category);

        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $columns = Schema::getColumnListing('lm_module_categorys'); //抓table欄位
            
            foreach($columns as $field){
                $out[$field] = "";
            }
        }

        $out['action'] = 'create';

        return view('backend.modules.module_categorys.edit_form',$out);
    }

    public function create(Request $request){

        $input_data = $request->all();

        $validator = Validator::make($input_data,[
            'category_name' => 'required',
        ], $messages = [
            'required' => ':attribute 欄位不得為空值',
        ],[
            'category_name' => '分類名稱',
        ]);

        if ($validator->fails()) {
            return redirect('/backend/module_categorys/create_page')
                        ->withErrors($validator)
                        ->withInput($input_data);
        }

        ModuleCategorys::create($input_data);
        
        return redirect('/backend/module_categorys');
    }

    public function update_page(ModuleCategorys $module_category){

        $this->authorize('update', $module_category);
        
        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $out = $module_category;
            
        }

        $out['action'] = 'update/'.$module_category['id'];

        return view('backend.modules.module_categorys.edit_form',$out);
    }

    public function update(Request $request,ModuleCategorys $module_category){

        $input_data = $request->all();

        $validator = Validator::make($input_data,[
            'category_name' => 'required',
        ], $messages = [
            'required' => ':attribute 欄位不得為空值',
        ],[
            'category_name' => '分類名稱',
        ]);

        if ($validator->fails()) {
            return redirect('/backend/module_categorys/update_page/'.$module_category['id'])
                        ->withErrors($validator)
                        ->withInput($input_data);
        }

        $module_category->update($input_data);
        
        return redirect('/backend/module_categorys');
    }

    public function delete(ModuleCategorys $module_category){

        $this->authorize('delete', $module_category);

        $module_category->delete();
        
        return redirect('/backend/module_categorys');
    }

}
