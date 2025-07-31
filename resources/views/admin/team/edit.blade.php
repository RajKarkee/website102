@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Edit Team Member',
            'description' => 'Update team member information and profile',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'Team Management', 'url' => route('admin.team.index')],
                ['title' => 'Edit: ' . $team->name, 'url' => '#']
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
                        <div class="card-header bg-gradient-warning text-white">
                            <h5 class="mb-0 d-flex align-items-center">
                                <i class="fas fa-user-edit me-2"></i>
                                Update Team Member Information
                            </h5>
                        </div>
                        
                        <div class="card-body p-4">
                            <form action="{{ route('admin.team.update', $team) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
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
                                                   value="{{ old('name', $team->name) }}" 
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
                                                            {{ old('position_id', $team->position_id) == $position->id ? 'selected' : '' }}>
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
                                            'currentImage' => $team->image ? asset('storage/' . $team->image) : null,
                                            'description' => 'Update the profile photo for this team member.',
                                            'placeholder' => 'Upload New Photo'
                                        ])
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center text-muted">
                                        <i class="fas fa-info-circle me-2"></i>
                                        <small>
                                            Member since: {{ $team->created_at->format('M d, Y') }}
                                            ({{ $team->created_at->diffForHumans() }})
                                        </small>
                                    </div>
                                    
                                    <div class="btn-group">
                                        <a href="{{ route('admin.team.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fas fa-save"></i> Update Team Member
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
                                <i class="fas fa-user text-info me-2"></i>
                                Team Member Details
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                @if($team->image)
                                    <img src="{{ asset('storage/' . $team->image) }}" 
                                         alt="{{ $team->name }}"
                                         class="rounded-circle border border-3 border-light shadow"
                                         style="width: 100px; height: 100px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center mx-auto"
                                         style="width: 100px; height: 100px;">
                                        <i class="fas fa-user fa-2x text-muted"></i>
                                    </div>
                                @endif
                                <h5 class="mt-3 mb-1">{{ $team->name }}</h5>
                                <p class="text-muted small">{{ $team->position->name ?? 'No Position Assigned' }}</p>
                            </div>
                            
                            <hr>
                            
                            <div class="small text-muted">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Created:</span>
                                    <span>{{ $team->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Last Updated:</span>
                                    <span>{{ $team->updated_at->format('M d, Y') }}</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Status:</span>
                                    <span class="badge bg-success">Active</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card border-0 shadow-sm rounded-3 mt-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0 d-flex align-items-center">
                                <i class="fas fa-info-circle text-info me-2"></i>
                                Image Guidelines
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-check text-success me-2 mt-1"></i>
                                <small class="text-muted">Use high-quality professional photos</small>
                            </div>
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-check text-success me-2 mt-1"></i>
                                <small class="text-muted">Recommended size: 400x400 pixels</small>
                            </div>
                            <div class="d-flex align-items-start mb-3">
                                <i class="fas fa-check text-success me-2 mt-1"></i>
                                <small class="text-muted">Square aspect ratio works best</small>
                            </div>
                            <div class="d-flex align-items-start">
                                <i class="fas fa-check text-success me-2 mt-1"></i>
                                <small class="text-muted">Leave empty to keep current image</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
