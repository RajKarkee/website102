{{-- Modern Image Upload Component with Preview --}}
@props([
    'name' => 'image',
    'label' => 'Image',
    'required' => false,
    'accept' => 'image/*',
    'maxSize' => '2MB',
    'currentImage' => null,
    'previewSize' => 'medium', // small, medium, large
    'allowMultiple' => false,
    'description' => null,
    'placeholder' => 'Click to upload or drag and drop'
])

@php
    $uniqueId = 'image-upload-' . uniqid();
    $previewSizes = [
        'small' => 'width: 80px; height: 80px;',
        'medium' => 'width: 120px; height: 120px;',
        'large' => 'width: 200px; height: 200px;'
    ];
    $previewStyle = $previewSizes[$previewSize] ?? $previewSizes['medium'];
@endphp

<div class="modern-image-upload" data-upload-id="{{ $uniqueId }}">
    <label for="{{ $uniqueId }}" class="form-label d-flex align-items-center">
        <i class="fas fa-image text-primary me-2"></i>
        {{ $label }}
        @if($required)
            <span class="text-danger ms-1">*</span>
        @endif
    </label>
    
    @if($description)
        <p class="text-muted small mb-2">{{ $description }}</p>
    @endif
    
    <div class="upload-container">
        <!-- Current Image Display -->
        @if($currentImage)
            <div class="current-image-section mb-3">
                <label class="small text-muted mb-1">Current Image:</label>
                <div class="current-image-preview">
                    <img src="{{ $currentImage }}" 
                         alt="Current {{ $label }}" 
                         class="rounded border shadow-sm"
                         style="{{ $previewStyle }} object-fit: cover;">
                    <div class="current-image-overlay">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                </div>
            </div>
        @endif
        
        <!-- Upload Area -->
        <div class="upload-area" 
             onclick="document.getElementById('{{ $uniqueId }}').click()"
             ondrop="handleDrop(event, '{{ $uniqueId }}')"
             ondragover="handleDragOver(event)"
             ondragleave="handleDragLeave(event)">
            <div class="upload-content">
                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                <div class="upload-text">
                    <strong>{{ $placeholder }}</strong>
                    <p class="text-muted small mb-0">
                        Supported formats: {{ str_replace(['image/', '*'], ['', 'JPG, PNG, GIF, SVG'], $accept) }}
                        @if($maxSize)
                            • Max size: {{ $maxSize }}
                        @endif
                    </p>
                </div>
            </div>
            
            <!-- Loading State -->
            <div class="upload-loading" style="display: none;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Uploading...</span>
                </div>
                <p class="text-muted mt-2 mb-0">Processing image...</p>
            </div>
        </div>
        
        <!-- Preview Area -->
        <div class="preview-area" style="display: none;">
            <div class="preview-image-container">
                <img class="preview-image rounded border shadow-sm" 
                     style="{{ $previewStyle }} object-fit: cover;" 
                     alt="Preview">
                <div class="preview-actions">
                    <button type="button" 
                            class="btn btn-sm btn-outline-danger remove-image"
                            onclick="removePreview('{{ $uniqueId }}')">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="preview-info mt-2">
                <small class="text-muted file-info"></small>
            </div>
        </div>
        
        <!-- Hidden File Input -->
        <input type="file" 
               id="{{ $uniqueId }}" 
               name="{{ $name }}" 
               class="d-none image-input"
               accept="{{ $accept }}"
               {{ $allowMultiple ? 'multiple' : '' }}
               {{ $required ? 'required' : '' }}
               onchange="handleFileSelect(event, '{{ $uniqueId }}')">
    </div>
    
    @error($name)
        <div class="text-danger small mt-1">
            <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
        </div>
    @enderror
</div>

@push('styles')
<style>
.modern-image-upload {
    margin-bottom: 1rem;
}

.upload-container {
    position: relative;
}

.current-image-section {
    text-align: center;
}

.current-image-preview {
    position: relative;
    display: inline-block;
}

