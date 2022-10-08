<?php

use App\Http\Controllers\RoleController;
Route::prefix('/roles')->group(function(){
            
    Route::get('/',[RoleController::class , 'list']);

    Route::get('/create_page',[RoleController::class , 'create_page']);
    Route::post('/create',[RoleController::class , 'create']);

    Route::get('/update_page/{role}',[RoleController::class , 'update_page']);
    Route::put('/update/{role}',[RoleController::class , 'update']);
    
    Route::delete('/delete/{role}',[RoleController::class , 'delete']);

    Route::post('/disable',[RoleController::class , 'disable']);
});
?>