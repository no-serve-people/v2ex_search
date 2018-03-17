<?php

namespace App\Http\Controllers;


class PasswordController extends Controller
{

    //页面
    public function getEmail()
    {
        return view("admin.password");
    }

    //操作
    public function postEmail()
    {
//        return view("admin.password");
    }

}
