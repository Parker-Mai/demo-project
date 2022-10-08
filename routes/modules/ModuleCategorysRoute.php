<?php

use App\Http\Controllers\ModuleCategoryController;
Route::prefix('/module_categorys')->group(function(){

    Route::get('/',[ModuleCategoryController::class , 'list']);

    Route::get('/create_page',[ModuleCategoryController::class , 'create_page']);
    Route::post('/create',[ModuleCategoryController::class , 'create']);

    Route::get('/update_page/{module_category}',[ModuleCategoryController::class , 'update_page']);
    Route::put('/update/{module_category}',[ModuleCategoryController::class , 'update']);
    
    Route::delete('/delete/{module_category}',[ModuleCategoryController::class , 'delete']);
});
?>