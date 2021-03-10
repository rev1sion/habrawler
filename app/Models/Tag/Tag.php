<?php

namespace App\Models\Tag;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/** App\Models\Tag\Tag\
 *
 * @property string $name
 */
class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];


    /**
     * Get all of the posts that are assigned this tag.
     */
    public function posts()
    {
        return $this->morphedByMany('Post', 'taggable');
    }
}
