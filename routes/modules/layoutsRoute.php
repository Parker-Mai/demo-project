<?php

use App\Http\Controllers\LayoutController;
Route::prefix('/layouts')->group(function(){
            
    Route::get('/',[LayoutController::class , 'list']);

    Route::get('/create_page',[LayoutController::class , 'create_page']);
    Route::post('/create',[LayoutController::class , 'create']);

    Route::get('/update_page/{layout}',[LayoutController::class , 'update_page']);
    Route::put('/update/{layout}',[LayoutController::class , 'update']);
    
    Route::delete('/delete/{layout}',[LayoutController::class , 'delete']);
});
?>