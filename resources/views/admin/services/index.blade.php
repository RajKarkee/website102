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
        <a href='{{ route('admin.service.add') }}' class="btn btn-primary mb-3">Add New Service</a>
       {{-- <table id="service-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>SID</th>
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>
                        @if($service->icon)
                            <img src="{{ asset('storage/' . $service->icon) }}" alt="Icon" style="width:40px;height:40px;border-radius:8px;">
                        @else
                            <span class="text-muted">No Icon</span>
                        @endif  
                    </td>
                    <td>{{ $service->title }}</td>
                    <td>{{ $service->description }}</td>
                    <td>
                        <a href="{{ route('admin.service.edit', $service->id) }}" class="btn btn-sm btn-warning mr-1">Edit</a>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $service->id }}">Delete</button>
                    </td>
                </tr>    --}}
    </div>
    @endsection
