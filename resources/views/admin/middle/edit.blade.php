@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Add Middle Section',
            'description' => 'Create a new middle section content',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'Middle Management', 'url' => route('admin.middle.index')],
                ['title' => 'Add Middle Section', 'url' => '#']
            ],
            'actions' => '<a href="' . route('admin.middle.index') . '" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Middle
            </a>'
        ])

        <div class="middle-admin">
            @include('components.alerts')

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-header bg-gradient-primary text-white">
                            <h5 class="mb-0 d-flex align-items-center">
                                <i class="fas fa-plus-circle me-2"></i>
                                Middle Section Information
                            </h5>
                        </div>
                        
                        <div class="card-body p-4">
                            <form action="{{ route('admin.middle.update', $middle->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-4">
                                    <label for="page" class="form-label d-flex align-items-center">
                                        <i class="fas fa-file-alt text-primary me-2"></i>
                                        Page
                                        <span class="text-danger ms-1">*</span>
                                    </label>
                                    <select name="page" 
                                            id="page" 
                                            class="form-control @error('page') is-invalid @enderror" 
                                            required>
                                        <option value="">Select Page</option>
                                        <option value="home" {{ old('page', $middle->page) == 'home' ? 'selected' : '' }}>Home</option>
                                        <option value="service" {{ old('page', $middle->page) == 'service' ? 'selected' : '' }}>Service</option>
                                        <option value="about" {{ old('page', $middle->page) == 'about' ? 'selected' : '' }}>About</option>
                                        <option value="testimonial" {{ old('page', $middle->page) == 'testimonial' ? 'selected' : '' }}>Testimonial</option>
                                        <option value="team" {{ old('page', $middle->page) == 'team' ? 'selected' : '' }}>Team</option>
                                        <option value="industries" {{ old('page', $middle->page) == 'industries' ? 'selected' : '' }}>Industries</option>
                                    </select>
                                    @error('page')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
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
                                           required
                                           value="{{ old('title', $middle->title) }}" 
                                           placeholder="Enter middle section title">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="short_description" class="form-label d-flex align-items-center">
                                        <i class="fas fa-align-left text-primary me-2"></i>
                                        Short Description
                                        <span class="text-danger ms-1">*</span>
                                    </label>
                                    <textarea name="short_description" 
                                              id="short_description" 
                                              class="form-control @error('short_description') is-invalid @enderror" 
                                              rows="4" 
                                              required
                                              placeholder="Enter short description">{{ old('short_description', $middle->short_description) }}</textarea>
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                              

                                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                    <button type="submit" class="btn btn-success me-2">
                                        <i class="fas fa-save me-1"></i>
                                        Save Middle Section
                                    </button>
                                    <a href="{{ route('admin.middle.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-1"></i>
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
