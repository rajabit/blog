<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'summary',
        'content',
        'views',
        'published_at',
    ];
}