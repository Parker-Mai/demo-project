<?php

use App\Http\Controllers\ModuleController;
Route::prefix('/modules')->group(function(){
            
    Route::get('/',[ModuleController::class , 'list']);

    Route::get('/create_page',[ModuleController::class , 'create_page']);
    Route::post('/create',[ModuleController::class , 'create']);

    Route::get('/update_page/{module}',[ModuleController::class , 'update_page']);
    Route::put('/update/{module}',[ModuleController::class , 'update']);
    
    Route::delete('/delete/{module}',[ModuleController::class , 'delete']);

});
?>