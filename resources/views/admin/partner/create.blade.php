@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Add Partner',
            'description' => 'Create a new business partner',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'Partners Management', 'url' => route('admin.partner.index')],
                ['title' => 'Add Partner', 'url' => '#']
            ],
            'actions' => '<a href="' . route('admin.partner.index') . '" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Partners
            </a>'
        ])

        @include('components.alerts')

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-gradient-primary text-white">
                        <h5 class="mb-0 d-flex align-items-center">
                            <i class="fas fa-plus-circle me-2"></i>
                            Partner Information
                        </h5>
                    </div>
                    
                    <div class="card-body p-4">
                        <form action="{{ route('admin.partner.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group mb-4">
                                <label for="name" class="form-label d-flex align-items-center">
                                    <i class="fas fa-building text-primary me-2"></i>
                                    Partner Name
                                    <span class="text-danger ms-1">*</span>
                                </label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                       required
                                       value="{{ old('name') }}" 
                                       placeholder="Enter partner name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="email" class="form-label d-flex align-items-center">
                                    <i class="fas fa-envelope text-primary me-2"></i>
                                    Partner Email
                                    <span class="text-danger ms-1">*</span>
                                </label>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       required
                                       value="{{ old('email') }}" 
                                       placeholder="Enter partner email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="logo" class="form-label d-flex align-items-center">
                                    <i class="fas fa-image text-primary me-2"></i>
                                    Partner Logo
                                </label>
                                <input type="file" 
                                       name="logo" 
                                       id="logo" 
                                       class="form-control @error('logo') is-invalid @enderror" 
                                       accept="image/*">
                                <small class="form-text text-muted">Upload an image file (JPG, PNG, GIF, etc.) - Max size: 2MB</small>
                                @error('logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <button type="submit" class="btn btn-success me-2">
                                    <i class="fas fa-save me-1"></i>
                                    Save Partner
                                </button>
                                <a href="{{ route('admin.partner.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i>
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
