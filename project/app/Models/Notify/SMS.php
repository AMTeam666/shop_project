<?php

namespace App\Models\Notify;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use illuminate\Database\Eloquent\SoftDeletingScope;

class SMS extends Model
{
    protected $table = 'public_sms';

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'status',
        'published_at',

    ];
}
