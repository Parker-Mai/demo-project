<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Roles;
use App\Models\Modules;
use App\Models\Accounts;
use App\Models\Products;
use App\Policies\BasePolicy;
use Illuminate\Support\Facades\Auth;
use App\Providers\AccountsLoginProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->registerPolicies();

        $this->loadAuth();
    }

    public function loadAuth(){

        //對每個模組的model都註冊同一個權限policy(BasePolicy)
        $all_modules = Modules::all();

        foreach($all_modules as $module){
            
            $this->policies[$module->module_model_name] = BasePolicy::class;

        }

        $this->registerPolicies();

    }
}
