<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jumbotron extends Model
{
    protected $fillable = [
        'page',
        'title',
        'subtitle',
        'description',
        'background_image',
        'icon',
        'badge',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}