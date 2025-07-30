@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Create New Logo',
            'description' => 'Add a new company logo and branding profile to your system',
            'breadcrumbs' => [
                ['title' => 'Logo Management', 'url' => route('admin.logo.index')],
                ['title' => 'Create Logo', 'url' => '#']
            ],
            'actions' => '<a href="' . route('admin.logo.index') . '" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>'
        ])

        <div class="logo-admin">
            @include('components.alerts')
            @include('admin.layout.partials.form-fields')

            @include('admin.layout.partials.form', [
                'title' => 'Company Logo Information',
                'icon' => 'fas fa-image',
                'action' => route('admin.logo.store'),
                'method' => 'POST',
                'enctype' => 'multipart/form-data',
                'submitText' => 'Create Logo',
                'cancelUrl' => route('admin.logo.index')
            ])
                <div class="row">
                    <!-- Left Column - Basic Information -->
                    <div class="col-lg-8">
                        <div class="section-header mb-4">
                            <h6 class="text-primary fw-bold mb-3 d-flex align-items-center">
                                <i class="fas fa-building me-2"></i> Company Information
                            </h6>
                        </div>
                        
                        {!! renderTextField('company_name', 'Company Name', '', true, 'Enter your company name', 'text', '', 'fas fa-building') !!}

                        {!! renderTextField('tagline', 'Company Tagline', '', false, 'e.g., Professional Accounting Services', 'text', 'A short descriptive phrase about your company', 'fas fa-quote-right') !!}

                        {!! renderTextField('website', 'Website URL', '', false, 'https://www.example.com', 'url', '', 'fas fa-globe') !!}

                        <div class="section-header mt-4 mb-3">
                            <h6 class="text-primary fw-bold mb-3 d-flex align-items-center">
                                <i class="fas fa-address-book me-2"></i> Contact Information
                            </h6>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                {!! renderTextField('phone', 'Phone Number', '', false, '+64 9 123 4567', 'tel', '', 'fas fa-phone') !!}
                            </div>
                            <div class="col-md-6">
                                {!! renderTextField('email', 'Email Address', '', false, 'contact@example.com', 'email', '', 'fas fa-envelope') !!}
                            </div>
                        </div>

                        {!! renderTextareaField('address', 'Business Address', '', false, 'Enter your complete business address', 3, '', 'fas fa-map-marker-alt') !!}

                        <div class="section-header mt-4 mb-3">
                            <h6 class="text-primary fw-bold mb-3 d-flex align-items-center">
                                <i class="fas fa-share-alt me-2"></i> Social Media Links
                            </h6>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                {!! renderTextField('facebook_url', 'Facebook URL', '', false, 'https://facebook.com/yourpage', 'url', '', 'fab fa-facebook') !!}
                                {!! renderTextField('twitter_url', 'Twitter URL', '', false, 'https://twitter.com/yourhandle', 'url', '', 'fab fa-twitter') !!}
                                {!! renderTextField('instagram_url', 'Instagram URL', '', false, 'https://instagram.com/yourpage', 'url', '', 'fab fa-instagram') !!}
                            </div>
                            <div class="col-md-6">
                                {!! renderTextField('linkedin_url', 'LinkedIn URL', '', false, 'https://linkedin.com/company/yourcompany', 'url', '', 'fab fa-linkedin') !!}
                                {!! renderTextField('youtube_url', 'YouTube URL', '', false, 'https://youtube.com/yourchannel', 'url', '', 'fab fa-youtube') !!}
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Logo & Settings -->
                    <div class="col-lg-4">
                        <div class="sticky-top" style="top: 20px;">
                            <div class="section-header mb-4">
                                <h6 class="text-primary fw-bold mb-3 d-flex align-items-center">
                                    <i class="fas fa-image me-2"></i> Logo Upload
                                </h6>
                            </div>
                            
                            {!! renderFileField('logo_image', 'Company Logo', false, 'image/*', 'Supported formats: JPEG, PNG, JPG, GIF, SVG. Maximum size: 2MB', 'fas fa-upload') !!}

                            {!! renderCheckboxField('is_active', 'Set as Active Logo', false, 'Make this the primary logo for your website') !!}

                            <div class="alert alert-info border-0 shadow-sm">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-info-circle text-info me-2 mt-1"></i>
                                    <div class="small">
                                        <strong>Important:</strong> Only one logo can be active at a time. Setting this as active will automatically deactivate other logos.
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm bg-light">
                                <div class="card-body">
                                    <h6 class="card-title mb-3">
                                        <i class="fas fa-lightbulb text-warning me-2"></i>Upload Tips
                                    </h6>
                                    <ul class="list-unstyled small mb-0">
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Use PNG for transparent backgrounds
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Recommended size: 300x100px
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Keep file size under 2MB
                                        </li>
                                        <li>
                                            <i class="fas fa-check text-success me-2"></i>
                                            High resolution for crisp display
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @include('admin.layout.partials.form')
        </div>
    </main>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Dropify for file upload if available
        if (typeof $.fn.dropify !== 'undefined') {
            $('input[type="file"]').dropify({
                messages: {
                    default: 'Drag and drop logo image here or click to select',
                    replace: 'Drag and drop or click to replace',
                    remove: 'Remove',
                    error: 'Sorry, this file is too large'
                }
            });
        }
        
        // Form validation
        $('form').on('submit', function(e) {
            const companyName = $('input[name="company_name"]').val().trim();
            if (!companyName) {
                e.preventDefault();
                alert('Company name is required!');
                $('input[name="company_name"]').focus();
                return false;
            }
        });
    });
</script>
@endpush
