@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Edit About Section',
            'description' => 'Update company about information and imagery',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'About Management', 'url' => route('admin.about.index')],
                ['title' => 'Edit About', 'url' => '#']
            ],
            'actions' => '<a href="' . route('admin.about.index') . '" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to About
            </a>'
        ])

        <div class="about-admin">
            @include('components.alerts')

            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-header bg-gradient-info text-white">
                            <h5 class="mb-0 d-flex align-items-center">
                                <i class="fas fa-edit me-2"></i>
                                Update About Information
                            </h5>
                        </div>
                        
                        <div class="card-body p-4">
                            <form action="{{ route('admin.about.update', $aboutdata->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group mb-4">
                                            <label for="title" class="form-label d-flex align-items-center">
                                                <i class="fas fa-heading text-primary me-2"></i>
                                                Title
                                                <span class="text-danger ms-1">*</span>
                                            </label>
                                            <input type="text" 
                                                   name="title" 
                                                   id="title" 
                                                   class="form-control form-control-lg @error('title') is-invalid @enderror"
                                                   value="{{ old('title', $aboutdata->title) }}" 
                                                   required
                                                   placeholder="Enter a compelling title for your about section">
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="description" class="form-label d-flex align-items-center">
                                                <i class="fas fa-align-left text-primary me-2"></i>
                                                Description
                                                <span class="text-danger ms-1">*</span>
                                            </label>
                                            <textarea name="description" 
                                                      id="description" 
                                                      class="form-control @error('description') is-invalid @enderror" 
                                                      rows="6" 
                                                      required
                                                      placeholder="Write a detailed description about your company, values, mission, and what makes you unique...">{{ old('description', $aboutdata->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">
                                                <small class="text-muted">
                                                    <i class="fas fa-info-circle me-1"></i>
                                                    Keep it engaging and informative. This will be displayed prominently on your website.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        @include('admin.components.image-upload', [
                                            'name' => 'image',
                                            'label' => 'About Image',
                                            'required' => false,
                                            'accept' => 'image/*',
                                            'maxSize' => '5MB',
                                            'previewSize' => 'large',
                                            'currentImage' => $aboutdata->image ? asset('storage/' . $aboutdata->image) : null,
                                            'description' => 'Upload an image that represents your company or team.',
                                            'placeholder' => 'Upload About Image'
                                        ])
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center text-muted">
                                        <i class="fas fa-clock me-2"></i>
                                        <small>
                                            Last updated: {{ $aboutdata->updated_at->format('M d, Y \a\t g:i A') }}
                                        </small>
                                    </div>
                                    
                                    <div class="btn-group">
                                        <a href="{{ route('admin.about.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-info">
                                            <i class="fas fa-save"></i> Update About Section
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0 d-flex align-items-center">
                                <i class="fas fa-eye text-info me-2"></i>
                                Current Preview
                            </h6>
                        </div>
                        <div class="card-body">
                            @if($aboutdata->image)
                                <div class="text-center mb-3">
                                    <img src="{{ asset('storage/' . $aboutdata->image) }}" 
                                         alt="{{ $aboutdata->title }}"
                                         class="img-fluid rounded shadow-sm"
                                         style="max-height: 200px; object-fit: cover;">
                                </div>
                            @else
                                <div class="text-center mb-3 p-4 bg-light rounded">
                                    <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                    <p class="text-muted small mb-0">No image uploaded</p>
                                </div>
                            @endif
                            
                            <h6 class="mb-2">{{ $aboutdata->title }}</h6>
                            <p class="text-muted small">
                                {{ Str::limit($aboutdata->description, 120) }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="card border-0 shadow-sm rounded-3 mt-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0 d-flex align-items-center">
                                <i class="fas fa-lightbulb text-warning me-2"></i>
                                Content Tips
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-check text-success me-2 mt-1"></i>
                                <small class="text-muted">Use clear, concise language that reflects your brand voice</small>
                            </div>
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-check text-success me-2 mt-1"></i>
                                <small class="text-muted">Include your mission, values, and what sets you apart</small>
                            </div>
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-check text-success me-2 mt-1"></i>
                                <small class="text-muted">Choose high-quality images that represent your company</small>
                            </div>
                            <div class="d-flex align-items-start">
                                <i class="fas fa-check text-success me-2 mt-1"></i>
                                <small class="text-muted">Keep the description engaging but not too lengthy</small>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-3 mt-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0 d-flex align-items-center">
                                <i class="fas fa-chart-line text-success me-2"></i>
                                Section Statistics
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="border-end">
                                        <h4 class="text-primary mb-1">{{ str_word_count($aboutdata->description) }}</h4>
                                        <small class="text-muted">Words</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h4 class="text-info mb-1">{{ strlen($aboutdata->description) }}</h4>
                                    <small class="text-muted">Characters</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
