@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Add New Position',
            'description' => 'Create a new employee position',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'Position Management', 'url' => route('admin.position.index')],
                ['title' => 'Add Position', 'url' => '#']
            ],
            'actions' => '<a href="' . route('admin.position.index') . '" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Positions
            </a>'
        ])

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-plus me-2"></i>Add New Position
                </h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.position.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Position Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" required
                            value="{{ old('name') }}" placeholder="Enter position name (e.g., Manager, Developer, Designer)">
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.position.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add Position
                        </button>
                    </div>
                </form>
            </div>
    </main>
@endsection
