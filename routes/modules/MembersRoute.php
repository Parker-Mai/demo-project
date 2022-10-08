<?php

use App\Http\Controllers\MemberController;
Route::prefix('/members')->name('members.')->group(function(){
            
    Route::get('/',[MemberController::class , 'list']);

    Route::get('/create_page',[MemberController::class , 'create_page'])->name('create_page');
    Route::post('/create',[MemberController::class , 'create'])->name('create');

    Route::get('/update_page/{member}',[MemberController::class , 'update_page'])->name('update_page');
    Route::put('/update/{member}',[MemberController::class , 'update'])->name('update');
    
    Route::delete('/delete/{member}',[MemberController::class , 'delete'])->name('delete');

    Route::post('/disable',[MemberController::class , 'disable'])->name('disable');


    Route::post('/save_addresses',[MemberController::class , 'save_addresses']);
    Route::post('/delete_addresses',[MemberController::class , 'delete_addresses']);
    Route::post('/member_update_data',[MemberController::class , 'member_update_data']);

    Route::post('/make_address_data',[MemberController::class , 'make_address_data']);
});
?>