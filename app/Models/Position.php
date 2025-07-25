<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function teamMembers()
    {
        return $this->hasMany(Team::class, 'position_id');
    }

    // Prevent cascade delete on Team when Position is deleted
    protected static function booted()
    {
        static::deleting(function ($position) {
            \App\Models\Team::where('position_id', $position->id)->update(['position_id' => null]);
        });
    }
}
