<?php

namespace App\Models\Post;

use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/** App\Models\Post\Post\
 *
 * @property string title
 * @property string url
 * @property string body
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'body'
    ];

//    public static function create(array $fields)
//    {
//        $post = new static;
//        $post->fill($fields)->save();
//        return $post;
//    }


    /**
     * Get all of the tags for the post.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
