@extends('admin.layout.app')
@section('content')
<main class="main-content">
    <div class="content-header fade-in">
        <h1>Middle Section</h1>
        <p class="text-muted">This is for middle section</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Middle Section</li>
            </ol>
        </nav>
    </div>
    <div class="container-Middle">
         @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
    <table class="table table-bordered table-striped" id="middleTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($middles as $index => $middle)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $middle->title }}</td>
                <td>{{ $middle->description }}</td>
                <td>{{ $middle->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('admin.middle.edit', $middle->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('admin.middle.destroy', $middle->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</main>
