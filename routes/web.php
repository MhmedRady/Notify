<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/l-fcm', \App\Http\Controllers\FCMController::class)->only(['create', 'store']);

Route::post('/send-notify', [\App\Http\Controllers\FCMController::class, 'sendWebNotification'])->name('send.notify');

Route::as('delivery.')->prefix('/delivery')
    ->controller(\App\Http\Controllers\Delivery\DeliveryController::class)
    ->group( function (){

    Route::middleware('guest:delivery_auth')->group(function (){
        Route::get('/login', 'login')->name('login');
        Route::post('/user-login', 'user_login')->name('user.login');
    });

    Route::middleware('auth:delivery_auth')->group(function (){
        Route::get('/', 'home')->name('home');
        Route::get('/{order}/order', 'order')->name('order');
        Route::post('/{order}/saveOrderOffer', 'saveOrderOffer')->name('save.order.offer');
        Route::get('/userOrderInfo/{order?}', 'userOrderInfo')->name('user.order');
        Route::get('/logout', 'logout')->name('logout');
    });

});

Route::as('seller.')->prefix('/seller')->controller(\App\Http\Controllers\Seller\SellerController::class)
    ->group(function (){

    Route::middleware('guest:seller_auth')->group(function (){
        Route::get('/login', 'login')->name('login');
        Route::post('/user-login', 'user_login')->name('user.login');
    });

    Route::group(['middleware' => ['auth:seller_auth']], function (){
        Route::get('/', 'home')->name('home');
        Route::get('/order', 'orders')->name('orders');
        Route::get('/orderDelivery/{id?}', 'orderDelivery')->name('orders.delivery');
        Route::get('update/orderDelivery/{id?}', 'updateOrderDelivery')->name('update.orders.delivery');
        Route::get('/logout', 'logout')->name('logout');
    });
});


