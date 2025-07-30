<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Logo extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'logo_image',
        'tagline',
        'phone',
        'email',
        'address',
        'website',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'youtube_url',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the active logo
     */
    public static function getActiveLogo()
    {
        return static::where('is_active', true)->first();
    }

    /**
     * Set this logo as active and deactivate all others
     */
    public function setAsActive()
    {
        static::query()->update(['is_active' => false]);
        $this->update(['is_active' => true]);
        
        // Clear logo cache when activating new logo
        \Illuminate\Support\Facades\Cache::forget('active_logo');
    }
}
