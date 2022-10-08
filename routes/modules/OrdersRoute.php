<?php

use App\Http\Controllers\OrderController;
Route::prefix('/orders')->group(function(){
            
    Route::get('/',[OrderController::class , 'list']);

    Route::get('/create_page',[OrderController::class , 'create_page']);
    Route::post('/create',[OrderController::class , 'create']);

    Route::get('/update_page/{order}',[OrderController::class , 'update_page']);
    Route::put('/update/{order}',[OrderController::class , 'update']);
    
    Route::delete('/delete/{order}',[OrderController::class , 'delete']);


});
?>