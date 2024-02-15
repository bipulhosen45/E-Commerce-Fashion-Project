<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;

class BlogCategory extends Model
{
    use HasFactory;
    protected $fillable = ['category_name','category_slug'];

    public function blog()
    {
        return $this->hasMany(Blog::class);
    }

}
