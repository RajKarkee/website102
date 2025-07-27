@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        <div class="content-header fade-in">
            <h1>Edit Testimonial</h1>
            <p class="text-muted">Update testimonial information</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.testimonials.index') }}">Testimonials</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>

        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="image" class="form-label">Image:</label><br>
                            @if ($testimonial->image)
                                <img src="{{ asset('storage/' . $testimonial->image) }}" width="80" class="mb-2">
                            @endif
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea name="description" class="form-control" required>{{ old('description', $testimonial->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="sub_description" class="form-label">Sub-description:</label>
                            <textarea name="sub_description" class="form-control">{{ old('sub_description', $testimonial->sub_description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="others" class="form-label">Others:</label>
                            <textarea name="others" class="form-control">{{ old('others', $testimonial->others) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>Status:</label><br>
                            <input type="checkbox" name="status" value="1"
                                {{ $testimonial->status ? 'checked' : '' }}>
                            <label>Enable</label>
                        </div>

                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
