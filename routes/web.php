<?php

use App\Shop;
use App\User;
use App\Order;
use App\Product;
use App\Reseller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

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
// dd(Order::find(2)->data);
Route::get('/', function (Request $request) {
    return view('welcome');
});

Route::get('getpass', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('getpass', 'Auth\LoginController@login')->name('login');
Auth::routes(['register' => true]);
Route::match(['get', 'post'], '/login', function(){
    return abort('404');
});

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::group(['prefix' => 'reseller', 'as' => 'reseller.'], function(){
    Route::group(['namespace' => 'Reseller'], function(){
        Auth::routes(['verify' => true]);
        Route::get('/dashboard', 'HomeController@index')->name('home');
    });

    Route::resource('shops', 'ShopController');
});


Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
    Route::resource('images', 'ImageController');
    Route::get('orders', 'OrderController@index')->name('order.index');
    Route::get('order/{order}', 'OrderController@show')->name('order.show');
    Route::post('order/{order}/update', 'OrderController@update')->name('order.update');
    Route::get('order/{order}/invoice', 'OrderController@invoice')->name('order.invoice');

    Route::get('/transactions/pay', 'TransactionController@pay')->name('transactions.pay');
    Route::get('/transactions/pay/{reseller}', 'TransactionController@payToReseller')->name('transactions.pay-to-reseller');
    Route::post('/transactions/pay/store', 'TransactionController@store')->name('transactions.pay.store');
    Route::get('/transactions/history', 'TransactionController@index')->name('transactions.index');
    Route::get('/transactions/requests', 'TransactionController@requests')->name('transactions.requests');

    Route::resource('images', 'ImageController');
    Route::get('/notifications', 'NotificationController@index')->name('notifications.index');
    Route::patch('/notifications/read/{notification?}', 'NotificationController@update')->name('notifications.update');
    Route::delete('/notifications/destroy/{notification?}', 'NotificationController@destroy')->name('notifications.destroy');

    Route::get('/resellers', 'ResellerController')->name('resellers');

    Route::get('/pages', 'PageController@index')->name('pages.index');
    Route::get('/pages/create', 'PageController@create')->name('pages.create');
    Route::post('/pages/create', 'PageController@store')->name('pages.store');
    Route::get('/pages/{page:slug}/edit', 'PageController@edit')->name('pages.edit');
    Route::patch('/pages/{page:slug}/edit', 'PageController@update')->name('pages.update');
    Route::delete('/pages/{page:slug}/delete', 'PageController@destroy')->name('pages.destroy');
});

Route::get('/page/{page:slug}', 'PageController@show')->name('page.show');

Route::group(['middleware' => 'auth:reseller'], function(){
    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::get('/cart/clear', 'CartController@clear')->name('cart.clear');
    Route::post('/cart/add/{product}', 'CartController@add')->name('cart.add');
    Route::delete('/cart/remove/{product}', 'CartController@remove')->name('cart.remove');
    Route::get('/checkout', 'CartController@checkout')->name('cart.checkout');
    
});




Route::group(['middleware' => 'auth:reseller', 'namespace' => 'Reseller', 'prefix' => 'reseller', 'as' => 'reseller.'], function() {
    Route::get('/products/category/{slug}/id/{category}', 'ProductController@index')->name('product.by-category');
    Route::get('/products', 'ProductController@index')->name('product.index');
    Route::get('/product/{product:slug}', 'ProductController@show')->name('product.show');


    Route::get('/orders', 'OrderController@index')->name('order.index');
    Route::post('/order/store', 'OrderController@store')->name('order.store');
    Route::get('order/{order}', 'OrderController@show')->name('order.show');
    Route::get('order/{order}/invoice', 'OrderController@invoice')->name('order.invoice');
    Route::delete('order/{order}/delete', 'OrderController@destroy')->name('order.destroy');
    
    
    Route::get('/transactions/history', 'TransactionController@index')->name('transactions.index');
    Route::get('/transactions/request', 'TransactionController@request')->name('transactions.request');
    Route::post('/transactions/request', 'TransactionController@store')->name('transactions.store');

    Route::get('/setting', 'SettingController@edit')->name('setting.edit');
    Route::patch('/setting', 'SettingController@update')->name('setting.update');

    Route::patch('/password', 'PasswordController@update')->name('password.update');

    Route::get('/profile/{reseller}', 'ProfileController')->name('profile.show');
    Route::get('/notifications', 'NotificationController@index')->name('notifications.index');
    Route::patch('/notifications/read/{notification?}', 'NotificationController@update')->name('notifications.update');
    Route::delete('/notifications/destroy/{notification?}', 'NotificationController@destroy')->name('notifications.destroy');
});

MenuBuilder::routes();
