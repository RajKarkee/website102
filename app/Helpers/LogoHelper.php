<?php

namespace App\Helpers;

use App\Models\Logo;
use Illuminate\Support\Facades\Cache;

class LogoHelper
{
    /**
     * Get the active logo with caching
     * Cache for 1 hour (3600 seconds)
     */
    public static function getActiveLogo()
    {
        return Cache::remember('active_logo', 3600, function () {
            return Logo::getActiveLogo();
        });
    }

    /**
     * Clear logo cache
     */
    public static function clearCache()
    {
        Cache::forget('active_logo');
    }

    /**
     * Get company name
     */
    public static function getCompanyName()
    {
        $logo = self::getActiveLogo();
        return $logo ? $logo->company_name : 'Your Company';
    }

    /**
     * Get logo image URL
     */
    public static function getLogoUrl()
    {
        $logo = self::getActiveLogo();
        if ($logo && $logo->logo_image) {
            return asset('storage/' . $logo->logo_image);
        }
        return asset('images/default-logo.png'); // Default fallback
    }

    /**
     * Get logo image path (without asset URL)
     */
    public static function getLogoImage()
    {
        $logo = self::getActiveLogo();
        return $logo ? $logo->logo_image : null;
    }

    /**
     * Get tagline
     */
    public static function getTagline()
    {
        $logo = self::getActiveLogo();
        return $logo ? $logo->tagline : '';
    }

    /**
     * Get social media links
     */
    public static function getSocialLinks()
    {
        $logo = self::getActiveLogo();
        if (!$logo) return [];

        return [
            'facebook' => $logo->facebook_url,
            'twitter' => $logo->twitter_url,
            'instagram' => $logo->instagram_url,
            'linkedin' => $logo->linkedin_url,
            'youtube' => $logo->youtube_url,
        ];
    }

    /**
     * Get contact information
     */
    public static function getContactInfo()
    {
        $logo = self::getActiveLogo();
        if (!$logo) return [];

        return [
            'phone' => $logo->phone,
            'email' => $logo->email,
            'address' => $logo->address,
            'website' => $logo->website,
        ];
    }
}
