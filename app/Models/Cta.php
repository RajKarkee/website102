<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cta extends Model
{
    protected $fillable = [
        'page',
        'icon',
        'title',
        'description',
        'button1_text',
        'button1_url',
        'button2_text',
        'button2_url',
    ];
}
