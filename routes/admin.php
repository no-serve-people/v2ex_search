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
    //ip路由
    Route::get('/ips', ['uses' => 'AdminController@ips', 'as' => 'admin.ips']);

    //个人中心
    Route::get('profile', 'UserController@index');
    Route::post('upload_avatar', 'UserController@UpAvatar');
    Route::post('user_info', 'UserController@saveInfo');
    Route::get('userdel', 'UserController@deleteUser');

    //友情链接
    Route::get('link', 'LinkController@index');
    Route::get('linkadd', function () {
        return view('admin.links.linkAdd');
    });
    Route::get('linkdel', 'LinkController@deleteLink');
    Route::get('linkedit/{id}', 'LinkController@edit');
    Route::post('linkadd', 'LinkController@add');
    //SEO设置
    Route::get('seo', 'SeoController@index');
    Route::post('seo/save', 'SeoController@save');
    Route::get('seo/edit', 'SeoController@edit');
    /**
     * IPS设置
     */
    Route::delete('/ip/{ip}/toggle', ['uses' => 'IpController@toggleBlock', 'as' => 'ip.block']);
    Route::delete('/ip/{ip}', ['uses' => 'IpController@destroy', 'as' => 'ip.delete']);
    /*Route::delete('/ip/{ip}/toggle', 'IpController@toggleBlock')->name('ip.block');
    Route::delete('/ip/{ip}', 'IpController@destroy')->name('ip.delete');*/
    /**
     * 搜索历史记录
     */
    Route::get('history', 'AdminController@history');
    Route::get('historydel', 'AdminController@historydel');
    /**
     * url配置
     */
    /* Route::post('urllist', 'UrlController@index');
     Route::post('urladd', 'UrlController@add');*/
    Route::get('urllist', 'UrlController@index');
    Route::get('urladd', function () {
        return view('admin/urls/urladd');
    });
    Route::get('urldel', 'UrlController@delete');
    Route::get('urledit/{id}', 'UrlController@edit');
    Route::post('urladd', 'UrlController@add');
    // 密码重置路由
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');

});