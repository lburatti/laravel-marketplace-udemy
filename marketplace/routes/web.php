<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StoreController;
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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');
Route::get('/category/{slug}', 'CategoryController@index')->name('category.single');
Route::get('/store/{slug}', 'StoreController@index')->name('store.single');

Route::prefix('cart')->group(function () {
    Route::get('/', 'CartController@index')->name('cart.index');
    Route::post('add', 'CartController@add')->name('cart.add');
    Route::get('remove/{slug}', 'CartController@remove')->name('cart.remove');
    Route::get('cancel', 'CartController@cancel')->name('cart.cancel');
});

Route::prefix('checkout')->group(function () {
    Route::get('/', 'CheckoutController@index')->name('checkout.index');
    Route::post('/proccess', 'CheckoutController@proccess')->name('checkout.proccess');
    Route::get('/thanks', 'CheckoutController@thanks')->name('checkout.thanks');

    Route::post('/notification', 'CheckoutController@notification')->name('checkout.notification');
});

// PROFILE_USER
Route::get('my-orders', 'UserOrderController@index')->name('user.orders')->middleware('auth');
// PROFILE_STORE
Route::group(['middleware' => ['auth', 'access.control.store.admin']], function () {    
    // Admin -> com usuário logado
    Route::prefix('admin')->namespace('Admin')->group(function () {
        Route::get('notifications', 'NotificationController@notifications')->name('notifications.index');
        Route::get('notifications/read-all', 'NotificationController@readAll')->name('notifications.readAll');
        Route::get('notifications/read/{notification}', 'NotificationController@read')->name('notifications.read');
        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');
        Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');
        Route::get('orders/my', 'OrdersController@index')->name('orders.my');
    });
});

Auth::routes();

Route::get('not', function() {
    // $user = \App\User::find(21);
    // TESTE: CRIANDO NOVA NOTIFICAÇÃO
    // $user->notify(new \App\Notifications\StoreReceiveNewOrder());

    // TESTE: PARA MARCAR COMO LIDA
    // $notification = $user->notifications->first();
    // $notification->markAsRead();

    // TESTE: TRAZER QUANTIDADE DE NOTIFICAÇÕES Não Lidas
    // return $user->unreadNotifications->count();    

    // return $user->unreadNotifications;
});