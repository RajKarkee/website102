<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logo Helper Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .logo-info { background: #f5f5f5; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .social-links a { margin-right: 10px; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Logo Helper Usage Example</h1>
    
    @php
        use App\Helpers\LogoHelper;
        
        // Get active logo data
        $logo = LogoHelper::getActiveLogo();
        $companyName = LogoHelper::getCompanyName();
        $logoImage = LogoHelper::getLogoImage();
        $tagline = LogoHelper::getTagline();
        $website = LogoHelper::getWebsite();
        $phone = LogoHelper::getPhone();
        $email = LogoHelper::getEmail();
        $address = LogoHelper::getAddress();
        $socialLinks = LogoHelper::getSocialMediaLinks();
    @endphp
    
    <div class="logo-info">
        <h2>Active Logo Information</h2>
        
        @if($logo)
            <p><strong>Company Name:</strong> {{ $companyName ?? 'Not set' }}</p>
            <p><strong>Tagline:</strong> {{ $tagline ?? 'Not set' }}</p>
            
            @if($logoImage)
                <p><strong>Logo:</strong></p>
                <img src="{{ asset('storage/' . $logoImage) }}" alt="{{ $companyName }}" style="max-height: 100px;">
            @else
                <p><strong>Logo:</strong> No logo uploaded</p>
            @endif
            
            <p><strong>Website:</strong> 
                @if($website)
                    <a href="{{ $website }}" target="_blank">{{ $website }}</a>
                @else
                    Not set
                @endif
            </p>
            
            <p><strong>Phone:</strong> {{ $phone ?? 'Not set' }}</p>
            <p><strong>Email:</strong> 
                @if($email)
                    <a href="mailto:{{ $email }}">{{ $email }}</a>
                @else
                    Not set
                @endif
            </p>
            
            <p><strong>Address:</strong> {{ $address ?? 'Not set' }}</p>
            
            <h3>Social Media Links</h3>
            <div class="social-links">
                @if($socialLinks['facebook'])
                    <a href="{{ $socialLinks['facebook'] }}" target="_blank">Facebook</a>
                @endif
                @if($socialLinks['twitter'])
                    <a href="{{ $socialLinks['twitter'] }}" target="_blank">Twitter</a>
                @endif
                @if($socialLinks['instagram'])
                    <a href="{{ $socialLinks['instagram'] }}" target="_blank">Instagram</a>
                @endif
                @if($socialLinks['linkedin'])
                    <a href="{{ $socialLinks['linkedin'] }}" target="_blank">LinkedIn</a>
                @endif
                @if($socialLinks['youtube'])
                    <a href="{{ $socialLinks['youtube'] }}" target="_blank">YouTube</a>
                @endif
                
                @if(!array_filter($socialLinks))
                    <p>No social media links set</p>
                @endif
            </div>
        @else
            <p>No active logo found. Please set an active logo in the admin panel.</p>
            <p><a href="{{ route('admin.logo.create') }}">Create First Logo</a></p>
        @endif
    </div>
    
    <div class="logo-info">
        <h2>Helper Methods Available</h2>
        <ul>
            <li><code>LogoHelper::getActiveLogo()</code> - Get complete active logo data</li>
            <li><code>LogoHelper::getCompanyName()</code> - Get company name</li>
            <li><code>LogoHelper::getLogoImage()</code> - Get logo image path</li>
            <li><code>LogoHelper::getTagline()</code> - Get company tagline</li>
            <li><code>LogoHelper::getWebsite()</code> - Get website URL</li>
            <li><code>LogoHelper::getPhone()</code> - Get phone number</li>
            <li><code>LogoHelper::getEmail()</code> - Get email address</li>
            <li><code>LogoHelper::getAddress()</code> - Get business address</li>
            <li><code>LogoHelper::getSocialMediaLinks()</code> - Get all social media links</li>
            <li><code>LogoHelper::clearCache()</code> - Clear cached logo data</li>
        </ul>
    </div>
    
    <div class="logo-info">
        <h2>Admin Links</h2>
        <ul>
            <li><a href="{{ route('admin.logo.index') }}">Logo Management</a></li>
            <li><a href="{{ route('admin.logo.create') }}">Create New Logo</a></li>
        </ul>
    </div>
</body>
</html>
