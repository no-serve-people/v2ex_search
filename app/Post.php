<?php

namespace App;

use App\Libraries\EsSearchable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * Class Post
 * @package App
 * @property string $url
 * @property string $author
 * @property string $content
 * @property string $title
 * @property string $post_date
 * @property string $created_at
 * @property string $updated_at
 */
class Post extends Model
{
    use Searchable, EsSearchable;
    protected $table = 'posts';
    protected $fillable = [
        'url',
        'author',
        'title',
        'content',
        'post_date',
        'wxname',
    ];

    public function toSearchableArray()
    {
        return [
            'author' => $this->author,
            'title' => $this->title,
            'content' => $this->content,
            'wxname' => $this->wxname,
        ];
    }
}
