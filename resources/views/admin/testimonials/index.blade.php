@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Testimonials Management',
            'description' => 'Manage customer testimonials and reviews',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'Testimonials Management', 'url' => '#']
            ],
            'actions' => ''
        ])
            'actions' => '<a href="' . route('admin.testimonials.create') . '" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Testimonial
            </a>'
        ])
        @push('styles')
        <style>
            .main-content { position: relative; z-index: 1; }
            .table-responsive, .card { position: relative; z-index: 2; }
            @media (min-width: 992px) { .overlay { display: none !important; } }
        </style>
        @endpush

        @if (session('success'))
            @include('admin.layout.partials.alert', ['type' => 'success', 'message' => session('success')])
        @endif
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-star me-2"></i>Customer Testimonials
                </h5>
            </div>
            <div class="card-body">
                @if ($testimonials->count())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Customer</th>
                                    <th>Testimonial</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($testimonials as $testimonial)
                                    <tr>
                                        <td>
                                            @if ($testimonial->image)
                                                <img src="{{ asset('storage/' . $testimonial->image) }}" 
                                                    alt="Customer" class="rounded-circle img-thumbnail" 
                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-light border rounded-circle d-flex align-items-center justify-content-center"
                                                    style="width: 60px; height: 60px;">
                                                    <i class="fas fa-user text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ Str::limit($testimonial->description, 50) }}</div>
                                            @if($testimonial->sub_description)
                                                <small class="text-muted">{{ Str::limit($testimonial->sub_description, 40) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($testimonial->others)
                                                <span class="badge bg-info">{{ Str::limit($testimonial->others, 30) }}</span>
                                            @else
                                                <span class="text-muted">No additional details</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.testimonials.status', $testimonial) }}"
                                                class="badge {{ $testimonial->status ? 'bg-success' : 'bg-secondary' }} text-decoration-none">
                                                {{ $testimonial->status ? 'Enabled' : 'Disabled' }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                                                    class="btn btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-danger"
                                                        onclick="return confirm('Are you sure you want to delete this testimonial?')">
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
                        <i class="fas fa-star text-muted" style="font-size: 4rem;"></i>
                        <h5 class="mt-3 text-muted">No testimonials found</h5>
                        <p class="text-muted mb-4">Start building trust by adding your first customer testimonial</p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTestimonialModal">
                            <i class="fas fa-plus"></i> Add First Testimonial
                        </button>
                        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add First Testimonial
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Add Testimonial Modal -->
    </main>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ensure overlay is hidden on page load
    const overlay = document.getElementById('overlay');
    if (overlay) {
        overlay.classList.remove('show');
        overlay.style.display = 'none';
    }
    // Initialize all modals properly
    const modals = document.querySelectorAll('.modal');
    modals.forEach(function(modal) {
        modal.addEventListener('shown.bs.modal', function() {
            if (overlay) {
                overlay.classList.remove('show');
                overlay.style.display = 'none';
            }
        });
        modal.addEventListener('hidden.bs.modal', function() {
            if (overlay) {
                overlay.classList.remove('show');
                overlay.style.display = 'none';
            }
        });
    });
    // Ensure all interactive elements are clickable
    setTimeout(function() {
        const interactiveElements = document.querySelectorAll('button, a, input, select, textarea');
        interactiveElements.forEach(function(element) {
            element.style.pointerEvents = 'auto';
            element.style.position = 'relative';
            element.style.zIndex = '10';
        });
    }, 100);
});
</script>
@endpush
