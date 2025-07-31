@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Add Team Member',
            'description' => 'Create a new team member profile',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'Team Management', 'url' => route('admin.team.index')],
                ['title' => 'Add Team Member', 'url' => '#']
            ],
            'actions' => '<a href="' . route('admin.team.index') . '" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Team
            </a>'
        ])

        <div class="team-admin">
            @include('components.alerts')

            <div class="row">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-header bg-gradient-primary text-white">
                            <h5 class="mb-0 d-flex align-items-center">
                                <i class="fas fa-user-plus me-2"></i>
                                Team Member Information
                            </h5>
                        </div>
                        
                        <div class="card-body p-4">
                            <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group mb-4">
                                            <label for="name" class="form-label d-flex align-items-center">
                                                <i class="fas fa-user text-primary me-2"></i>
                                                Full Name
                                                <span class="text-danger ms-1">*</span>
                                            </label>
                                            <input type="text" 
                                                   name="name" 
                                                   id="name" 
                                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                                   required
                                                   value="{{ old('name') }}" 
                                                   placeholder="Enter team member's full name">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="position_id" class="form-label d-flex align-items-center">
                                                <i class="fas fa-briefcase text-primary me-2"></i>
                                                Position
                                                <span class="text-danger ms-1">*</span>
                                            </label>
                                            <select name="position_id" 
                                                    id="position_id" 
                                                    class="form-select form-select-lg @error('position_id') is-invalid @enderror" 
                                                    required>
                                                <option value="">Select Position</option>
                                                @foreach ($positions as $position)
                                                    <option value="{{ $position->id }}" 
                                                            {{ old('position_id') == $position->id ? 'selected' : '' }}>
                                                        {{ $position->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('position_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        @include('admin.components.image-upload', [
                                            'name' => 'image',
                                            'label' => 'Profile Image',
                                            'required' => false,
                                            'accept' => 'image/*',
                                            'maxSize' => '2MB',
                                            'previewSize' => 'medium',
                                            'description' => 'Upload a professional profile photo for the team member.',
                                            'placeholder' => 'Upload Profile Photo'
                                        ])
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="notify_creation" name="notify_creation" checked>
                                        <label class="form-check-label text-muted" for="notify_creation">
                                            <i class="fas fa-bell me-1"></i>
                                            Notify team about new member
                                        </label>
                                    </div>
                                    
                                    <div class="btn-group">
                                        <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Add Team Member
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
                                <i class="fas fa-info-circle text-info me-2"></i>
                                Quick Tips
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-check text-success me-2 mt-1"></i>
                                <small class="text-muted">Use high-quality professional photos for better presentation</small>
                            </div>
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-check text-success me-2 mt-1"></i>
                                <small class="text-muted">Recommended image size: 400x400 pixels</small>
                            </div>
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-check text-success me-2 mt-1"></i>
                                <small class="text-muted">Supported formats: JPG, PNG, GIF, SVG</small>
                            </div>
                            <div class="d-flex align-items-start">
                                <i class="fas fa-check text-success me-2 mt-1"></i>
                                <small class="text-muted">Maximum file size: 2MB</small>
                            </div>
                        </div>
                    </div>
                    
                    @if($positions->count() === 0)
                        <div class="card border-warning mt-3">
                            <div class="card-body text-center">
                                <i class="fas fa-exclamation-triangle text-warning fa-2x mb-2"></i>
                                <h6 class="text-warning">No Positions Available</h6>
                                <p class="text-muted small mb-3">You need to create positions before adding team members.</p>
                                <a href="{{ route('admin.position.create') }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-plus"></i> Create Position
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
