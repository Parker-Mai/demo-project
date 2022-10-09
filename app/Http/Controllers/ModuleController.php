<?php

namespace App\Http\Controllers;

use App\Models\Modules;
use App\Models\Permissions;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ModuleCategorys;
use App\Models\PermissionRoles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class ModuleController extends Controller
{

    public function list(Request $request,Modules $module){

        $this->authorize('list', $module);

        // dd($request->keyword);

        $datas = Modules::latest()->paginate(15);

        return view('backend.modules.modules.list_table',[
            'datas' => $datas,
            'keyword' => $request->keyword,
        ]);

    }

    public function create_page(Modules $module){

        $this->authorize('create', $module);

        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $columns = Schema::getColumnListing('lm_modules'); //抓table欄位
            
            foreach($columns as $field){
                $out[$field] = "";
            }

            $out['permissions_arr'] = [];
        }

        //抓所有模組分類
        $module_categorys = ModuleCategorys::all();

        $out['action'] = 'create';

        $out['module_categorys'] = $module_categorys;
        $out['module_category_id'] = '';

        $out['module_name_route'] = '';
        $out['module_name_model'] = '';

        return view('backend.modules.modules.edit_form',$out);
    }

    public function create(Request $request){

        $input_data = $request->all();

        // dd($input_data);

        $validator = Validator::make($input_data,[
            'module_display_name'   => 'required',
            'module_name'           => 'required'
        ], $messages = [
            'required' => ':attribute 欄位不得為空值',
        ],[
            'module_display_name'   => '模組名稱',
            'module_name'           => '模組應用名稱'
        ]);

        if ($validator->fails()) {

            $permissions_arr = [];
            for($i=0;$i<count($input_data['permission_name']);$i++){

                if(empty($input_data['permission_name'][$i]) || empty($input_data['permission_display_name'][$i])){
                    continue;
                }

                $permissions_arr[$input_data['permission_display_name'][$i]] = $input_data['permission_name'][$i];
            }

            $input_data['permissions_arr'] = $permissions_arr;

            return redirect('/backend/modules/create_page')
                        ->withErrors($validator)
                        ->withInput($input_data);
        }

        //model 名字處理
        $model_first_str = Str::upper(Str::substr($input_data['module_name'],0,1)); //抓第一個字元，並大寫
        $model_other_str = Str::substr($input_data['module_name'],1); //抓除第一個字元外剩下的字元

        $model_name = $model_first_str.$model_other_str; //組合

        //判斷字尾是否有加's'，有的話移掉(controller的名字)
        if(Str::substr($input_data['module_name'],-1,1) == 's'){
            $model_name_without_s = Str::substr($model_name,0,-1);
        }else{
            $model_name_without_s = $model_name;
        }

        //儲存module資料
        $save_module = Modules::create([
            'module_display_name'       => $input_data['module_display_name'],
            'module_name'               => $input_data['module_name'],
            'module_model_name'         => 'App\\Models\\'.$model_name,
            'module_controller_name'    => 'App\\Http\\Controllers\\'.$model_name_without_s.'Controller',
            'category_id'               => $input_data['category_id']
        ]);

        //儲存權限
        if(count($input_data['permission_name']) > 1){

            for($i=0;$i<count($input_data['permission_name']);$i++){

                if(empty($input_data['permission_name'][$i]) || empty($input_data['permission_display_name'][$i])){
                    continue;
                }
                
                Permissions::create([
                    'permission_name' => $input_data['module_name'].'_'.$input_data['permission_name'][$i],
                    'permission_display_name' => $input_data['permission_display_name'][$i],
                    'module_id' => $save_module->id
                ]);
            }

        }

        //開始製造檔案
        $this->create_file($input_data['module_name'],$model_name,$model_name_without_s);


        return redirect('/backend/modules');
    }

    public function update_page(Modules $module){

        $this->authorize('update', $module);
        
        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $out = $module;
            
            //抓該模組的權限
            $permissions = Permissions::where('module_id','=',$module->id)->get();

            // dd($permissions->all());

            $permissions_arr = [];
            foreach($permissions->all() as $permission_model){

                $permission_name = explode("_",$permission_model->permission_name)[1];

                if($permission_name == 'list'){ //把列表除外
                    continue;
                }

                $permissions_arr[$permission_model->permission_display_name] = $permission_name;
            }
            
            $out['permissions_arr'] = $permissions_arr;

            
        }

        //model 名字處理
        $model_first_str = Str::upper(Str::substr($module['module_name'],0,1));
        $model_other_str = Str::substr($module['module_name'],1);

        $model_name = $model_first_str.$model_other_str;

        if(Str::substr($module['module_name'],-1,1) == 's'){
            $model_name_without_s = Str::substr($model_name,0,-1);
        }

        $out['module_name_route'] = $model_name.'Route';
        $out['module_name_model'] = $model_name;

        //抓所有模組分類
        $module_categorys = ModuleCategorys::all();
        $out['module_categorys'] = $module_categorys;
        $out['module_category_id'] = $module['category_id'];

        $out['action'] = 'update/'.$module['id'];

        return view('backend.modules.modules.edit_form',$out);
    }

    public function update(Request $request,Modules $module){

        $input_data = $request->all();

        $validator = Validator::make($input_data,[
            'module_display_name'   => 'required',
            'module_name'           => 'required'
        ], $messages = [
            'required' => ':attribute 欄位不得為空值',
        ],[
            'module_display_name'   => '模組名稱',
            'module_name'           => '模組應用名稱'
        ]);

        if ($validator->fails()) {

            $permissions_arr = [];
            for($i=0;$i<count($input_data['permission_name']);$i++){

                if(empty($input_data['permission_name'][$i]) || empty($input_data['permission_display_name'][$i])){
                    continue;
                }

                $permissions_arr[$input_data['permission_display_name'][$i]] = $input_data['permission_name'][$i];
            }

            $input_data['permissions_arr'] = $permissions_arr;

            return redirect('/backend/modules/update_page/'.$module['id'])
                        ->withErrors($validator)
                        ->withInput($input_data);
        }


        //model 名字處理
        $model_first_str = Str::upper(Str::substr($input_data['module_name'],0,1));
        $model_other_str = Str::substr($input_data['module_name'],1);

        $model_name = $model_first_str.$model_other_str;

        if(Str::substr($input_data['module_name'],-1,1) == 's'){
            $model_name_without_s = Str::substr($model_name,0,-1);
        }else{
            $model_name_without_s = $model_name;
        }

        $save_controller = true;
        DB::beginTransaction();

        //更新模組資料
        $update_module = $module->update([
            'module_display_name' => $input_data['module_display_name'],
            'category_id'         => $input_data['category_id']
        ]);

        if(!$update_module) $save_controller = false;
        
        //更新模組權限
        //先刪除 
        $get_permission = Permissions::where('module_id','=',$module->id);
        
        $del_permission_id_arr = [];
        foreach($get_permission as $permission){
            $del_permission_id_arr[] = $permission->id;
        }

        $delete_permission = $get_permission->delete();
        
        if(empty($delete_permission) && $delete_permission != 0) $save_controller = false;
        
        //後新增
        if(count($input_data['permission_name']) > 1){

            for($i=0;$i<count($input_data['permission_name']);$i++){

                if(empty($input_data['permission_name'][$i]) || empty($input_data['permission_display_name'][$i])){
                    continue;
                }
                
                Permissions::create([
                    'permission_name' => $module->module_name.'_'.$input_data['permission_name'][$i],
                    'permission_display_name' => $input_data['permission_display_name'][$i],
                    'module_id' => $module->id
                ]);
            }
        }

        //再刪除已跟角色連動的權限
        $del_permission_id = implode(",",$del_permission_id_arr);
        $get_permission_role = PermissionRoles::whereIn('permission_id',array($del_permission_id));

        $delete_permission_role = $get_permission_role->delete();

        if(empty($delete_permission_role) && $delete_permission_role != 0) $save_controller = false;
        
        if(!$save_controller){
            DB::rollBack();
        }else{
            DB::commit();
        }
        
        return redirect('/backend/modules');
    }

    public function delete(Modules $module){

        $this->authorize('delete', $module);

        if(!$product->trashed()){
            $product->delete();
        }
        
        return redirect('/backend/products');
    }

    protected function create_file($input_module_name,$model_name,$model_name_without_s){

        //字首大寫、字尾有s
        $model_name_with_s_upper = $model_name;

        //字首小寫、字尾有s
        $model_name_with_s_lower = Str::lower($model_name);

        //字首大寫、字尾沒有s
        $model_name_without_s_upper = $model_name_without_s;

        //字首小寫、字尾沒有s
        $model_name_without_s_lower = Str::lower($model_name_without_s);


        //route 檔案產生 START
            $route_file_root = "../routes/modules/".$model_name."Route.php";
            
            $route_tpl = file_get_contents('../routes/route_tpl.txt');

            $route_tpl = Str::replace("{{controller_name}}",$model_name_without_s_upper."Controller",$route_tpl);
            $route_tpl = Str::replace("{{model_name_with_s_lower}}",$model_name_with_s_lower,$route_tpl);
            $route_tpl = Str::replace("{{model_name_without_s_lower}","{".$model_name_without_s_lower."}",$route_tpl);

            $new_route_file = fopen($route_file_root, "w+");
            fwrite($new_route_file,$route_tpl);
            fclose($new_route_file);
        //route 檔案產生 END

        //model 檔案產生 START
            $model_file_root = "../app/Models/".$model_name.".php";

            $model_tpl = file_get_contents('../app/Models/model_tpl.txt');
            $model_tpl = Str::replace("{{model_name_with_s_upper}}",$model_name_with_s_upper,$model_tpl);
            $model_tpl = Str::replace("{{model_name_with_s_lower}}",$model_name_with_s_lower,$model_tpl);

            $new_model_file = fopen($model_file_root, "w+");
            fwrite($new_model_file,$model_tpl);
            fclose($new_model_file);
        //model 檔案產生 END

        //controller 檔案產生 START
            $controller_file_root = "../app/Http/Controllers/".$model_name_without_s."Controller.php";

            $controller_tpl = file_get_contents('../app/Http/Controllers/controller_tpl.txt');

            $controller_tpl = Str::replace("{{controller_name}}",$model_name_without_s_upper."Controller",$controller_tpl);
            $controller_tpl = Str::replace("{{model_name_with_s_upper}}",$model_name_with_s_upper,$controller_tpl);
            $controller_tpl = Str::replace("{{model_name_without_s_lower}}",$model_name_without_s_lower,$controller_tpl);
            $controller_tpl = Str::replace("{{model_name_with_s_lower}}",$model_name_with_s_lower,$controller_tpl);

            $new_controller_file = fopen($controller_file_root, "w+");
            fwrite($new_controller_file,$controller_tpl);
            fclose($new_controller_file);
        //controller 檔案產生 END

        //view 檔案產生 START

            $view_file_root = "../resources/views/backend/modules/".$model_name_with_s_lower;

            if(!file_exists($view_file_root)){
                mkdir($view_file_root);
            }

            //列表頁
            $list_table_tpl = file_get_contents('../resources/views/backend/modules/list_table_tpl.txt');
            $list_table_tpl = Str::replace("[model_name_with_s_lower]",$model_name_with_s_lower,$list_table_tpl);

            $new_view_list_file = fopen($view_file_root."/list_table.blade.php", "w+");
            fwrite($new_view_list_file,$list_table_tpl);
            fclose($new_view_list_file);

            //編輯頁
            $edit_form_tpl = file_get_contents('../resources/views/backend/modules/edit_form_tpl.txt');
            $edit_form_tpl = Str::replace("[model_name_with_s_lower]",$model_name_with_s_lower,$edit_form_tpl);

            $new_view_edit_file = fopen($view_file_root."/edit_form.blade.php", "w+");
            fwrite($new_view_edit_file,$edit_form_tpl);
            fclose($new_view_edit_file);

        //view 檔案產生 END
    }

}
