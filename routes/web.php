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
Route::resource('/shop','ShopController')->middleware('role:superadmin|admin');
//平台审核
Route::get('user/{shop}', 'ShopController@status')->name('status');
//管理员登录
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');
//>>管理员--注册 资源
Route::resource('/admin','AdminController');
//>>管理员修改密码
//shop/{shop}/edit
Route::get('admin/{admin}/updatepwd','AdminController@updatepwd')->name('updatepwd');
Route::post('admin/{admin}','AdminController@update_pwd')->name('updatepwd_save');
//>>平台活动管理
Route::resource('/activity','ActivityController')->middleware('role:superadmin|admin');
//================>>商家专用图片上传
Route::post('/upload','UploaderController@upload');
//商户端- 订单管理
Route::resource('/order','OrderController')->middleware('role:superadmin|admin');
//订单发货
Route::get('order/{order}/fahuo','OrderController@fahuo')->name('fahuo');
//订单量统计
Route::get('/dingdan','OrderController@dingdan')->name('dingdan');
//订单量统计
Route::get('/caipin','OrderController@caipin')->name('caipin');
//权限管理
Route::resource('/authority','AuthorityController')->middleware('role:superadmin|admin');
//角色管理
Route::resource('/character','CharacterController')->middleware('role:superadmin|admin');
//菜单管理
Route::resource('menu','MenuManagementController')->middleware('role:superadmin|admin');
//抽奖活动管理
Route::resource('events','EventsController')->middleware('role:superadmin|admin');
//抽奖开奖
Route::get('events/{event}/kaijiang','EventsController@kaijiang')->name('events_kaijiang');

//抽奖报名者账号
Route::get('events/{event}/eventsUser','EventsController@eventsUser')->name('eventsUser');
//奖品增删查改
Route::resource('prize','PrizeController')->middleware('role:superadmin|admin');
