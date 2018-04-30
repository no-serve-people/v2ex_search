<?php

namespace App;

use App\Model;

class Url extends Model
{
    protected $table = 'wxurls';
    //关闭timestamps属性
    public $timestamps = false;
}
   