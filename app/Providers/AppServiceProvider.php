<?php

namespace App\Providers;

use App\Models\Modules;
use App\Models\SysSettings;
use Illuminate\Support\Str;
use App\Models\ModuleCategorys;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        //更改自定義分類樣板
        Paginator::defaultView('vendor.pagination.backend-pagebar');

        //側選單!!!
        //抓所有模組
        $modules = Modules::all();

        $currentURL = URL::current();

        $out_sidebar = [];

        foreach($modules->all() as $module_model){

            if(!empty($module_model->category_id) || $module_model->category_id != 0){

                //抓模組分類的名稱
                $module_category = ModuleCategorys::find($module_model->category_id);
            
                $out_sidebar[$module_category->category_name][$module_model->module_name] = $module_model->module_display_name;

            }else{
                
                $out_sidebar['no_category'][$module_model->module_name] = $module_model->module_display_name;

            }

            if(Str::contains($currentURL,$module_model->module_name)){
                $active_category = $module_category->category_name;
                $active_module = $module_model->module_display_name;
            }
            

        }

        if(Str::contains($currentURL,'/backend/index')){
            $active_category = 'index';
            $active_module = 'index';
        }

        if(empty($active_category)) $active_category = "";
        if(empty($active_module)) $active_module = "";


        //logo
        $sys_data = SysSettings::first();

        View::share([
            'sidebar'           => $out_sidebar,
            'active_category'   => $active_category,
            'active_module'     => $active_module,
            'sys_logo'          => $sys_data['sys_logo'],
            'sys_name'          => $sys_data['sys_name'],
        ]);
    }
}
