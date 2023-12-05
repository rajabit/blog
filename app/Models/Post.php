<?php

namespace App\Models;

use App\Casts\ShortNumber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Searchable;
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

    protected $casts = [
        'created_at' => 'datetime',
        'published_at' => 'datetime',
        'views' => ShortNumber::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    #[SearchUsingPrefix(['title'])]
    #[SearchUsingFullText(['summary'])]
    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'summary' => $this->summary,
        ];
    }
}
