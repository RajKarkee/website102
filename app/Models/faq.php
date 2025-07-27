<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['question', 'answer', 'status'];

    /**
     * Get a human-readable status label.
     *
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        return $this->getRawOriginal('status') ? 'Active' : 'Inactive';
    }

    /**
     * Scope for active FAQs.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}