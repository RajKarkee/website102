@extends('admin.layout.app')
@section('content')
<main class="main-content">
    <div class="content-header fade-in">
        <h1>@yield('page-title', 'Jumbotron')</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.jumbotron.index') }}">jumbotron</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'Edit Jumbotron')</li>
            </ol>
        </nav>
    </div>
       <div class="jumbotron">
        <form id="jumbotronForm" method="POST" action="{{ route('admin.jumbotron.edit', $jumbotron->id) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="page-title" class="title">Page Title</label>
                <select id="page-title" name="page" class="form-control" required>
                    <option value="home" {{ $jumbotron->page == 'home' ? 'selected' : '' }}>Home</option>
                    <option value="about" {{ $jumbotron->page == 'about' ? 'selected' : '' }}>About</option>
                    <option value="industry" {{ $jumbotron->page == 'industry' ? 'selected' : '' }}>Industry</option>
                    <option value="services" {{ $jumbotron->page == 'services' ? 'selected' : '' }}>Services</option>
                    <option value="team" {{ $jumbotron->page == 'team' ? 'selected' : '' }}>Team</option>
                    <option value="testimonials" {{ $jumbotron->page == 'testimonials' ? 'selected' : '' }}>Testimonials</option>
                    <option value="resources" {{ $jumbotron->page == 'resources' ? 'selected' : '' }}>Resources</option>
                    <option value="contact" {{ $jumbotron->page == 'contact' ? 'selected' : '' }}>Contact</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" required maxlength="255" placeholder="Enter title" value="{{ $jumbotron->title }}">
            </div>
            <div class="form-group">
                <label for="subtitle" class="form-label">Subtitle</label>
                <input type="text" id="subtitle" name="subtitle" class="form-control" required maxlength="255" placeholder="Enter subtitle" value="{{ $jumbotron->subtitle }}">
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3" required maxlength="1000" placeholder="Enter description">{{ $jumbotron->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="background_image" class="form-label">Background Image</label>
                <input type="file" id="background_image" name="background_image" class="form-control" accept="image/png, image/jpeg">
                @if($jumbotron->background_image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $jumbotron->background_image) }}" alt="Current Background" style="max-width: 200px;">
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="icon" class="form-label">Icon</label>
                <input type="file" id="icon" name="icon" class="form-control" accept="image/png, image/jpeg, image/svg+xml">
                @if($jumbotron->icon)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $jumbotron->icon) }}" alt="Current Icon" style="max-width: 100px;">
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="badge" class="form-label">Badge</label>
                <input type="text" id="badge" name="badge" class="form-control" required maxlength="255" placeholder="Enter badge text" value="{{ $jumbotron->badge }}">
            </div>
            <br>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update Jumbotron</button>
            </div>
        </form>
            
    </div>
</main>
@endsection