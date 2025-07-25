@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        <div class="content-header fade-in">
            <h1>Edit Team Member</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.team.index') }}">Team</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="cta-admin">
            <form action="{{ route('admin.team.update', $team) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required
                        value="{{ old('name', $team->name) }}" placeholder="Enter name">
                </div>
                <div class="form-group mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="form-control-file">
                    @if ($team->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}"
                                class="rounded-circle" width="48" height="48">
                        </div>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="position_id" class="form-label">Position</label>
                    <select name="position_id" id="position_id" class="form-control" required>
                        <option value="">Select Position</option>
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}"
                                {{ old('position_id', $team->position_id) == $position->id ? 'selected' : '' }}>
                                {{ $position->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Team Member</button>
            </form>
        </div>
    </main>
@endsection
