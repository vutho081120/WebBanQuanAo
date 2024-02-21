<?php

use GuzzleHttp\Middleware;
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
    return redirect('trang-chu');
});

// Site
Route::group(['namespace' => 'App\Http\Controllers\Site', 'middleware' => 'CheckUser'], function () {

    Route::get('trang-chu', 'HomeController@index')->name('site.home.index');

    Route::group(['prefix' => 'gio-hang' ,'middleware' => 'CheckCart'], function () {
        Route::get('/', 'CartController@index')->name('site.cart.index');
        Route::post('them', 'CartController@addCart')->name('site.cart.addCart');
        Route::post('xoa', 'CartController@deleteItemCart')->name('site.cart.deleteItemCart');
        Route::post('cap-nhat', 'CartController@updateItemCart')->name('site.cart.updateItemCart');
    });

    Route::group(['middleware' => 'CheckOut'], function () {
        Route::get('thanh-toan', 'CheckoutController@index')->name('site.checkout.index');
        Route::post('thanh-toan', 'CheckoutController@checkout')->name('site.checkout.checkout');
    });

    Route::get('danh-muc/{slug}', 'CategoryController@index')->name('site.category.index');

    Route::get('san-pham/{id}', 'ProductController@index')->name('site.product.index');

    Route::group(['prefix' => 'don-hang'], function () {
        Route::get('/{id}', 'OrderController@index')->name('site.order.index');

        Route::get('cap-nhat/{id}', 'OrderController@updateShow')->name('site.order.updateShow');
        Route::post('cap-nhat/{id}', 'OrderController@update')->name('site.order.update');
    });

    Route::group(['prefix' => 'dia-chi'], function () {
        Route::get('/', 'AddressController@index')->name('site.address.index');

        Route::get('them', 'AddressController@createShow')->name('site.address.createShow');
        Route::post('them', 'AddressController@create')->name('site.address.create');

        Route::get('xoa/{id}', 'AddressController@delete')->name('site.address.delete');

        Route::get('cap-nhat/{id}', 'AddressController@updateShow')->name('site.address.updateShow');
        Route::post('cap-nhat/{id}', 'AddressController@update')->name('site.address.update');

        Route::get('thay-doi/{id}', 'AddressController@select')->name('site.address.select');
        Route::get('xoa-thay-doi', 'AddressController@deleteSelect')->name('site.address.deleteSelect');

        Route::get('huyen', 'AddressController@district')->name('site.address.district');

        Route::get('phuong', 'AddressController@ward')->name('site.address.ward');
    });

    Route::group(['prefix' => 'tai-khoan'], function () {
        Route::get('cap-nhat/{id}', 'AccountController@updateShow')->name('site.account.updateShow');
        Route::post('cap-nhat/{id}', 'AccountController@update')->name('site.account.update');

        Route::post('doi-mat-khau/{id}', 'AccountController@updatePassword')->name('site.account.updatePassword');
    });

    Route::get('lien-he', 'ContactController@index')->name('site.contact.index');
    
    Route::get('chinh-sach', 'PolicyController@index')->name('site.policy.index');
});

Route::group(['namespace' => 'App\Http\Controllers\Site'], function () {
    Route::get('tim-kiem', 'SearchController@index')->name('site.search.index');
});

//Account
Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {

    Route::get('dang-xuat', 'LogoutController@logout')->name('logout');

    Route::post('dang-ky', 'SignupController@signup')->name('signup');

    Route::group(['middleware' => 'CheckLogedIn'], function () {
        Route::post('dang-nhap', 'LoginController@login')->name('login');
    });
});

// Admin
Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'CheckAdmin'], function () {

    Route::get('trang-chu', 'HomeController@index')->name('admin.home.index');

    Route::group(['prefix' => 'danh-muc'], function () {
        Route::get('/', 'CategoryController@index')->name('admin.category.index');

        Route::get('them', 'CategoryController@createShow')->name('admin.category.createShow');
        Route::post('them', 'CategoryController@create')->name('admin.category.create');

        Route::get('xoa/{id}', 'CategoryController@delete')->name('admin.category.delete');

        Route::get('cap-nhat/{id}', 'CategoryController@updateShow')->name('admin.category.updateShow');
        Route::post('cap-nhat/{id}', 'CategoryController@update')->name('admin.category.update');
    });

    Route::group(['prefix' => 'san-pham'], function () {
        Route::get('/', 'ProductController@index')->name('admin.product.index');

        Route::get('them', 'ProductController@createShow')->name('admin.product.createShow');
        Route::post('them', 'ProductController@create')->name('admin.product.create');

        Route::get('xoa/{id}', 'ProductController@delete')->name('admin.product.delete');

        Route::get('cap-nhat/{id}', 'ProductController@updateShow')->name('admin.product.updateShow');
        Route::post('cap-nhat/{id}', 'ProductController@update')->name('admin.product.update');
    });

    Route::group(['prefix' => 'hoa-don'], function () {
        Route::get('/', 'BillController@index')->name('admin.bill.index');

        Route::get('xoa/{id}', 'BillController@delete')->name('admin.bill.delete');

        Route::get('cap-nhat/{id}', 'BillController@updateShow')->name('admin.bill.updateShow');
        Route::post('cap-nhat/{id}', 'BillController@update')->name('admin.bill.update');
    });

    Route::group(['prefix' => 'nguoi-dung'], function () {
        Route::get('/', 'UserController@index')->name('admin.user.index');

        Route::get('them', 'UserController@createShow')->name('admin.user.createShow');
        Route::post('them', 'UserController@create')->name('admin.user.create');

        Route::get('xoa/{id}', 'UserController@delete')->name('admin.user.delete');

        Route::get('cap-nhat/{id}', 'UserController@updateShow')->name('admin.user.updateShow');
        Route::post('cap-nhat/{id}', 'UserController@update')->name('admin.user.update');

        Route::post('doi-mat-khau/{id}', 'UserController@updatePassword')->name('admin.user.updatePassword');
    });

    Route::group(['prefix' => 'dia-chi'], function () {
        Route::get('huyen', 'AddressController@district')->name('admin.address.district');

        Route::get('phuong', 'AddressController@ward')->name('admin.address.ward');
    });

    Route::get('track', 'TrackController@save')->name('admin.track.save');
});