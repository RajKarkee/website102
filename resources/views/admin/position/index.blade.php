@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Position Management',
            'description' => 'Manage employee positions and roles',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'Position Management', 'url' => '#']
            ],
            'actions' => '<div class="btn-group">
                <a href="' . route('admin.position.create') . '" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Position
                </a>
                <a href="' . route('admin.team.index') . '" class="btn btn-outline-secondary">
                    <i class="fas fa-users"></i> Back to Team
                </a>
            </div>'
        ])

        @if (session('success'))
            @include('admin.layout.partials.alert', ['type' => 'success', 'message' => session('success')])
        @endif

        <div class="card shadow-sm">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-briefcase me-2"></i>Positions List
                    </h5>
                    <form method="GET" class="d-flex gap-2 align-items-center">
                        <select name="sort" class="form-select form-select-sm">
                            <option value="">Sort By</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-outline-primary">Apply</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                @if ($positions->count())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 40px;">#</th>
                                    <th>Position Name</th>
                                    <th>Team Members</th>
                                    <th style="width: 140px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($positions as $position)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $position->name }}</div>
                                        </td>
                                        <td>
                                            @if($position->teams_count ?? 0 > 0)
                                                <span class="badge bg-primary">{{ $position->teams_count ?? 0 }} members</span>
                                            @else
                                                <span class="text-muted">No members assigned</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.position.edit', $position) }}" class="btn btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.position.destroy', $position) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger"
                                                        onclick="return confirm('Are you sure you want to delete this position? This action cannot be undone.')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-briefcase text-muted" style="font-size: 4rem;"></i>
                        <h5 class="mt-3 text-muted">No positions found</h5>
                        <p class="text-muted mb-4">Create your first position to organize team members</p>
                        <a href="{{ route('admin.position.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add First Position
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
