<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $guarded = [];

    protected $casts = [
        'publish_date' => 'datetime',
        'status' => 'string'
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_post_tags');
    }
}
