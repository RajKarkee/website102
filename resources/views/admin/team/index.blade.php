@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        <div class="content-header fade-in">
            <h1>Team Members</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Team</li>
                </ol>
            </nav>
        </div>
        <div class="cta-admin">
            <form method="GET" class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.team.create') }}"
                        class="btn btn-primary rounded-pill px-4 py-2 shadow-sm me-2">
                        <i class="fas fa-plus me-2"></i> Add Team Member
                    </a>
                    <a href="{{ route('admin.position.create') }}"
                        class="btn btn-outline-primary rounded-pill px-4 py-2 shadow-sm">
                        <i class="fas fa-briefcase me-2"></i> Add Position
                    </a>
                </div>
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
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card border-primary shadow rounded-4">
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-primary">
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
                                                class="rounded-circle border border-primary" width="48" height="48">
                                        @else
                                            <span class="badge bg-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($team->position)
                                            <span
                                                class="badge bg-primary px-3 py-2 rounded-pill">{{ $team->position->name }}</span>
                                        @else
                                            <span class="badge bg-secondary px-3 py-2 rounded-pill">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.team.edit', $team) }}"
                                            class="btn btn-sm btn-outline-warning me-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.team.destroy', $team) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Delete this team member?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No team members found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
