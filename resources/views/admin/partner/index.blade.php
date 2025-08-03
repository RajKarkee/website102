@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Partners Management',
            'description' => 'Manage your business partners and their information',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'Partners Management', 'url' => '#']
            ],
            'actions' => '<a href="' . route('admin.partner.create') . '" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Partner
            </a>'
        ])

        @if (session('success'))
            @include('admin.layout.partials.alert', ['type' => 'success', 'message' => session('success')])
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-edit me-2"></i>Partner Section Settings
                </h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.partner.update.settings') }}">
                    @csrf
                    {{-- @method('put') --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Section Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                    value="{{ old('title', $partnerSettings->title ?? '') }}" 
                                    placeholder="Enter section title" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Section Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                    rows="3" placeholder="Enter section description" required>{{ old('description', $partnerSettings->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i>Save Settings
                    </button>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-handshake me-2"></i>Partners Management
                </h5>
            </div>
            <div class="card-body">
                @if ($partner->count())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Logo</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partner as $item)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $item->name }}</div>
                                        </td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            @if ($item->logo)
                                                <img src="{{ asset('storage/' . $item->logo) }}" 
                                                    alt="{{ $item->name }}" class="img-thumbnail" 
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="bg-light border rounded d-flex align-items-center justify-content-center"
                                                    style="width: 50px; height: 50px;">
                                                    <i class="fas fa-building text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.partner.edit', $item->id) }}" 
                                                    class="btn btn-outline-primary"
                                                    title="Edit Partner">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.partner.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                        class="btn btn-outline-danger delete-partner-btn"
                                                        title="Delete Partner"
                                                        data-partner-name="{{ $item->name }}">
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
                        <i class="fas fa-handshake text-muted" style="font-size: 4rem;"></i>
                        <h5 class="mt-3 text-muted">No partners found</h5>
                        <p class="text-muted mb-4">Add your first business partner to get started</p>
                        <button class="btn btn-primary" onclick="window.location.href='{{ route('admin.partner.create') }}'">
                            <i class="fas fa-plus"></i> Add First Partner
                        </button>
                    </div>
                @endif
            </div>
        </div>

    </main>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle delete confirmations with better UX
            const deleteButtons = document.querySelectorAll('.delete-partner-btn');
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const partnerName = this.getAttribute('data-partner-name');
                    const confirmMessage = `Are you sure you want to delete partner "${partnerName}"? This action cannot be undone.`;
                    
                    if (confirm(confirmMessage)) {
                        // Submit the form
                        this.closest('form').submit();
                    }
                });
            });
        });
    </script>
    @endpush
@endsection

            