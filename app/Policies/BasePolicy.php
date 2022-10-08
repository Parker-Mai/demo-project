<?php

namespace App\Policies;

use App\Models\Modules;
use App\Models\Accounts;
use App\Models\Products;
use App\Models\Permissions;

use App\Models\PermissionRoles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\AuthorizationException;

class BasePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __call($action, $arguments)
    {

        if (count($arguments) < 2) {
            throw new \InvalidArgumentException('not enough arguments');
        }

        $user = $arguments[0];
        $model = $arguments[1];
        $model_name = get_class($model);
        
        $get_module = Modules::where('module_model_name', '=', $model_name)->firstOrFail();

        $module_name = $get_module->module_name;

        

        if(!$this->checkPermission($module_name.'_'.$action)){

            $this->deny();

        }else{

            return true;

        }

        
    }

    public function checkPermission($premission)
    {
        $role_id = Auth::user()->account_role;
        
        $permission_role = PermissionRoles::where('role_id','=',$role_id)->get();

        $permission_list = [];

        foreach($permission_role as $k => $v){
            $permissions = Permissions::find($v['permission_id']);

            $permission_list[] = $permissions->permission_name;
        }

        return in_array($premission, $permission_list);
    }
    
    protected function deny($message = '您沒有此操作的權限')
    {

        //throw new AuthorizationException($message);

        return redirect()->back()->with('system_message',$message)->send();
    }
}
