@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        <x-admin.page-header 
            title="Dashboard"
            :breadcrumbs="[
                ['title' => 'Dashboard', 'url' => '#']
            ]">
            <x-slot name="actions">
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-download"></i> Export
                    </button>
                    <button class="btn btn-primary btn-sm">
                        <i class="fas fa-sync"></i> Refresh
                    </button>
                </div>
            </x-slot>
        </x-admin.page-header>

        <div class="dashboard-content">
            @include('components.alerts')

            {{-- Stats Cards Row --}}
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    @php
                        $logoCount = \App\Models\Logo::count();
                        $activeLogoCount = \App\Models\Logo::where('is_active', 1)->count();
                    @endphp
                    <x-admin.stats-card 
                        title="Total Logos"
                        value="{{ $logoCount }}"
                        icon="fas fa-image"
                        color="primary"
                        trend="up"
                        trend-value="{{ $activeLogoCount }} active"
                        :link="route('admin.logo.index')"
                    />
                </div>
                <div class="col-md-3">
                    <x-admin.stats-card 
                        title="Active Services"
                        value="24"
                        icon="fas fa-cogs"
                        color="success"
                        trend="neutral"
                        trend-value="No change"
                    />
                </div>
                <div class="col-md-3">
                    <x-admin.stats-card 
                        title="Team Members"
                        value="8"
                        icon="fas fa-users"
                        color="info"
                        trend="up"
                        trend-value="+1 this week"
                    />
                </div>
                <div class="col-md-3">
                    <x-admin.stats-card 
                        title="Testimonials"
                        value="45"
                        icon="fas fa-comments"
                        color="warning"
                        trend="up"
                        trend-value="+5 pending"
                    />
                </div>
            </div>

            {{-- Quick Actions & Recent Activity --}}
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-clock"></i> Recent Activity
                            </h5>
                        </div>
                        <div class="card-body">
                            @php
                                $headers = ['Action', 'Resource', 'User', 'Time'];
                                $rows = [
                                    ['<span class="badge bg-success">Created</span>', 'New Logo: Company ABC', 'Admin User', '2 hours ago'],
                                    ['<span class="badge bg-primary">Updated</span>', 'Service: Payroll Management', 'Admin User', '4 hours ago'],
                                    ['<span class="badge bg-info">Activated</span>', 'Logo: Main Company Logo', 'Admin User', '1 day ago'],
                                    ['<span class="badge bg-warning">Modified</span>', 'Team Member: John Doe', 'Admin User', '2 days ago'],
                                ];
                            @endphp

                            <x-admin.data-table 
                                :headers="$headers"
                                :rows="$rows"
                                :searchable="false"
                                :sortable="false"
                                empty-message="No recent activity"
                            />
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-rocket"></i> Quick Actions
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.logo.create') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-plus"></i> Add New Logo
                                </a>
                                <a href="#" class="btn btn-outline-success">
                                    <i class="fas fa-cog"></i> Add Service
                                </a>
                                <a href="#" class="btn btn-outline-info">
                                    <i class="fas fa-user-plus"></i> Add Team Member
                                </a>
                                <a href="#" class="btn btn-outline-warning">
                                    <i class="fas fa-comment-plus"></i> Add Testimonial
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-star"></i> Current Active Logo
                            </h5>
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
                                         class="img-fluid mb-2" 
                                         style="max-height: 80px;">
                                @endif
                                <h6>{{ $companyName }}</h6>
                                <small class="text-muted">Active Logo</small>
                            @else
                                <i class="fas fa-image fa-3x text-muted mb-2"></i>
                                <p class="text-muted">No active logo set</p>
                                <a href="{{ route('admin.logo.create') }}" class="btn btn-sm btn-primary">
                                    Set Logo
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
