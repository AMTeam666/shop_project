<?php

namespace App\Models\Market;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Market\AmazingSale;
use App\Models\Market\CategoryValue;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'age_range',
        'gender',
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
    public static $age_range = [
        0   =>  ' (تا یک سال)نوزاد',
        1   =>  '1 تا 3 سال',
        2   =>  '3 تا 5 سال',
        3   =>  '5 تا 8 سال',
        4   =>  '8 تا 12 سال',
        5 => 'تمامی سنین'
    ]; 
    public static $gender = [
        0   =>  'دخترانه',
        1   =>  'پسرانه',
        3   =>  'دخترانه و پسرانه',
    ];
    public function incrementViewCount() {
        $this->view++;
        return $this->save();
    }
    public function incrementSoldNumberCount($number) {
        $this->sold_number += $number;
        return $this->save();
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

    public function guarantees()
    {
        return $this->hasMany(Guarantee::class);
    }

    public function amazingSales()
    {
        return $this->hasMany(AmazingSale::class);
    }
    
    public function activeAmazingSale()
    {
        return $this->amazingSales()->where('created_at', '<', Carbon::now())->where('end_date', '>', Carbon::now())->first();
    }

    public function activeComments()
    {
        return $this->comments()->where('approved', 1)->whereNull('parent_id')->get();
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
