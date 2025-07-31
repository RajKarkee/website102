@extends('admin.layout.app')

@section('content')
<main class="main-content">
    @include('admin.layout.partials.header', [
        'title' => 'Color Management',
        'description' => 'Manage colors for your application and branding',
        'breadcrumbs' => [
            ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['title' => 'Color Management', 'url' => '#']
        ],
        'actions' => '<button type="button" class="btn btn-primary" id="addColorBtn">
            <i class="fas fa-plus"></i> Add New Color
        </button>'
    ])

    <div class="color-admin">
        @include('components.alerts')

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0 d-flex align-items-center">
                    <i class="fas fa-palette me-2"></i>
                    Colors List
                </h5>
            </div>
            
            
            <div id="colorFormContainer" class="card-body border-bottom" style="display: none;">
                <form id="colorForm" action="/admin/color" method="POST">
                    @csrf
                    <input type="hidden" id="colorId" name="id">
                    <input type="hidden" id="formMethod" name="_method" value="POST">
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="colorName" class="form-label">Color Name</label>
                                <input type="text" class="form-control" id="colorName" name="color" placeholder="Enter color name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="colorHex" class="form-label">Hex Code</label>
                                <div class="input-group">
                                    <span class="input-group-text">#</span>
                                    <input type="text" class="form-control" id="colorHex" name="hex_code" placeholder="FFFFFF" pattern="[A-Fa-f0-9]{6}" maxlength="6" required>
                                    <input type="color" class="form-control form-control-color" id="colorPicker" title="Choose color">
                                </div>
                                <div class="form-text">Enter a 6-digit hex color code (without #)</div>
                                <input type="hidden" id="hexWithHash" name="hex_code_full">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Color Preview</label>
                                <div id="colorPreview" class="border rounded" style="width: 100%; height: 40px; background-color: #ffffff;"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Save Color
                        </button>
                        <button type="button" class="btn btn-secondary" id="cancelBtn">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>SN</th>
                                <th>Color Preview</th>
                                <th>Color Name</th>
                                <th>Hex Code</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($colors as $index => $color)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="color-preview" style="width: 40px; height: 40px; background-color: {{ $color->hex_code }}; border: 1px solid #ddd; border-radius: 4px;"></div>
                                </td>
                                <td>{{ $color->color }}</td>
                                <td>
                                    <code>{{ $color->hex_code }}</code>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-warning edit-color" 
                                                data-id="{{ $color->id }}" 
                                                data-name="{{ $color->color }}" 
                                                data-hex="{{ $color->hex_code }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.color.destroy', $color->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this color?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="fas fa-palette fa-3x mb-2 d-block"></i>
                                    No colors found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@push('styles')
<style>
    .color-preview {
        display: inline-block;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: transform 0.2s ease;
    }
    
    .color-preview:hover {
        transform: scale(1.1);
    }
    
    .form-control-color {
        width: 50px !important;
        height: 38px;
        border-radius: 0 0.375rem 0.375rem 0;
    }
    
    #colorPreview {
        border: 2px solid #dee2e6;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.075);
        transition: background-color 0.3s ease;
    }
    
    .btn-group .btn {
        margin-right: 2px;
    }
    
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    
    .table th {
        border-top: none;
    }
    
    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }
    
    .alert {
        border-radius: 0.5rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    /* Form container animation */
    #colorFormContainer {
        overflow: hidden;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }
    
    #colorFormContainer.show {
        animation: slideDown 0.3s ease forwards;
    }
    
    #colorFormContainer.hide {
        animation: slideUp 0.3s ease forwards;
    }
    
    @keyframes slideDown {
        from {
            max-height: 0;
            opacity: 0;
            padding-top: 0;
            padding-bottom: 0;
        }
        to {
            max-height: 200px;
            opacity: 1;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
    }
    
    @keyframes slideUp {
        from {
            max-height: 200px;
            opacity: 1;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        to {
            max-height: 0;
            opacity: 0;
            padding-top: 0;
            padding-bottom: 0;
        }
    }
    
    /* Add Color button animation */
    #addColorBtn {
        transition: all 0.3s ease;
    }
    
    #addColorBtn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    /* Form styling */
    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const colorForm = document.getElementById('colorForm');
        const colorFormContainer = document.getElementById('colorFormContainer');
        const colorHexInput = document.getElementById('colorHex');
        const colorPicker = document.getElementById('colorPicker');
        const colorPreview = document.getElementById('colorPreview');
        const colorNameInput = document.getElementById('colorName');
        const colorIdInput = document.getElementById('colorId');
        const formMethodInput = document.getElementById('formMethod');
        const addColorBtn = document.getElementById('addColorBtn');
        const cancelBtn = document.getElementById('cancelBtn');

        let isFormVisible = false;

        // Show/Hide form functions
        function showForm() {
            colorFormContainer.style.display = 'block';
            colorFormContainer.classList.remove('hide');
            colorFormContainer.classList.add('show');
            isFormVisible = true;
            addColorBtn.innerHTML = '<i class="fas fa-times"></i> Close Form';
            addColorBtn.classList.remove('btn-primary');
            addColorBtn.classList.add('btn-danger');
        }

        function hideForm() {
            colorFormContainer.classList.remove('show');
            colorFormContainer.classList.add('hide');
            isFormVisible = false;
            addColorBtn.innerHTML = '<i class="fas fa-plus"></i> Add Color';
            addColorBtn.classList.remove('btn-danger');
            addColorBtn.classList.add('btn-primary');
            
            // Hide container after animation
            setTimeout(() => {
                colorFormContainer.style.display = 'none';
                colorFormContainer.classList.remove('hide');
            }, 300);
        }

        function resetForm() {
            colorForm.reset();
            colorIdInput.value = '';
            formMethodInput.value = 'POST';
            colorForm.action = window.location.origin + '/admin/color';
            updateColorPreview('#FFFFFF');
            
            // Reset hex input name
            colorHexInput.name = 'hex_code';
            
            // Clear the hidden hex field
            document.getElementById('hexWithHash').value = '';
            
            // Remove any dynamically added hidden inputs
            const dynamicInputs = colorForm.querySelectorAll('input[name="hex_code"]:not(#colorHex)');
            dynamicInputs.forEach(input => input.remove());
            
            // Re-enable submit button
            const submitBtn = colorForm.querySelector('button[type="submit"]');
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-save"></i> Save Color';
        }

        // Toggle form visibility
        addColorBtn.addEventListener('click', function() {
            if (isFormVisible) {
                hideForm();
                resetForm();
            } else {
                showForm();
                resetForm();
                colorNameInput.focus();
            }
        });

        // Cancel button
        cancelBtn.addEventListener('click', function() {
            hideForm();
            resetForm();
        });

        // Color picker and hex input synchronization
        colorPicker.addEventListener('input', function() {
            const hexValue = this.value.substring(1); // Remove #
            colorHexInput.value = hexValue.toUpperCase();
            updateColorPreview(this.value);
            // Update hidden field with full hex
            document.getElementById('hexWithHash').value = this.value;
        });

        colorHexInput.addEventListener('input', function() {
            let value = this.value.replace('#', '').toUpperCase();
            
            // Validate hex format
            if (/^[0-9A-F]{0,6}$/i.test(value)) {
                this.value = value;
                if (value.length === 6) {
                    const fullHex = '#' + value;
                    colorPicker.value = fullHex;
                    updateColorPreview(fullHex);
                    // Update hidden field with full hex
                    document.getElementById('hexWithHash').value = fullHex;
                }
            } else {
                // Remove invalid characters
                this.value = value.replace(/[^0-9A-F]/gi, '');
            }
        });

        // Update color preview
        function updateColorPreview(color) {
            colorPreview.style.backgroundColor = color;
        }

        // Edit color functionality
        document.addEventListener('click', function(e) {
            if (e.target.closest('.edit-color')) {
                e.preventDefault();
                e.stopPropagation();
                
                const button = e.target.closest('.edit-color');
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const hex = button.getAttribute('data-hex');

                // Show form if hidden
                if (!isFormVisible) {
                    showForm();
                }

                // Set form for editing
                colorIdInput.value = id;
                formMethodInput.value = 'PUT';
                colorForm.action = window.location.origin + '/admin/color/' + id;
                
                // Fill form fields
                colorNameInput.value = name;
                colorHexInput.value = hex.replace('#', '');
                colorPicker.value = hex;
                updateColorPreview(hex);
                
                // Focus on name input
                colorNameInput.focus();
                
                // Scroll to form
                colorFormContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        });

        // Form validation and submission
        colorForm.addEventListener('submit', function(e) {
            const hexValue = colorHexInput.value;
            const colorName = colorNameInput.value.trim();
            
            // Validate color name
            if (!colorName) {
                e.preventDefault();
                alert('Please enter a color name.');
                colorNameInput.focus();
                return false;
            }
            
            // Validate hex code
            if (!/^[0-9A-F]{6}$/i.test(hexValue)) {
                e.preventDefault();
                alert('Please enter a valid 6-digit hex color code.');
                colorHexInput.focus();
                return false;
            }
            
            // Ensure hex code includes # before submission
            const fullHex = '#' + hexValue.replace('#', '');
            document.getElementById('hexWithHash').value = fullHex;
            
            // Temporarily change the hex input name to avoid sending duplicate data
            colorHexInput.name = '';
            
            // Create a hidden input with the full hex value
            const hexInput = document.createElement('input');
            hexInput.type = 'hidden';
            hexInput.name = 'hex_code';
            hexInput.value = fullHex;
            this.appendChild(hexInput);
            
            // Disable submit button and show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
        });

        // Initialize color preview
        updateColorPreview('#FFFFFF');

        // Handle alert dismissal
        document.querySelectorAll('.alert .btn-close').forEach(function(button) {
            button.addEventListener('click', function() {
                this.closest('.alert').style.display = 'none';
            });
        });

        // Escape key to close form
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isFormVisible) {
                hideForm();
                resetForm();
            }
        });
    });
</script>
@endpush
