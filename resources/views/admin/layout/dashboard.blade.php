@extends('admin.layout.app')
@section('title', 'Admin Dashboard')

@section('content')
<main class="main-content">
    <div class="content-header fade-in">
        <h1>@yield('page-title', 'Dashboard')</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'Dashboard')</li>
            </ol>
        </nav>
    </div>

    <div class="stats-cards fade-in">
        <div class="stat-card primary">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-value">1,234</div>
            <div class="stat-label">Total Users</div>
        </div>
        <div class="stat-card success">
            <div class="stat-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-value">567</div>
            <div class="stat-label">Total Orders</div>
        </div>
        <div class="stat-card warning">
            <div class="stat-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-value">890</div>
            <div class="stat-label">Products</div>
        </div>
        <div class="stat-card danger">
            <div class="stat-icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-value">$12,345</div>
            <div class="stat-label">Revenue</div>
        </div>
    </div>
</main>
@endsection