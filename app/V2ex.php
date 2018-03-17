<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class V2ex extends Model
{
    //
    use Searchable;

    //定义索引里面type值
    public function searchableAs()
    {
        return "v2ex";
    }

    //定义哪些字段需要搜索
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
}
