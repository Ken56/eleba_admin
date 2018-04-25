<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

//欢迎界面
Route::get('/', function () {
    return view('yyc_home.home');
});

//>>商品分类
Route::resource('/category','CategoryController');
//>>商家管理
Route::resource('/shop','ShopController');
//平台审核
Route::get('user/{shop}', 'ShopController@status')->name('status');
//管理员登录
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');
//>>管理员--注册
Route::resource('/admin','AdminController');
//>>管理员修改密码
Route::get('updatepwd', 'AdminController@updatepwd')->name('updatepwd');
Route::post('updatepwd_save', 'AdminController@update_pwd')->name('updatepwd_save');
//>>平台活动管理
Route::resource('/activity','ActivityController');