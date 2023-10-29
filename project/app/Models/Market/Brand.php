<?php

namespace App\Models\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes, sluggable;

    protected $casts = ['logo' => 'array'];


    protected $fillable =['persian_name', 'original_name', 'logo', 'slug', 'tags'];

    public function sluggable(): array
    {
        return [
            'slug' =>[
                'source' => 'name'
            ]
        ];
    }

    public function products(){

        return $this->hasMany(Product::class);
    }
}
