<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogCategory;
use App\Models\User;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['blog_category_id', 'user_id', 'title', 'slug', 'blog_name', 'publish_date', 'thumbnail', 'tag', 'description', 'status'];

    public function blog_category()
    {
        return $this->hasMany(BlogCategory::class, 'blog_category_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
