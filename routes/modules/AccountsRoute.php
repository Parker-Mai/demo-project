<?php

use App\Http\Controllers\AccountController;
Route::prefix('/accounts')->name('accounts.')->group(function(){
            
    Route::get('/',[AccountController::class , 'list']);

    Route::get('/create_page',[AccountController::class , 'create_page'])->name('create_page');
    Route::post('/create',[AccountController::class , 'create'])->name('create');

    Route::get('/update_page/{account}',[AccountController::class , 'update_page'])->name('update_page');
    Route::put('/update/{account}',[AccountController::class , 'update'])->name('update');
    
    Route::delete('/delete/{account}',[AccountController::class , 'delete'])->name('delete');

    Route::post('/disable',[AccountController::class , 'disable'])->name('disable');
});
?>