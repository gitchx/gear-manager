<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    //
    protected $fillable = [
        'name',
        'brand',
        'purchased_at',
        'price',
        'status',
        'notes',
    ];
}
