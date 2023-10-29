<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryValue extends Model
{
    use HasFactory, SoftDeletes;


    protected  $fillable = ['product_id', 'type', 'category_attribute_id', 'value'];

    public function atrribute()
    {
        return $this->belongsTo(CategoryAttribute::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
