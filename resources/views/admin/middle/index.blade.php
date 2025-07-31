@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Middle Section Management',
            'description' => 'Manage the middle section content of your website',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'Middle Section', 'url' => '#']
            ],
            'actions' => '<a href="' . route('admin.middle.create') . '" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Content
            </a>'
        ])

        @if(session('success'))
            @include('admin.layout.partials.alert', ['type' => 'success', 'message' => session('success')])
        @endif
        
        @if(session('error'))
            @include('admin.layout.partials.alert', ['type' => 'danger', 'message' => session('error')])
        @endif
        
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-align-center me-2"></i>Middle Section Content
                </h5>
            </div>
            <div class="card-body">
                @if ($middles->count())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="middleTable">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 40px;">#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Created</th>
                                    <th style="width: 120px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($middles as $index => $middle)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $middle->title }}</div>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ Str::limit($middle->description, 60) }}</span>
                                        </td>
                                        <td>
                                            <small class="text-muted">{{ $middle->created_at->format('M d, Y') }}</small>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.middle.edit', $middle->id) }}" class="btn btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.middle.destroy', $middle->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger" 
                                                        onclick="return confirm('Are you sure you want to delete this content?')">
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
                        <i class="fas fa-align-center text-muted" style="font-size: 4rem;"></i>
                        <h5 class="mt-3 text-muted">No middle section content found</h5>
                        <p class="text-muted mb-4">Create content for the middle section of your website</p>
                        <a href="{{ route('admin.middle.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Content
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
