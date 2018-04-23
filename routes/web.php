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

/*//>>商家分类列表
Route::get('category', 'Admin\AdminController@category')->name('category');
//商家添加&保存
Route::get('add', 'Admin\AdminController@add')->name('add');
Route::post('add_save', 'Admin\AdminController@add_save')->name('add_save');
//商家修改&保存
Route::get('category/{category}/edit', 'Admin\AdminController@edit')->name('edit');
Route::put('category/{category}', 'Admin\AdminController@edit_save')->name('edit_save');
//商家删除
Route::delete('category/{category}', 'Admin\AdminController@delete')->name('delete');
//>>商家注册
Route::get('register', 'Shop\ShopController@register')->name('register');
Route::post('register', 'Shop\ShopController@register_store')->name('register_store');
//>>平台---商品信息表
Route::resource('shop', 'Admin\ShopController');
//平台审核
Route::put('account/{account}', 'Admin\ShopController@review')->name('review');*///》
//>>商品分类
Route::resource('category','CategoryController');
//>>商家管理
Route::resource('shop','ShopController');
//平台审核
Route::get('user/{shop}', 'ShopController@status')->name('status');
//管理员登录
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');
//>>管理员--注册
Route::resource('admin','AdminController');
//>>管理员修改密码
Route::get('updatepwd', 'AdminController@updatepwd')->name('updatepwd');
Route::post('updatepwd_save', 'AdminController@update_pwd')->name('updatepwd_save');