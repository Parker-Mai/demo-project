<?php

use App\Http\Controllers\ProductCategoryController;
Route::prefix('/product_categorys')->group(function(){
        
    Route::post('/',[ProductCategoryController::class , 'list']);
    Route::post('/save',[ProductCategoryController::class , 'save']);
    Route::post('/delete',[ProductCategoryController::class , 'delete']);

});
?>