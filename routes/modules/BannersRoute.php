<?php

use App\Http\Controllers\BannerController;

Route::prefix('/banners')->group(function(){

    Route::get('/',[BannerController::class , 'list']);

    Route::get('/create_page',[BannerController::class , 'create_page']);
    Route::post('/create',[BannerController::class , 'create']);

    Route::get('/update_page/{banner}',[BannerController::class , 'update_page']);
    Route::put('/update/{banner}',[BannerController::class , 'update']);
    
    Route::delete('/delete/{banner}',[BannerController::class , 'delete']);

    Route::post('/is_show',[BannerController::class , 'is_show']);
});

?>