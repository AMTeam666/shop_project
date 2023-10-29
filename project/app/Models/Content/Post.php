<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use illuminate\Database\Eloquent\SoftDeletingScope;

/**
 * @property int|mixed $status
 */
class Post extends Model
{
    use HasFactory, SoftDeletes, sluggable;
    protected $casts = ['image' => 'array'];

    protected $fillable = [
        'title',
        'summary',
        'slug',
        'body',
        'image',
        'status',
        'tags',
        'published_at',
        'author_id',
        'category_id',
        'commentable',
    ];

    public function sluggable(): array
    {
        return [
            'slug' =>[
                'source' => 'title'
            ]
        ];
    }

    public function postCategory()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany('App\Models\Content\Comment', 'commentable');
    }
}
