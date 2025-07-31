@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Edit Position',
            'description' => 'Update position information',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'Position Management', 'url' => route('admin.position.index')],
                ['title' => 'Edit: ' . $position->name, 'url' => '#']
            ],
            'actions' => '<a href="' . route('admin.position.index') . '" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Positions
            </a>'
        ])

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-edit me-2"></i>Edit Position: {{ $position->name }}
                </h5>
            </div>
            <div class="card-body">
                <div class="cta-admin">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">Back</a>
            </div>
            <div class="card border-primary shadow rounded-4">
                <div class="card-body">
                    <form action="{{ route('admin.position.update', $position) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Position Name</label>
                            <input type="text" name="name" id="name" class="form-control" required
                                value="{{ old('name', $position->name) }}" placeholder="Enter position name">
                        </div>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                            <i class="fas fa-briefcase me-2"></i> Update Position
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
