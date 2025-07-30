{{-- Enhanced Admin Form Partial --}}
@props([
    'title' => 'Form',
    'method' => 'POST',
    'action' => '',
    'enctype' => null,
    'submitText' => 'Save',
    'cancelUrl' => null,
    'icon' => 'fas fa-edit'
])

<div class="admin-form-container">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-gradient-primary text-white border-0">
            <h5 class="mb-0 d-flex align-items-center">
                <i class="{{ $icon }} me-2"></i>
                {{ $title }}
            </h5>
        </div>
        
        <div class="card-body p-4">
            <form method="{{ strtoupper($method) === 'GET' ? 'GET' : 'POST' }}" 
                  action="{{ $action }}"
                  @if($enctype) enctype="{{ $enctype }}" @endif
                  class="admin-form">
                
                @if(strtoupper($method) !== 'GET' && strtoupper($method) !== 'POST')
                    @method($method)
                @endif
                
                @if(strtoupper($method) !== 'GET')
                    @csrf
                @endif
                
                {{ $slot }}
                
                <div class="form-actions mt-4 pt-4 border-top">
                    <div class="d-flex justify-content-end gap-2">
                        @if($cancelUrl)
                            <a href="{{ $cancelUrl }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                        @endif
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> {{ $submitText }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .admin-form-container .card {
        max-width: none;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    }
    
    .admin-form .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    
    .admin-form .form-control, 
    .admin-form .form-select {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 0.75rem;
        transition: all 0.3s ease;
    }
    
    .admin-form .form-control:focus, 
    .admin-form .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
    }
    
    .admin-form .form-control.is-invalid {
        border-color: #dc3545;
    }
    
    .admin-form .invalid-feedback {
        display: block;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    
    .admin-form .form-text {
        color: #6c757d;
        font-size: 0.875rem;
    }
    
    .form-actions {
        background: rgba(248, 249, 250, 0.5);
        margin: 0 -1.5rem -1.5rem;
        padding: 1rem 1.5rem;
        border-radius: 0 0 1rem 1rem;
    }
    
    .admin-form .btn {
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .admin-form .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
</style>
