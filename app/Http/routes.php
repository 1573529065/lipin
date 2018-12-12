<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

// 前台路由
Route::group(['namespace' => 'Home'], function () {
    Route::get('/index', 'Index@index'); // 首页
    Route::get('/suppli', 'Supplier@toSupplierMgr'); //
});

// 后台路由
Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/index', 'Index@index');
    Route::get('/index/welcome', 'Index@welcome');
});
