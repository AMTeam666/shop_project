<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use illuminate\Database\Eloquent\SoftDeletingScope;

class TicketPriority extends Model
{
      use HasFactory, SoftDeletes;

    protected $fillable= ['name', 'status'];


}
