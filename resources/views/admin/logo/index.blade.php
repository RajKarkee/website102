@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Logo Management',
            'description' => 'Manage your company logo and branding information',
            'breadcrumbs' => [
                ['title' => 'Logo Management', 'url' => '#']
            ],
            'actions' => '<a href="' . route('admin.logo.create') . '" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Logo
            </a>'
        ])

        <div class="logo-admin">
            @include('components.alerts')

            <!-- Logo Management Table -->
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-header bg-dark text-white">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h5 class="mb-0 d-flex align-items-center">
                                <i class="fas fa-image me-2"></i>
                                Company Logos
                            </h5>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end gap-2">
                                <input type="text" 
                                       class="form-control form-control-sm" 
                                       id="logoSearch" 
                                       placeholder="Search logos..."
                                       style="max-width: 200px;">
                                <button class="btn btn-outline-light btn-sm" onclick="exportTable()">
                                    <i class="fas fa-download"></i> Export
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="logoTable">
                        <thead class="table-light border-bottom">
                            <tr>
                                <th class="fw-semibold">#</th>
                                <th class="fw-semibold">Logo</th>
                                <th class="fw-semibold">Company Name</th>
                                <th class="fw-semibold">Tagline</th>
                                <th class="fw-semibold">Contact</th>
                                <th class="fw-semibold">Status</th>
                                <th class="fw-semibold">Created</th>
                                <th class="fw-semibold text-center" style="width: 180px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logos as $logo)
                                @include('admin.logo.partials.table-row', ['logo' => $logo, 'index' => $loop->index])
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <div class="empty-state">
                                            <i class="fas fa-image fa-3x mb-3 opacity-50"></i>
                                            <h6 class="text-muted mb-2">No logos found</h6>
                                            <p class="text-muted small">Create your first logo to get started.</p>
                                            <a href="{{ route('admin.logo.create') }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-plus"></i> Create First Logo
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($logos->count() > 0)
                    <div class="card-footer bg-light border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Showing {{ $logos->count() }} logo{{ $logos->count() !== 1 ? 's' : '' }}
                            </small>
                            <div class="d-flex gap-2">
                                <span class="badge bg-success">{{ $logos->where('is_active', true)->count() }} Active</span>
                                <span class="badge bg-secondary">{{ $logos->where('is_active', false)->count() }} Inactive</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @if($logos->count() > 0)
                <div class="mt-4">
                    <div class="card border-info border-0 shadow-sm rounded-3">
                        <div class="card-body bg-light">
                            <h6 class="card-title d-flex align-items-center mb-3">
                                <i class="fas fa-lightbulb text-warning me-2"></i> 
                                <span class="fw-bold">Quick Tips</span>
                            </h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled mb-0 small">
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Only one logo can be active at a time
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            The active logo will be used across your website
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled mb-0 small">
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Upload high-quality images for better results
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Supported formats: JPEG, PNG, JPG, GIF, SVG
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-image fa-2x mb-2"></i>
                                <h5>{{ $logos->count() }}</h5>
                                <small>Total Logos</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-check-circle fa-2x mb-2"></i>
                                <h5>{{ $logos->where('is_active', true)->count() }}</h5>
                                <small>Active</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-share-alt fa-2x mb-2"></i>
                                <h5>{{ $logos->whereNotNull('facebook_url')->count() + $logos->whereNotNull('twitter_url')->count() + $logos->whereNotNull('instagram_url')->count() }}</h5>
                                <small>With Social Links</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-phone fa-2x mb-2"></i>
                                <h5>{{ $logos->whereNotNull('phone')->count() }}</h5>
                                <small>With Contact Info</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/logo-management.js') }}"></script>
@endpush
