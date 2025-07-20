@extends('admin.layout.app')
@section('content')
<main class="main-content">
    <div class="content-header fade-in">
        <h1>@yield('page-title', 'Service')</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'Service')</li>
            </ol>
        </nav>
    </div>
    <div class="service">
        <h1>this is service page </h1>
        <p>Welcome to the service page. Here you can manage your services.</p>
        <button class="primary-btn">Add New Service</button>
    </div>
    @endsection
