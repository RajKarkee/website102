@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        <x-admin.page-header 
            title="Create New Logo"
            :breadcrumbs="[
                ['title' => 'Logo Management', 'url' => route('admin.logo.index')],
                ['title' => 'Create Logo', 'url' => '#']
            ]">
            <x-slot name="actions">
                <a href="{{ route('admin.logo.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </x-slot>
        </x-admin.page-header>

        <div class="logo-admin">
            @include('components.alerts')

            <x-admin.form-card 
                title="Company Logo Information"
                subtitle="Create a new company logo and branding profile"
                icon="fas fa-image"
                :action="route('admin.logo.store')"
                method="POST"
                enctype="multipart/form-data"
                submit-text="Create Logo"
                :cancel-url="route('admin.logo.index')">
                
                <div class="row">
                    <!-- Left Column - Basic Information -->
                    <div class="col-md-8">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-building"></i> Company Information
                        </h6>
                        
                        <x-admin.form-field 
                            name="company_name"
                            label="Company Name"
                            :required="true"
                            icon="fas fa-building"
                            placeholder="Enter company name"
                        />

                        <x-admin.form-field 
                            name="tagline"
                            label="Tagline"
                            icon="fas fa-quote-right"
                            placeholder="e.g., Professional Accounting Services"
                            help="A short descriptive phrase about your company"
                        />

                        <x-admin.form-field 
                            name="website"
                            type="url"
                            label="Website URL"
                            icon="fas fa-globe"
                            placeholder="https://www.example.com"
                        />

                        <h6 class="text-primary mb-3 mt-4">
                            <i class="fas fa-address-book"></i> Contact Information
                        </h6>

                        <div class="row">
                            <div class="col-md-6">
                                <x-admin.form-field 
                                    name="phone"
                                    type="tel"
                                    label="Phone Number"
                                    icon="fas fa-phone"
                                    placeholder="+64 9 123 4567"
                                />
                            </div>
                            <div class="col-md-6">
                                <x-admin.form-field 
                                    name="email"
                                    type="email"
                                    label="Email Address"
                                    icon="fas fa-envelope"
                                    placeholder="contact@example.com"
                                />
                            </div>
                        </div>

                        <x-admin.form-field 
                            name="address"
                            type="textarea"
                            label="Business Address"
                            icon="fas fa-map-marker-alt"
                            placeholder="Enter your business address"
                            :rows="3"
                        />
                    </div>

                    <!-- Right Column - Logo & Settings -->
                    <div class="col-md-4">
                        <h6 class="text-primary mb-3">
                            <i class="fas fa-image"></i> Logo Image
                        </h6>
                        
                        <x-admin.form-field 
                            name="logo_image"
                            type="file"
                            label="Upload Logo"
                            accept="image/*"
                            help="Supported formats: JPEG, PNG, JPG, GIF, SVG. Max size: 2MB"
                        />

                        <x-admin.form-field 
                            name="is_active"
                            type="checkbox"
                            label="Set as Active Logo"
                            placeholder="Make this the active logo for your website"
                        />

                        <div class="alert alert-info mt-3">
                            <small>
                                <i class="fas fa-info-circle"></i>
                                <strong>Note:</strong> Only one logo can be active at a time. Setting this as active will deactivate other logos.
                            </small>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <!-- Social Media Links -->
                <h6 class="text-primary mb-3">
                    <i class="fas fa-share-alt"></i> Social Media Links
                </h6>

                <div class="row">
                    <div class="col-md-6">
                        <x-admin.form-field 
                            name="facebook_url"
                            type="url"
                            label="Facebook URL"
                            icon="fab fa-facebook"
                            placeholder="https://facebook.com/yourpage"
                        />

                        <x-admin.form-field 
                            name="twitter_url"
                            type="url"
                            label="Twitter URL"
                            icon="fab fa-twitter"
                            placeholder="https://twitter.com/yourhandle"
                        />

                        <x-admin.form-field 
                            name="instagram_url"
                            type="url"
                            label="Instagram URL"
                            icon="fab fa-instagram"
                            placeholder="https://instagram.com/yourpage"
                        />
                    </div>

                    <div class="col-md-6">
                        <x-admin.form-field 
                            name="linkedin_url"
                            type="url"
                            label="LinkedIn URL"
                            icon="fab fa-linkedin"
                            placeholder="https://linkedin.com/company/yourcompany"
                        />

                        <x-admin.form-field 
                            name="youtube_url"
                            type="url"
                            label="YouTube URL"
                            icon="fab fa-youtube"
                            placeholder="https://youtube.com/yourchannel"
                        />
                    </div>
                </div>
            </x-admin.form-card>
        </div>
    </main>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Dropify for file upload
        $('input[type="file"]').dropify({
            messages: {
                default: 'Drag and drop logo image here or click to select',
                replace: 'Drag and drop or click to replace',
                remove: 'Remove',
                error: 'Sorry, this file is too large'
            }
        });
    });
</script>
@endpush
