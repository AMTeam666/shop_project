<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, sluggable;
    protected $casts = ['image' => 'array'];

    protected $fillable = [
        'name',
        'introduction',
        'slug',
        'image',
        'status',
        'tags',
        'weight',
        'length',
        'width',
        'height',
        'price',
        'marketable',
        'sold_number',
        'frozen_number',
        'marketable_number',
        'brand_id',
        'category_id',
        'published_at',
    ];

    public function sluggable(): array
    {
        return [
            'slug' =>[
                'source' => 'name'
            ]
        ];
    }

    public function category(){

        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function metas()
    {
        return $this->hasMany(ProductMeta::class);
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function images()
    {
        return $this->hasMany(Gallery::class);
    }

    public function values()
    {
        return $this->hasMany(CategoryValue::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Content\Comment', 'commentable');
    }
}
