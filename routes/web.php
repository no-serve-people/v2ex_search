<?php

Route::get('/', '\App\Http\Controllers\HomeController@index');

//注册页面
Route::get('/register', '\App\Http\Controllers\RegisterController@index');
//注册行为
Route::post('/register', '\App\Http\Controllers\RegisterController@register');
//登录页面
Route::get('/login', '\App\Http\Controllers\LoginController@index')->name("login");
//登录行为
Route::post('/login', '\App\Http\Controllers\LoginController@login');
//登出操作
Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/logout', '\App\Http\Controllers\LoginController@logout');
}
);
Route::get('/search', [
    'uses' => 'PostController@search'
]);
//人民日报
Route::get('/rmrb', '\App\Http\Controllers\PostController@rmrb_index');
//关于
Route::get('/about', '\App\Http\Controllers\HomeController@about');
//引入管理员
include("admin.php");