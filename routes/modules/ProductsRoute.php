<?php

use App\Http\Controllers\ProductController;
Route::prefix('/products')->group(function(){

    Route::get('/',[ProductController::class , 'list']);

    Route::get('/create_page',[ProductController::class , 'create_page']);
    Route::post('/create',[ProductController::class , 'create']);

    Route::get('/update_page/{product}',[ProductController::class , 'update_page']);
    Route::put('/update/{product}',[ProductController::class , 'update']);
    
    Route::delete('/delete/{product}',[ProductController::class , 'delete']);

    Route::post('/is_show',[ProductController::class , 'is_show']);
    Route::post('/is_popular',[ProductController::class , 'is_popular']);
});

?>