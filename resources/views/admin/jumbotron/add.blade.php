@extends('admin.layout.app')
@section('content')
<main class="main-content">
    <div class="content-header fade-in">
        <h1>@yield('page-title', 'Jumbotron')</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.jumbotron.index') }}">Jumbotron</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'Add Jumbotron')</li>
            </ol>
        </nav>
    </div>


    <div class="jumbotron">
        <form id="jumbotronForm" method="POST" action="{{ route('admin.jumbotron.add') }}" enctype="multipart/form-data" ">
            @csrf
            <div class="form-group">
                <label for="page-title" class="title">Page Title</label>
                <select id="page-title" name="page" class="form-control" required>
                <option value="Home">Home</option>
                <option value="About">About</option>
                <option value="Industry">Industry</option>
                <option value="Services">Services</option>
                </select>
            </div>
            <div class="form-group ">
            
            <label for="title" class="form-label">Title</label>
            <input type="text" id="title" name="title" class="form-control" required maxlength="255" placeholder="Enter title">
            </div>
            <div class="form-group ">
            <label for="subtitle" class="form-label">Subtitle</label>
            <input type="text" id="subtitle" name="subtitle" class="form-control" required maxlength="255" placeholder="Enter subtitle">
            </div>
            <div class="form-group ">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" rows="3" required maxlength="1000" placeholder="Enter description"></textarea>
            </div>
            <div class="form-group ">
            <label for="background_image" class="form-label">Background Image</label>
            <input type="file" id="background_image" name="background_image" class="form-control" accept="image/png, image/jpeg" required>
            </div>
            <div class="form-">
                <label for="icon" class="form-label">Icon</label>
                <input type="file" id="icon" name="icon" class="form-control" accept="image/png, image/jpeg, image/svg+xml" required>

            </div>
            <div class="form-group ">
            <label for="badge" class="form-label">Badge</label>
            <input type="text" id="badge" name="badge" class="form-control" required maxlength="255" placeholder="Enter badge text">
            </div>
            <br>
            <div class="d-grid">
            <button type="submit" class="btn btn-primary">Add Jumbotron</button>
            </div>
        </form>
            
    </div>
</main>
@endsection