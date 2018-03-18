<?php

//后台重定向
Route::get('admin', function () {
    return redirect('admin/dashboard');
});
// 发送密码重置链接路由
Route::get('password/email', 'PasswordController@getEmail');
Route::post('password/email', 'PasswordController@postEmail');
//后台登录验证组
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('user', 'AdminController@getUser');
    Route::get('dashboard', 'AdminController@getDashboard');
    Route::get('useredit/{id}', 'AdminController@getUserEdit');
    Route::post('authsave', 'AdminController@setUserAuth');

    //个人中心
    Route::get('profile', 'UserController@index');
    Route::post('upload_avatar', 'UserController@UpAvatar');
    Route::post('user_info', 'UserController@saveInfo');
    Route::get('userdel', 'UserController@deleteUser');

    //友情链接
    Route::get('link', 'LinkController@index');
    Route::get('linkadd', function () {
        return view('admin.linkAdd');
    });
    Route::get('linkdel', 'LinkController@deleteLink');
    Route::get('linkedit/{id}', 'LinkController@edit');
    Route::post('linkadd', 'LinkController@add');
    //SEO
    Route::get('seo', 'SeoController@index');
    Route::post('seo/save', 'SeoController@save');
    Route::get('seo/edit', 'SeoController@edit');
    // 密码重置路由
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');

});