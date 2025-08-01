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
            'actions' => '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPartnerModal">
                <i class="fas fa-plus"></i> Add Partner
            </button>'
        ])

        @if (session('success'))
            @include('admin.layout.partials.alert', ['type' => 'success', 'message' => session('success')])
        @endif

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
                                                <button type="button" class="btn btn-outline-primary" 
                                                    data-bs-toggle="modal" data-bs-target="#editPartnerModal{{ $item->id }}"
                                                    title="Edit Partner">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form action="{{ route('admin.partner.store') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" name="action" value="delete_{{ $item->id }}" 
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
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPartnerModal">
                            <i class="fas fa-plus"></i> Add First Partner
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <!-- Add Partner Modal -->
        <div class="modal fade" id="addPartnerModal" tabindex="-1" aria-labelledby="addPartnerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPartnerModalLabel">
                            <i class="fas fa-plus me-2"></i>Add New Partner
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('admin.partner.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Partner Name <span class="text-danger">*</span></label>
                                <input type="text" name="new_partner[name]" class="form-control" required
                                    placeholder="Enter partner name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Partner Email <span class="text-danger">*</span></label>
                                <input type="email" name="new_partner[email]" class="form-control" required
                                    placeholder="Enter partner email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Partner Logo</label>
                                <input type="file" name="new_partner[logo]" class="form-control" accept="image/*">
                                <small class="form-text text-muted">Upload an image file (JPG, PNG, etc.)</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i>Cancel
                            </button>
                            <button type="submit" name="action" value="save" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add Partner
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Partner Modals -->
        @foreach ($partner as $item)
            <div class="modal fade" id="editPartnerModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fas fa-edit me-2"></i>Edit Partner: {{ $item->name }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('admin.partner.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Partner Name <span class="text-danger">*</span></label>
                                    <input type="text" name="partners[{{ $item->id }}][name]" class="form-control" required
                                        value="{{ $item->name }}" placeholder="Enter partner name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Partner Email <span class="text-danger">*</span></label>
                                    <input type="email" name="partners[{{ $item->id }}][email]" class="form-control" required
                                        value="{{ $item->email }}" placeholder="Enter partner email">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Partner Logo</label>
                                    @if ($item->logo)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $item->logo) }}" alt="{{ $item->name }}"
                                                class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                        </div>
                                    @endif
                                    <input type="file" name="partners[{{ $item->id }}][logo]" class="form-control" accept="image/*">
                                    <small class="form-text text-muted">Upload a new image to replace the current logo</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update Partner
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </main>

    @push('styles')
    <style>
        /* Ensure proper z-index hierarchy */
        .modal {
            z-index: 1055 !important;
        }
        .modal-backdrop {
            z-index: 1050 !important;
        }
        
        /* Fix any overlay conflicts */
        .main-content {
            position: relative;
            z-index: 1;
        }
        
        /* Ensure buttons are clickable */
        .btn-group .btn {
            position: relative;
            z-index: 2;
        }
        
        /* Prevent overlay issues */
        body.modal-open .overlay {
            display: none !important;
        }
        
        /* Force clickability on interactive elements */
        button, a, input, select, textarea, .btn {
            pointer-events: auto !important;
            position: relative;
            z-index: 10;
        }
        
        /* Ensure table content is accessible */
        .table-responsive {
            position: relative;
            z-index: 2;
        }
        
        /* Fix card content layering */
        .card {
            position: relative;
            z-index: 2;
        }
        
        /* Ensure overlay doesn't interfere on desktop */
        @media (min-width: 992px) {
            .overlay {
                display: none !important;
            }
        }
    </style>
    @endpush

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
                    // Hide overlay when modal is shown
                    if (overlay) {
                        overlay.classList.remove('show');
                        overlay.style.display = 'none';
                    }
                });
                
                modal.addEventListener('hidden.bs.modal', function() {
                    // Ensure overlay stays hidden after modal is closed
                    if (overlay) {
                        overlay.classList.remove('show');
                        overlay.style.display = 'none';
                    }
                });
            });
            
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
@endsection
