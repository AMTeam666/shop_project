<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use illuminate\Database\Eloquent\SoftDeletingScope;

class Faq extends Model
{
    use HasFactory, SoftDeletes, sluggable;

    protected $fillable = [
        'question',
        'answer',
        'slug',
        'status',
        'tags',
    ];

    public function sluggable(): array
    {
        return [
            'slug' =>[
                'source' => 'question'
            ]
        ];
    }
}
