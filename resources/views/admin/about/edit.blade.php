@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        <div class="content-header fade-in">
            <h1>Edit About</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.about.index') }}">About</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.about.update', $aboutdata->id) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                            value="{{ old('title', $aboutdata->title) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $aboutdata->description) }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="image">Image</label>
                        @if ($aboutdata->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $aboutdata->image) }}" width="100" alt="Current Image">
                            </div>
                        @endif
                        <input type="file" name="image" id="image" class="form-control-file">
                        <small class="text-muted">Leave blank to keep existing image.</small>
                    </div>

                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('admin.about.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </main>
@endsection
