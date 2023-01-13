<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Frontendcontroller;
use App\Http\Controllers\SocialiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function(){
    // return redirect('/backend/index');
    return redirect('/frontend/index');
});

Route::prefix('/frontend')->group(function(){

    // Route::get('/',function(){
    //     return redirect('/frontend/index');
    // });

    Route::get('/index',[Frontendcontroller::class , 'page_switch']);

    Route::get('/chocolate',[Frontendcontroller::class , 'page_switch']);

    Route::get('/cake',[Frontendcontroller::class , 'page_switch']);
    Route::get('/miyuki-cake',[Frontendcontroller::class , 'page_switch']);

    Route::get('/about-us',[Frontendcontroller::class , 'page_switch']);
    Route::get('/our-quality',[Frontendcontroller::class , 'page_switch']);

    Route::get('/check-out',[Frontendcontroller::class , 'page_switch'])->middleware('frontend.auth')->name('check-out');
    Route::post('/member_create_order',[OrderController::class , 'member_create_order'])->middleware('frontend.auth'); //ajax
    Route::post('/view_order_detail',[OrderController::class , 'view_order_detail'])->middleware('frontend.auth'); //ajax
    

    Route::post('/add_cart',[ProductController::class , 'add_cart']); //ajax
    Route::post('/view_cart',[ProductController::class , 'view_cart']); //ajax
    Route::post('/delete_cart',[ProductController::class , 'delete_cart']); //ajax

    Route::prefix('/member-center')->group(function(){

        Route::middleware('frontend.guest')->group(function(){

            Route::get('/login_page',[LoginController::class , 'front_login_page']);
            Route::post('/login',[LoginController::class , 'front_login']);
            Route::get('/signin_page',[LoginController::class , 'signin_page']);
            Route::post('/signin',[LoginController::class , 'signin']);

            Route::get('/google/auth', [SocialiteController::class, 'redirectToProvider']);
            Route::get('/google/auth/callback', [SocialiteController::class, 'handleProviderCallback']);

        });

        Route::middleware('frontend.auth')->group(function(){

            Route::get('/logout',[LoginController::class , 'front_logout']);
            Route::get('/profile',[Frontendcontroller::class , 'page_switch']);
            Route::get('/cart_list',[Frontendcontroller::class , 'page_switch']);
            Route::get('/order_list',[Frontendcontroller::class , 'page_switch']);

            
        });
        
    });

    

    
});

Route::prefix('/backend')->group(function(){


    Route::middleware('backend.guest')->group(function(){

        Route::get('/',function(){
            return redirect('/backend/index');
        });
        Route::get('/login_page',[LoginController::class, 'login_page'])->name('login_page');
        Route::post('/login',[LoginController::class, 'login']);

    });


    Route::middleware('backend.auth')->group(function(){

        Route::get('/index',[BackendController::class , 'index'])->name('index');

        Route::get('/logout',[LoginController::class, 'logout']);

        foreach( glob("../routes/modules/*.php") as $filename){
            require_once $filename;
        }

    });

});


// foreach( glob("../routes/module/*.php") as $filename){
//     require_once $filename;
// }
// require_once "../routes/module/TestModuleRoute.php";



