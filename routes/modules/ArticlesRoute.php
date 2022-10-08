<?php

use App\Http\Controllers\ArticleController;
Route::prefix('/articles')->group(function(){

    Route::get('/',[ArticleController::class , 'list']);

    Route::get('/create_page',[ArticleController::class , 'create_page']);
    Route::post('/create',[ArticleController::class , 'create']);

    Route::get('/update_page/{article}',[ArticleController::class , 'update_page']);
    Route::put('/update/{article}',[ArticleController::class , 'update']);
    
    Route::delete('/delete/{article}',[ArticleController::class , 'delete']);

    Route::post('/disable',[ArticleController::class , 'disable'])->name('disable');
});

?>