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

Route::get('/', 'PagesController@root')->name('root');

//Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::resource('users','UsersController',['only'=>['show','update','edit']]);

Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
//隐式路由:Laravel 会自动解析定义在路由或控制器行为中与类型提示的变量名匹配的路由段名称的 Eloquent 模型
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
//话题分类
Route::resource('categories',"CategoriesController",['only'=>['show']]);


//话题图片上传
Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

//话题回复
Route::resource('replies', 'RepliesController', ['only' => [ 'store','destroy']]);
//消息提醒
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);


//无权限
Route::get('permission-denied', 'PagesController@permissionDenied')->name('permission-denied');