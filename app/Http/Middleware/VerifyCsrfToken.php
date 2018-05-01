<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //禁用了csrf(主要避免ajax上传头像出现419(csrf)报错)
//        '*',//禁用所有中间件csrf
        'admin/upload/image',
        'admin/uploadFile',
        'admin/upload_avatar',
    ];
}
