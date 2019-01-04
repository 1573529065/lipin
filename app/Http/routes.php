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
    Route::get('/index', 'Index@index');    // 首页
    Route::get('/index/toPub', 'Index@toPub'); // 需求发布
    Route::get('/bill/Bill', 'Bill@Bill'); // 验证用户是否认证


    Route::get('/suppli', 'Supplier@toSupplierMgr'); // 供应商库


    Route::get('/vcom/toVcoms', 'Vcom@toVcoms'); // 拜访采购首页


    Route::get('/ucenter/toCenter', 'Ucenter@toCenter'); // 发布采购首页


    /******   个人中心   *******/
    Route::get('user/logout', 'User@logout');
    Route::get('user/hasRealize', 'User@hasRealize'); // 验证用户是否认证

    Route::post('user/registerUser', 'User@registerUser');
    Route::get('user/toRegister', 'User@toRegister');   // 注册
    Route::get('user/toForgotMM', 'User@toForgotMM');   // 忘记密码


});

// 后台路由
Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/index', 'Index@index');
    Route::get('/index/welcome', 'Index@welcome');
});
