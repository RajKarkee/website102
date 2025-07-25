@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        <div class="content-header fade-in">
            <h1>Add Position</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.team.index') }}">Team</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Position</li>
                </ol>
            </nav>
        </div>
        <div class="cta-admin">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">Back</a>
            </div>
            <div class="card border-primary shadow rounded-4">
                <div class="card-body">
                    <form action="{{ route('admin.position.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Position Name</label>
                            <input type="text" name="name" id="name" class="form-control" required
                                value="{{ old('name') }}" placeholder="Enter position name">
                        </div>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                            <i class="fas fa-briefcase me-2"></i> Add Position
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