.current-image-overlay {
    position: absolute;
    top: -5px;
    right: -5px;
    background: white;
    border-radius: 50%;
    padding: 2px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.upload-area {
    border: 2px dashed #dee2e6;
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #f8f9fa;
    position: relative;
    min-height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.upload-area:hover {
    border-color: #007bff;
    background: #e3f2fd;
    transform: translateY(-2px);
}

.upload-area.drag-over {
    border-color: #28a745;
    background: #e8f5e8;
    transform: scale(1.02);
}

.upload-content {
    pointer-events: none;
}

.upload-icon {
    font-size: 2rem;
    color: #6c757d;
    margin-bottom: 0.5rem;
    display: block;
}

.upload-area:hover .upload-icon {
    color: #007bff;
    transform: scale(1.1);
}

.upload-area.drag-over .upload-icon {
    color: #28a745;
}

.preview-area {
    margin-top: 1rem;
    text-align: center;
}

.preview-image-container {
    position: relative;
    display: inline-block;
}

.preview-actions {
    position: absolute;
    top: -10px;
    right: -10px;
}

.remove-image {
    border-radius: 50%;
    width: 30px;
    height: 30px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.file-info {
    font-weight: 500;
    color: #28a745;
}

/* Animation for smooth transitions */
.upload-area, .preview-area {
    transition: all 0.3s ease;
}

.fade-in {
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endpush

@push('scripts')
<script>
function handleFileSelect(event, uploadId) {
    const file = event.target.files[0];
    if (!file) return;
    
    const container = document.querySelector(`[data-upload-id="${uploadId}"]`);
    const uploadArea = container.querySelector('.upload-area');
    const previewArea = container.querySelector('.preview-area');
    const previewImage = container.querySelector('.preview-image');
    const fileInfo = container.querySelector('.file-info');
    const loadingState = container.querySelector('.upload-loading');
    
    // Show loading state
    uploadArea.style.display = 'none';
    loadingState.style.display = 'flex';
    loadingState.style.flexDirection = 'column';
    loadingState.style.alignItems = 'center';
    loadingState.style.justifyContent = 'center';
    loadingState.style.minHeight = '120px';
    
    // Validate file
    if (!validateFile(file, uploadId)) {
        resetUploadState(uploadId);
        return;
    }
    
    // Create preview
    const reader = new FileReader();
    reader.onload = function(e) {
        setTimeout(() => {
            previewImage.src = e.target.result;
            fileInfo.textContent = `${file.name} (${formatFileSize(file.size)})`;
            
            loadingState.style.display = 'none';
            previewArea.style.display = 'block';
            previewArea.classList.add('fade-in');
        }, 500); // Simulate processing time
    };
    reader.readAsDataURL(file);
}

function handleDrop(event, uploadId) {
    event.preventDefault();
    event.stopPropagation();
    
    const container = document.querySelector(`[data-upload-id="${uploadId}"]`);
    const uploadArea = container.querySelector('.upload-area');
    uploadArea.classList.remove('drag-over');
    
    const files = event.dataTransfer.files;
    if (files.length > 0) {
        const fileInput = document.getElementById(uploadId);
        fileInput.files = files;
        handleFileSelect({target: {files: files}}, uploadId);
    }
}

function handleDragOver(event) {
    event.preventDefault();
    event.currentTarget.classList.add('drag-over');
}

function handleDragLeave(event) {
    event.preventDefault();
    event.currentTarget.classList.remove('drag-over');
}

function validateFile(file, uploadId) {
    const maxSize = 2 * 1024 * 1024; // 2MB
    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml', 'image/webp'];
    
    if (!allowedTypes.includes(file.type)) {
        showError(uploadId, 'Please select a valid image file (JPG, PNG, GIF, SVG, WebP)');
        return false;
    }
    
    if (file.size > maxSize) {
        showError(uploadId, 'File size must be less than 2MB');
        return false;
    }
    
    return true;
}

function removePreview(uploadId) {
    const container = document.querySelector(`[data-upload-id="${uploadId}"]`);
    const fileInput = document.getElementById(uploadId);
    const uploadArea = container.querySelector('.upload-area');
    const previewArea = container.querySelector('.preview-area');
    
    fileInput.value = '';
    previewArea.style.display = 'none';
    uploadArea.style.display = 'flex';
    
    // Remove any error states
    const errorElement = container.querySelector('.text-danger');
    if (errorElement && !errorElement.textContent.includes('required')) {
        errorElement.remove();
    }
}

function resetUploadState(uploadId) {
    const container = document.querySelector(`[data-upload-id="${uploadId}"]`);
    const uploadArea = container.querySelector('.upload-area');
    const loadingState = container.querySelector('.upload-loading');
    const fileInput = document.getElementById(uploadId);
    
    fileInput.value = '';
    loadingState.style.display = 'none';
    uploadArea.style.display = 'flex';
}

function showError(uploadId, message) {
    const container = document.querySelector(`[data-upload-id="${uploadId}"]`);
    
    // Remove existing error
    const existingError = container.querySelector('.error-message');
    if (existingError) existingError.remove();
    
    // Add new error
    const errorDiv = document.createElement('div');
    errorDiv.className = 'text-danger small mt-1 error-message';
    errorDiv.innerHTML = `<i class="fas fa-exclamation-circle me-1"></i>${message}`;
    container.appendChild(errorDiv);
    
    setTimeout(() => {
        if (errorDiv.parentNode) {
            errorDiv.remove();
        }
    }, 5000);
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}
</script>
@endpush
