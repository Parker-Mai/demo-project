<?php

use App\Http\Controllers\SysSettingController;
Route::prefix('/sys_settings')->group(function(){

    Route::get('/',[SysSettingController::class , 'edit_page']);

    Route::put('/update',[SysSettingController::class , 'update']);
    
});

?>