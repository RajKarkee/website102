@extends('admin.layout.app')
@section('content')
<main class="main-content">
    <div class="content-header fade-in">
        <h1>Jumbotron</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#">Jumbotron</a></li>
              
            </ol>
        </nav>
    </div>

  <div class="jumbotron">
<a href="{{ route('admin.jumbotron.add') }}" class="btn btn-primary mb-3">Add New Jumbotron</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>SID</th>
            <th>Title</th>
            <th>Subtitle</th>
            <th>Description</th>
            <th>Background Image</th>
            <th>Icon</th>
            <th>Badge</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jumbotrons as $jumbotron)
        <tr>
            <td>{{ $jumbotron->id }}</td>
            <td>{{ $jumbotron->title }}</td>
            <td>{{ $jumbotron->subtitle }}</td>
            <td>{{ $jumbotron->description }}</td>
            <td><img src="{{ asset('storage/' . $jumbotron->background_image) }}" alt="Background" style="width: 100px;"></td>
            <td>{!! $jumbotron->icon !!}</td>
            <td>{{ $jumbotron->badge }}</td>
            <td>
                <a href="{{ route('admin.jumbotron.edit', $jumbotron->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <!-- Add delete functionality here -->
            </td>
        </tr>
        @endforeach
    </tbody>

  </div>


</main>


@endsection
