@extends('admin.layout.app')
@section('title', 'Admin Dashboard')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Dashboard',
            'description' => 'Welcome to your admin control panel',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => '#']
            ]
        ])

        <div class="d-flex gap-2 mb-4">
            <button class="btn btn-outline-primary btn-sm" onclick="refreshDashboard()">
                <i class="fas fa-sync"></i> Refresh
            </button>
            <button class="btn btn-primary btn-sm" onclick="exportReport()">
                <i class="fas fa-download"></i> Export
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Enhanced Stats Cards --}}
        <div class="row g-4 mb-4 fade-in">
            <div class="col-md-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-muted fw-normal mb-2">Total Logos</h6>
                                <h3 class="fw-bold text-primary mb-0">{{ \App\Models\Logo::count() }}</h3>
                                <small class="text-success">
                                    <i class="fas fa-arrow-up"></i> Active: {{ \App\Models\Logo::where('is_active', true)->count() }}
                                </small>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-image fa-2x text-primary opacity-25"></i>
                            </div>
                        </div>
                        <a href="{{ route('admin.logo.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-muted fw-normal mb-2">Active Services</h6>
                                <h3 class="fw-bold text-success mb-0">{{ \App\Models\Service::count() }}</h3>
                                <small class="text-muted">
                                    <i class="fas fa-cog"></i> Total services
                                </small>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-cogs fa-2x text-success opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-muted fw-normal mb-2">Team Members</h6>
                                <h3 class="fw-bold text-info mb-0">{{ \App\Models\Team::count() }}</h3>
                                <small class="text-success">
                                    <i class="fas fa-users"></i> Active members
                                </small>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-users fa-2x text-info opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card stat-card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="text-muted fw-normal mb-2">Testimonials</h6>
                                <h3 class="fw-bold text-warning mb-0">{{ \App\Models\Testimonial::count() }}</h3>
                                <small class="text-warning">
                                    <i class="fas fa-comments"></i> Customer reviews
                                </small>
                            </div>
                            <div class="stat-icon">
                                <i class="fas fa-comments fa-2x text-warning opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content Row --}}
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0 d-flex align-items-center">
                            <i class="fas fa-clock text-primary me-2"></i>
                            Recent Activity
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Action</th>
                                        <th>Resource</th>
                                        <th>Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // Get recent logos
                                        $recentLogos = \App\Models\Logo::latest()->take(2)->get();
                                        // Get recent services
                                        $recentServices = \App\Models\Service::latest()->take(2)->get();
                                        // Get recent testimonials
                                        $recentTestimonials = \App\Models\Testimonial::latest()->take(1)->get();
                                    @endphp
                                    
                                    @forelse($recentLogos as $logo)
                                        <tr>
                                            <td><span class="badge bg-primary">Logo</span></td>
                                            <td>{{ $logo->company_name ?: 'Company Logo' }}</td>
                                            <td><small class="text-muted">{{ $logo->created_at->diffForHumans() }}</small></td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    
                                    @forelse($recentServices as $service)
                                        <tr>
                                            <td><span class="badge bg-success">Service</span></td>
                                            <td>{{ \Str::limit($service->title, 40) ?: 'New Service' }}</td>
                                            <td><small class="text-muted">{{ $service->created_at->diffForHumans() }}</small></td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    
                                    @forelse($recentTestimonials as $testimonial)
                                        <tr>
                                            <td><span class="badge bg-warning">Testimonial</span></td>
                                            <td>{{ \Str::limit($testimonial->description, 40) ?: 'New Testimonial' }}</td>
                                            <td><small class="text-muted">{{ $testimonial->created_at->diffForHumans() }}</small></td>
                                        </tr>
                                    @empty
                                    @endforelse
                                    
                                    @if($recentLogos->isEmpty() && $recentServices->isEmpty() && $recentTestimonials->isEmpty())
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-4">
                                                <i class="fas fa-clock fa-2x mb-2"></i>
                                                <br>No recent activity
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                {{-- Quick Actions --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-gradient-success text-white border-0">
                        <h6 class="mb-0 d-flex align-items-center">
                            <i class="fas fa-rocket me-2"></i>
                            Quick Actions
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.logo.create') }}" class="btn btn-outline-primary">
                                <i class="fas fa-plus me-2"></i> Add New Logo
                            </a>
                            <button class="btn btn-outline-success" disabled>
                                <i class="fas fa-cog me-2"></i> Add Service
                                <small class="d-block">Coming Soon</small>
                            </button>
                            <button class="btn btn-outline-info" disabled>
                                <i class="fas fa-user-plus me-2"></i> Add Team Member
                                <small class="d-block">Coming Soon</small>
                            </button>
                            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-warning">
                                <i class="fas fa-comments me-2"></i> Manage Testimonials
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Current Active Logo --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-gradient-info text-white border-0">
                        <h6 class="mb-0 d-flex align-items-center">
                            <i class="fas fa-star me-2"></i>
                            Current Active Logo
                        </h6>
                    </div>
                    <div class="card-body text-center">
                        @php
                            use App\Helpers\LogoHelper;
                            $activeLogo = LogoHelper::getActiveLogo();
                            $logoImage = LogoHelper::getLogoImage();
                            $companyName = LogoHelper::getCompanyName();
                        @endphp

                        @if($activeLogo)
                            @if($logoImage)
                                <img src="{{ asset('storage/' . $logoImage) }}" 
                                     alt="{{ $companyName }}" 
                                     class="img-fluid mb-3 rounded shadow-sm" 
                                     style="max-height: 80px;">
                            @endif
                            <h6 class="fw-bold">{{ $companyName }}</h6>
                            <span class="badge bg-success">Active Logo</span>
                            <div class="mt-3">
                                <a href="{{ route('admin.logo.edit', $activeLogo) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                        @else
                            <i class="fas fa-image fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">No active logo set</h6>
                            <p class="small text-muted">Set up your company logo to enhance your brand presence</p>
                            <a href="{{ route('admin.logo.create') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Add Logo
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        .stat-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
        }
        
        .bg-gradient-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }
        
        .bg-gradient-info {
            background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .alert {
            border: none;
            border-radius: 12px;
        }
    </style>

    <script>
        function refreshDashboard() {
            window.location.reload();
        }
        
        function exportReport() {
            // Add export functionality here
            alert('Export functionality will be implemented soon!');
        }
        
        // Auto-refresh stats every 5 minutes
        setInterval(function() {
            // You can add AJAX calls here to refresh specific sections
        }, 300000);
    </script>
@endsection
