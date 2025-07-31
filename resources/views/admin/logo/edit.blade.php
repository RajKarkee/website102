@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Edit Logo',
            'description' => 'Update company logo and branding information',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'Logo Management', 'url' => route('admin.logo.index')],
                ['title' => 'Edit: ' . $logo->company_name, 'url' => '#']
            ],
            'actions' => '<a href="' . route('admin.logo.index') . '" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Logo List
            </a>'
        ])

        <div class="logo-admin">
            @include('components.alerts')

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">Edit: {{ $logo->company_name }}</h3>
                <a href="{{ route('admin.logo.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>

            <div class="card border-primary shadow rounded-4">
                <div class="card-body">
                    <form action="{{ route('admin.logo.update', $logo) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information -->
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="text-primary mb-3">
                                    <i class="fas fa-building"></i> Company Information
                                </h5>
                                
                                <div class="form-group mb-3">
                                    <label for="company_name" class="form-label">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('company_name') is-invalid @enderror" 
                                           id="company_name" 
                                           name="company_name" 
                                           value="{{ old('company_name', $logo->company_name) }}" 
                                           required>
                                    @error('company_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="tagline" class="form-label">Tagline</label>
                                    <input type="text" 
                                           class="form-control @error('tagline') is-invalid @enderror" 
                                           id="tagline" 
                                           name="tagline" 
                                           value="{{ old('tagline', $logo->tagline) }}" 
                                           placeholder="e.g., Professional Accounting Services">
                                    @error('tagline')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="website" class="form-label">Website URL</label>
                                    <input type="url" 
                                           class="form-control @error('website') is-invalid @enderror" 
                                           id="website" 
                                           name="website" 
                                           value="{{ old('website', $logo->website) }}" 
                                           placeholder="https://www.example.com">
                                    @error('website')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                @include('admin.components.image-upload', [
                                    'name' => 'logo_image',
                                    'label' => 'Logo Image',
                                    'required' => false,
                                    'accept' => 'image/*',
                                    'maxSize' => '2MB',
                                    'previewSize' => 'medium',
                                    'currentImage' => $logo->logo_image ? asset('storage/' . $logo->logo_image) : null,
                                    'description' => 'Upload a new logo or keep the current one. Leave empty to keep existing logo.',
                                    'placeholder' => 'Upload New Logo'
                                ])

                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                           {{ old('is_active', $logo->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label d-flex align-items-center" for="is_active">
                                        <i class="fas fa-star text-warning me-2"></i>
                                        Set as Active Logo
                                    </label>
                                    <small class="form-text text-muted">The active logo will be displayed on your website</small>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Contact Information -->
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-address-book"></i> Contact Information
                        </h5>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ old('phone', $logo->phone) }}" 
                                           placeholder="+64 9 123 4567">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', $logo->email) }}" 
                                           placeholder="contact@example.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" 
                                      name="address" 
                                      rows="3" 
                                      placeholder="Enter business address">{{ old('address', $logo->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <!-- Social Media Links -->
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-share-alt"></i> Social Media Links
                        </h5>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="facebook_url" class="form-label">
                                        <i class="fab fa-facebook text-primary"></i> Facebook URL
                                    </label>
                                    <input type="url" 
                                           class="form-control @error('facebook_url') is-invalid @enderror" 
                                           id="facebook_url" 
                                           name="facebook_url" 
                                           value="{{ old('facebook_url', $logo->facebook_url) }}" 
                                           placeholder="https://facebook.com/yourpage">
                                    @error('facebook_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="instagram_url" class="form-label">
                                        <i class="fab fa-instagram text-danger"></i> Instagram URL
                                    </label>
                                    <input type="url" 
                                           class="form-control @error('instagram_url') is-invalid @enderror" 
                                           id="instagram_url" 
                                           name="instagram_url" 
                                           value="{{ old('instagram_url', $logo->instagram_url) }}" 
                                           placeholder="https://instagram.com/yourpage">
                                    @error('instagram_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="youtube_url" class="form-label">
                                        <i class="fab fa-youtube text-danger"></i> YouTube URL
                                    </label>
                                    <input type="url" 
                                           class="form-control @error('youtube_url') is-invalid @enderror" 
                                           id="youtube_url" 
                                           name="youtube_url" 
                                           value="{{ old('youtube_url', $logo->youtube_url) }}" 
                                           placeholder="https://youtube.com/yourchannel">
                                    @error('youtube_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="twitter_url" class="form-label">
                                        <i class="fab fa-twitter text-info"></i> Twitter URL
                                    </label>
                                    <input type="url" 
                                           class="form-control @error('twitter_url') is-invalid @enderror" 
                                           id="twitter_url" 
                                           name="twitter_url" 
                                           value="{{ old('twitter_url', $logo->twitter_url) }}" 
                                           placeholder="https://twitter.com/yourhandle">
                                    @error('twitter_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="linkedin_url" class="form-label">
                                        <i class="fab fa-linkedin text-primary"></i> LinkedIn URL
                                    </label>
                                    <input type="url" 
                                           class="form-control @error('linkedin_url') is-invalid @enderror" 
                                           id="linkedin_url" 
                                           name="linkedin_url" 
                                           value="{{ old('linkedin_url', $logo->linkedin_url) }}" 
                                           placeholder="https://linkedin.com/company/yourcompany">
                                    @error('linkedin_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('admin.logo.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Logo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Dropify
        $('.dropify').dropify({
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
