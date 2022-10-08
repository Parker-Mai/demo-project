<?php

use App\Http\Controllers\SitemapFrameController;

Route::prefix('/sitemap_frames')->group(function(){
            
    Route::get('/',[SitemapFrameController::class , 'list']);

    Route::get('/create_page',[SitemapFrameController::class , 'create_page']);
    Route::post('/create',[SitemapFrameController::class , 'create']);

    Route::get('/update_page/{sitemap_frame}',[SitemapFrameController::class , 'update_page']);
    Route::put('/update/{sitemap_frame}',[SitemapFrameController::class , 'update']);
    
    Route::delete('/delete/{sitemap_frame}',[SitemapFrameController::class , 'delete']);

    Route::post('/disable',[SitemapFrameController::class , 'disable']);

    Route::post('/delete_field_setting',[SitemapFrameController::class , 'delete_field_setting']);

});
?>