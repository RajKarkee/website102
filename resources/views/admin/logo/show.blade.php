@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        <div class="content-header fade-in">
            <h1>Logo Details</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.logo.index') }}">Logo Management</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Logo</li>
                </ol>
            </nav>
        </div>

        <div class="logo-admin">
            @include('components.alerts')

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">
                    <i class="fas fa-image text-primary"></i> {{ $logo->company_name }}
                    @if($logo->is_active)
                        <span class="badge bg-success ms-2">Active</span>
                    @endif
                </h3>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.logo.edit', $logo) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.logo.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- Logo Image Section -->
                <div class="col-md-4">
                    <div class="card border-primary shadow rounded-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-image"></i> Logo Image</h5>
                        </div>
                        <div class="card-body text-center">
                            @if($logo->logo_image)
                                <img src="{{ asset('storage/' . $logo->logo_image) }}" 
                                     alt="{{ $logo->company_name }}" 
                                     class="img-fluid rounded border p-2 mb-3" 
                                     style="max-height: 200px;">
                                <br>
                                <small class="text-muted">{{ basename($logo->logo_image) }}</small>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-image fa-4x text-muted mb-3"></i>
                                    <p class="text-muted">No logo uploaded</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="card border-info shadow rounded-4 mt-3">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0"><i class="fas fa-tools"></i> Quick Actions</h6>
                        </div>
                        <div class="card-body">
                            @if(!$logo->is_active)
                                <form action="{{ route('admin.logo.activate', $logo) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm w-100 mb-2">
                                        <i class="fas fa-check"></i> Set as Active
                                    </button>
                                </form>
                            @endif
                            
                            <form action="{{ route('admin.logo.destroy', $logo) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this logo?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">
                                    <i class="fas fa-trash"></i> Delete Logo
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Details Section -->
                <div class="col-md-8">
                    <!-- Company Information -->
                    <div class="card border-primary shadow rounded-4 mb-3">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-building"></i> Company Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3"><strong>Company Name:</strong></div>
                                <div class="col-sm-9">{{ $logo->company_name ?? 'Not provided' }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3"><strong>Tagline:</strong></div>
                                <div class="col-sm-9">{{ $logo->tagline ?? 'Not provided' }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3"><strong>Website:</strong></div>
                                <div class="col-sm-9">
                                    @if($logo->website)
                                        <a href="{{ $logo->website }}" target="_blank" class="text-primary">
                                            {{ $logo->website }} <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    @else
                                        Not provided
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3"><strong>Status:</strong></div>
                                <div class="col-sm-9">
                                    @if($logo->is_active)
                                        <span class="badge bg-success">Active Logo</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="card border-info shadow rounded-4 mb-3">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-address-book"></i> Contact Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-3"><strong>Phone:</strong></div>
                                <div class="col-sm-9">
                                    @if($logo->phone)
                                        <a href="tel:{{ $logo->phone }}" class="text-primary">
                                            <i class="fas fa-phone"></i> {{ $logo->phone }}
                                        </a>
                                    @else
                                        Not provided
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-2">
                                <div class="col-sm-3"><strong>Email:</strong></div>
                                <div class="col-sm-9">
                                    @if($logo->email)
                                        <a href="mailto:{{ $logo->email }}" class="text-primary">
                                            <i class="fas fa-envelope"></i> {{ $logo->email }}
                                        </a>
                                    @else
                                        Not provided
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3"><strong>Address:</strong></div>
                                <div class="col-sm-9">
                                    @if($logo->address)
                                        <i class="fas fa-map-marker-alt text-danger"></i> 
                                        {{ $logo->address }}
                                    @else
                                        Not provided
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media Links -->
                    <div class="card border-success shadow rounded-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-share-alt"></i> Social Media Links</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <strong><i class="fab fa-facebook text-primary"></i> Facebook:</strong><br>
                                        @if($logo->facebook_url)
                                            <a href="{{ $logo->facebook_url }}" target="_blank" class="text-primary">
                                                {{ $logo->facebook_url }} <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">Not provided</span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <strong><i class="fab fa-twitter text-info"></i> Twitter:</strong><br>
                                        @if($logo->twitter_url)
                                            <a href="{{ $logo->twitter_url }}" target="_blank" class="text-info">
                                                {{ $logo->twitter_url }} <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">Not provided</span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <strong><i class="fab fa-instagram text-danger"></i> Instagram:</strong><br>
                                        @if($logo->instagram_url)
                                            <a href="{{ $logo->instagram_url }}" target="_blank" class="text-danger">
                                                {{ $logo->instagram_url }} <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">Not provided</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <strong><i class="fab fa-linkedin text-primary"></i> LinkedIn:</strong><br>
                                        @if($logo->linkedin_url)
                                            <a href="{{ $logo->linkedin_url }}" target="_blank" class="text-primary">
                                                {{ $logo->linkedin_url }} <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">Not provided</span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <strong><i class="fab fa-youtube text-danger"></i> YouTube:</strong><br>
                                        @if($logo->youtube_url)
                                            <a href="{{ $logo->youtube_url }}" target="_blank" class="text-danger">
                                                {{ $logo->youtube_url }} <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">Not provided</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timestamps -->
            <div class="card border-secondary shadow rounded-4 mt-3">
                <div class="card-header bg-secondary text-white">
                    <h6 class="mb-0"><i class="fas fa-clock"></i> Timestamps</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Created:</strong> {{ $logo->created_at->format('M d, Y h:i A') }}
                        </div>
                        <div class="col-md-6">
                            <strong>Last Updated:</strong> {{ $logo->updated_at->format('M d, Y h:i A') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
