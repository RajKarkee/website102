<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'icon',
        'title',
        'description',
        'long_description',
        'points',
        'points_description',
        'point_icon',
        'icon_title',
        'icon_description'
    ];

    protected $casts = [
        'points' => 'array',
        'points_description' => 'array',
        'point_icon' => 'array',
        'icon_title' => 'array',
        'icon_description' => 'array'
    ];
}
