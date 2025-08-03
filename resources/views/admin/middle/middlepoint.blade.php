@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Add Middle Point',
            'description' => 'Create a new middle point for the section',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'Middle Management', 'url' => route('admin.middle.index')],
                ['title' => 'Add Middle Point', 'url' => '#']
            ],
            'actions' => '<a href="' . route('admin.middle.index') . '" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Middle
            </a>'
        ])

        <div class="middle-admin">
            @include('components.alerts')

            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-header bg-gradient-primary text-black">
                            <h5 class="mb-0 d-flex align-items-center">
                                <i class="fas fa-plus-circle me-2"></i>
                                Middle Point Information 
                            </h5>
                        </div>
                        
                        <div class="card-body p-4">
                            <form action="{{ route('admin.middle.addPoint', $middle->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group mb-4">
                                    <label for="middle_id" class="form-label d-flex align-items-center">
                                        <i class="fas fa-layer-group text-primary me-2"></i>
                                        Middle Section
                                        <span class="text-danger ms-1">*</span>
                                    </label>
                                    <p>{{ $middle->page }}</p>

                                <input type="hidden" name="middle_id" value="{{ $middle->id }}">

                                    @error('middle_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="icon" class="form-label d-flex align-items-center">
                                        <i class="fas fa-image text-primary me-2"></i>
                                        Icon
                                        <span class="text-danger ms-1">*</span>
                                    </label>
                                    <input type="file" 
                                           name="icon" 
                                           id="icon" 
                                           class="form-control @error('icon') is-invalid @enderror" 
                                           accept="image/*"
                                           required>
                                    <small class="form-text text-muted">Upload an icon image (max 400 characters path)</small>
                                    @error('icon')
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
                                           value="{{ old('title') }}" 
                                           placeholder="Enter point title">
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
                                    <input type="text" 
                                           name="description" 
                                           id="description" 
                                           class="form-control @error('description') is-invalid @enderror" 
                                           required
                                           value="{{ old('description') }}" 
                                           placeholder="Enter point description">
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                    <button type="submit" class="btn btn-success me-2">
                                        <i class="fas fa-save me-1"></i>
                                        Save Middle Point
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
