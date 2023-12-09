<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    public $timestamps = true;
    protected $fillable = [
        'title',
        'slug',
        'subtitle',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
