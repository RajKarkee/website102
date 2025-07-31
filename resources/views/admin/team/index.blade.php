@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Team Management',
            'description' => 'Manage your team members and their information',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'Team Management', 'url' => '#']
            ],
            'actions' => '<div class="btn-group">
                <a href="' . route('admin.team.create') . '" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Team Member
                </a>
                <a href="' . route('admin.position.create') . '" class="btn btn-outline-secondary">
                    <i class="fas fa-briefcase"></i> Add Position
                </a>
            </div>'
        ])

        @if (session('success'))
            @include('admin.layout.partials.alert', ['type' => 'success', 'message' => session('success')])
        @endif

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-users me-2"></i>Team Members List
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="cta-admin p-3">
                    <form method="GET" class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <div class="d-flex gap-2 align-items-center">
                            <select name="sort" class="form-select form-select-sm">
                                <option value="">Sort By Name</option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                            </select>
                            <select name="position_id" class="form-select form-select-sm">
                                <option value="">All Positions</option>
                                @foreach (\App\Models\Position::orderBy('name')->get() as $position)
                                    <option value="{{ $position->id }}"
                                        {{ request('position_id') == $position->id ? 'selected' : '' }}>{{ $position->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-sm btn-outline-primary">Apply</button>
                        </div>
                    </form>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 40px;">#</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Position</th>
                                <th style="width: 140px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($teams as $team)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-semibold">{{ $team->name }}</td>
                                    <td>
                                        @if ($team->image)
                                            <img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}"
                                                class="rounded-circle border border-primary" width="48" height="48"
                                                style="object-fit: cover;">
                                        @else
                                            <div class="bg-light border rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 48px; height: 48px;">
                                                <i class="fas fa-user text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($team->position)
                                            <span class="badge bg-primary px-3 py-2 rounded-pill">{{ $team->position->name }}</span>
                                        @else
                                            <span class="badge bg-secondary px-3 py-2 rounded-pill">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.team.edit', $team) }}" class="btn btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.team.destroy', $team) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger"
                                                    onclick="return confirm('Are you sure you want to delete this team member?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="fas fa-users text-muted" style="font-size: 3rem;"></i>
                                        <h6 class="mt-3 text-muted">No team members found</h6>
                                        <p class="text-muted mb-3">Get started by adding your first team member</p>
                                        <a href="{{ route('admin.team.create') }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-plus"></i> Add Team Member
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
