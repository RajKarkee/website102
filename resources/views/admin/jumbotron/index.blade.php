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
            <th>page</th>
            <th>Title</th>
        
            <th>Background Image</th>
            <th>Icon</th>
            <th>Badge</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jumbotrons as $jumbotron)
        <tr>
            
            <td>{{ $jumbotron->id }}</td>
            <td>{{ $jumbotron->page }}</td>
            <td>{{ $jumbotron->title }}</td>
      
            <td><img src="{{ asset('storage/' . $jumbotron->background_image) }}" alt="Background" style="width: 100px;"></td>
            <td><img src="{{ asset('storage/' . $jumbotron->icon) }}" alt="icon" style="width:100px;"></td>
            <td>{{ $jumbotron->badge }}</td>
            <td>
                @if($jumbotron->is_active=='1')
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Inactive</span>
                @endif
            <td>
                <a href="{{ route('admin.jumbotron.edit', $jumbotron->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <!-- Add delete functionality here -->
                <a href="{{ route('admin.jumbotron.delete',$jumbotron->id) }}" class="btn btn-sm btn-danger">Delete</a>
             <form action="{{ route('admin.jumbotron.change', $jumbotron->id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-sm {{ $jumbotron->is_active ? 'btn-secondary' : 'btn-success' }}">
        {{ $jumbotron->is_active ? 'Deactivate' : 'Activate' }}
    </button>
</form>

            </td>
        </tr>
        @endforeach
    </tbody>

  </div>


</main>


@endsection
