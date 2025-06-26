<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    protected $table = 'posts';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = [
        'title',
        'description',
        'body',
        'publish',
        'user_id',
        'post_category_id',
    ];

    /**
     * Get the category that owns the post.
     */
    public function category()
    {
        return $this->belongsTo(PostCategories::class, 'post_category_id');
    }
}
