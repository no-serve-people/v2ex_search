<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 'user_id'];
    public $incrementing = false;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
