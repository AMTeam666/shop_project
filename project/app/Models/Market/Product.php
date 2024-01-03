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
        'user_id',
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
        1   =>  ' (تا یک سال)نوزاد',
        2   =>  '1 تا 3 سال',
        3   =>  '3 تا 5 سال',
        4   =>  '5 تا 8 سال',
        5   =>  '8 تا 12 سال',
        6 => 'تمامی سنین'
    ]; 
    public static $gender = [
        1   =>  'دخترانه',
        2   =>  'پسرانه',
        3   =>  'دخترانه و پسرانه',
    ];
    public function incrementViewCount() {
        $this->view++;
        return $this->save();
    }
    public function incrementSoldNumberCount($number) {
        $this->sold_number += $number;
        $this->marketable_number -= $number;
        return $this->save();
    }
    public function incrementFrozenNumberCount($number) {
        $this->frozen_number += $number;
        return $this->save();
    }
    public function decreaseFrozenNumberCount($number) {
        $this->frozen_number -= $number;
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

    public function store(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
