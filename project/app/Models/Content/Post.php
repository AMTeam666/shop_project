<?php

namespace App\Models\Content;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function user(){
        return $this->belongsTo(User::class, 'author_id');
    }
 
    public function comments(): MorphMany
    {
        return $this->morphMany('App\Models\Content\Comment', 'commentable');
    }
    public function incrementViewCount() {
        $this->view++;
        return $this->save();
    }

    public function activeComments()
    {
        return $this->comments()->where('approved', 1)->whereNull('parent_id')->get();
    }
}
