<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
   protected $casts=[
    'point_1'=> 'array',
    'point_2'=> 'array',
    'point_3'=> 'array',
    'point_4'=> 'array',
   ];
}
