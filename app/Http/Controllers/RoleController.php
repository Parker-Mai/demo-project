<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\Modules;
use App\Models\Permissions;
use Illuminate\Http\Request;
use App\Models\PermissionRoles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    public function list(Request $request){

        $datas = Roles::latest()->paginate(5);

        return view('backend.modules.roles.list_table',[
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
            
            $columns = Schema::getColumnListing('lm_roles'); //抓table欄位
            
            foreach($columns as $field){
                $out[$field] = "";
            }

            $permissions = Permissions::orderBy('id')->get()->groupBy(function($data){
                return $data->module_id;
            }); //抓所有權限

            // dd($permissions->all());

            //權限陣列處理
            foreach($permissions->all() as $module_id => $val){

                $modules = Modules::find($module_id);

                $module_display_name = $modules->module_display_name;

                foreach($val->all() as $key => $model_data){
                    $permission_list[$module_display_name][$model_data->id] = $model_data->permission_display_name;

                }

            }

            $out['permissions'] = $permission_list;
            $out['permission_role_list'] = [];
        }

        $out['action'] = 'create';

        return view('backend.modules.roles.edit_form',$out);
    }

    public function create(Request $request){

        $input_data = $request->all();

        $validator = Validator::make($input_data,[
            'role_name' => 'required',
        ], $messages = [
            'required' => ':attribute 欄位不得為空值',
        ],[
            'role_name' => '角色名稱',
        ]);

        if ($validator->fails()) {

            $permissions = Permissions::orderBy('id')->get()->groupBy(function($data){
                return $data->module_id;
            }); //抓所有權限

            //權限陣列處理
            foreach($permissions->all() as $module_id => $val){

                $modules = Modules::find($module_id);

                $module_display_name = $modules->module_display_name;

                foreach($val->all() as $key => $model_data){
                    $permission_list[$module_display_name][$model_data->id] = $model_data->permission_display_name;

                }

            }

            //抓選擇過的權限
            $permission_role = array_keys($input_data['permission']);

            $permission_role_list = [];
            foreach($permission_role as $val){
    
                $permission_role_list[] = $val;
                
            }

            $input_data['permissions'] = $permission_list;
            $input_data['permission_role_list'] = $permission_role_list;

            return redirect('/backend/roles/create_page')
                        ->withErrors($validator)
                        ->withInput($input_data);
        }

        //儲存角色名稱
        $save_roles = Roles::create(['role_name' => $input_data['role_name']]);

        //儲存角色權限
        if(count($input_data['permission']) > 1){

            foreach($input_data['permission'] as $permission => $value){

                if(empty($value) || $permission == 0){
                    continue;
                }
                
                PermissionRoles::create([
                    'role_id' => $save_roles->id,
                    'permission_id' => $permission
                ]);
            }

        }
        
        
        return redirect('/backend/roles');
    }

    public function update_page(Roles $role){

        if(count(old()) > 0){
            
            foreach(old() as $field => $v){
                $out[$field] = $v;
            }

        }else{
            
            $out = $role;

            $permissions = Permissions::orderBy('id')->get()->groupBy(function($data){
                return $data->module_id;
            }); //抓所有權限


            //權限陣列處理
            foreach($permissions->all() as $module_id => $val){

                $modules = Modules::find($module_id);

                $module_display_name = $modules->module_display_name;

                foreach($val->all() as $key => $model_data){
                    $permission_list[$module_display_name][$model_data->id] = $model_data->permission_display_name;

                }

            }

            //抓這個角色擁有的權限
            $permission_role = PermissionRoles::where('role_id','=',$role['id'])->get();

            $permission_role_list = [];
            foreach($permission_role->all() as $permission_role_id => $val){
    
                $permission_role_list[] = $val->permission_id;
                
            }

            $out['permissions'] = $permission_list;
            $out['permission_role_list'] = $permission_role_list;
        }

        $out['action'] = 'update/'.$role['id'];

        // dd($out);

        return view('backend.modules.roles.edit_form',$out);
    }

    public function update(Request $request,Roles $role){

        $input_data = $request->all();

        $validator = Validator::make($input_data,[
            'role_name' => 'required',
        ], $messages = [
            'required' => ':attribute 欄位不得為空值',
        ],[
            'role_name' => '角色名稱',
        ]);

        if ($validator->fails()) {

            $permissions = Permissions::orderBy('id')->get()->groupBy(function($data){
                return $data->module_id;
            }); //抓所有權限

            //權限陣列處理
            foreach($permissions->all() as $module_id => $val){

                $modules = Modules::find($module_id);

                $module_display_name = $modules->module_display_name;

                foreach($val->all() as $key => $model_data){
                    $permission_list[$module_display_name][$model_data->id] = $model_data->permission_display_name;

                }

            }

            //抓選擇過的權限
            $permission_role = array_keys($input_data['permission']);

            $permission_role_list = [];
            foreach($permission_role as $val){
    
                $permission_role_list[] = $val;
                
            }

            $input_data['permissions'] = $permission_list;
            $input_data['permission_role_list'] = $permission_role_list;

            return redirect('/backend/roles/update_page')
                        ->withErrors($validator)
                        ->withInput($input_data);
        }

       

        $save_controller = true;
        DB::beginTransaction();
        //更新角色名稱
        $update_role = $role->update(['role_name' => $input_data['role_name']]);

        if(!$update_role) $save_controller = false;
        
        //更新角色權限
        //先刪除 

        //抓該角色所有權限
        $permission_role = PermissionRoles::where('role_id','=',$role->id)->get();

        //刪除
        $delete_permission_role = PermissionRoles::where('role_id','=',$role->id)->delete();

        if(count($permission_role->toArray()) > 0){
            
            if(empty($delete_permission_role)) $save_controller = false;

        }


        //後新增
        if(count($input_data['permission']) > 1){
            foreach($input_data['permission'] as $permission => $value){

                if(empty($value) || $permission == 0){
                    continue;
                }
                
                $permission_role = new PermissionRoles;
                
                $permission_role->role_id = $role->id;
                $permission_role->permission_id = $permission;

                $create_permission_role = $permission_role->save();
                
                // $create_permission_role = PermissionRoles::create([
                //     'role_id' => $role->id,
                //     'permission_id' => $permission
                // ]);

                if(!$create_permission_role) $save_controller = false;
            }
        }
        
        if(!$save_controller){
            DB::rollBack();
        }else{
            DB::commit();
        }
        
        return redirect('/backend/roles');
    }

    public function delete(Roles $role){

        PermissionRoles::where('role_id','=',$role->id)->delete();
        $role->delete();
        
        return redirect('/backend/roles');
    }
}
