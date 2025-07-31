// Modern Admin Forms Enhancement Script
document.addEventListener('DOMContentLoaded', function() {
    initializeFormEnhancements();
    initializeValidation();
    initializeFileUploads();
    initializeColorPickers();
    initializeTooltips();
});

// Initialize form enhancements
function initializeFormEnhancements() {
    // Add icons to form labels that don't have them
    enhanceFormLabels();
    
    // Add loading states to submit buttons
    enhanceSubmitButtons();
    
    // Add character counters to textareas
    addCharacterCounters();
    
    // Add form field animations
    addFormAnimations();
}

// Enhance form labels with appropriate icons
function enhanceFormLabels() {
    const labelMappings = {
        'title': 'fas fa-heading',
        'name': 'fas fa-user',
        'email': 'fas fa-envelope',
        'phone': 'fas fa-phone',
        'address': 'fas fa-map-marker-alt',
        'website': 'fas fa-globe',
        'description': 'fas fa-align-left',
        'tagline': 'fas fa-quote-left',
        'company': 'fas fa-building',
        'position': 'fas fa-briefcase'
    };
    
    Object.keys(labelMappings).forEach(field => {
        const labels = document.querySelectorAll(`label[for*="${field}"]`);
        labels.forEach(label => {
            if (!label.querySelector('i')) {
                const icon = document.createElement('i');
                icon.className = `${labelMappings[field]} text-primary me-2`;
                label.insertBefore(icon, label.firstChild);
            }
        });
    });
}

// Enhanced submit buttons with loading states
function enhanceSubmitButtons() {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn && !submitBtn.dataset.enhanced) {
            submitBtn.dataset.enhanced = 'true';
            
            form.addEventListener('submit', function(e) {
                // Show loading state
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                submitBtn.disabled = true;
                
                // Re-enable after 3 seconds as failsafe
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            });
        }
    });
}

// Add character counters to textareas
function addCharacterCounters() {
    const textareas = document.querySelectorAll('textarea[maxlength]');
    textareas.forEach(textarea => {
        if (!textarea.nextElementSibling?.classList.contains('char-counter')) {
            const maxLength = textarea.getAttribute('maxlength');
            const counter = document.createElement('div');
            counter.className = 'char-counter text-muted small text-end mt-1';
            counter.innerHTML = `<span class="current">0</span>/<span class="max">${maxLength}</span> characters`;
            
            textarea.parentNode.insertBefore(counter, textarea.nextSibling);
            
            // Update counter on input
            textarea.addEventListener('input', function() {
                const current = this.value.length;
                const currentSpan = counter.querySelector('.current');
                currentSpan.textContent = current;
                
                // Color coding
                const percentage = (current / maxLength) * 100;
                if (percentage > 90) {
                    counter.className = 'char-counter text-danger small text-end mt-1';
                } else if (percentage > 75) {
                    counter.className = 'char-counter text-warning small text-end mt-1';
                } else {
                    counter.className = 'char-counter text-muted small text-end mt-1';
                }
            });
            
            // Initialize counter
            textarea.dispatchEvent(new Event('input'));
        }
    });
}

// Add form field animations
function addFormAnimations() {
    const inputs = document.querySelectorAll('.form-control, .form-select');
    inputs.forEach(input => {
        // Focus animations
        input.addEventListener('focus', function() {
            this.closest('.form-group, .mb-3, .mb-4')?.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.closest('.form-group, .mb-3, .mb-4')?.classList.remove('focused');
        });
    });
}

// Initialize validation enhancements
function initializeValidation() {
    // Real-time validation
    const inputs = document.querySelectorAll('input[required], textarea[required], select[required]');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                validateField(this);
            }
        });
    });
}

// Validate individual field
function validateField(field) {
    const isValid = field.checkValidity();
    
    if (isValid) {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');
        removeFieldError(field);
    } else {
        field.classList.remove('is-valid');
        field.classList.add('is-invalid');
        showFieldError(field, field.validationMessage);
    }
}

// Show field error
function showFieldError(field, message) {
    removeFieldError(field);
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'invalid-feedback';
    errorDiv.innerHTML = `<i class="fas fa-exclamation-circle me-1"></i>${message}`;
    
    field.parentNode.appendChild(errorDiv);
}

// Remove field error
function removeFieldError(field) {
    const existingError = field.parentNode.querySelector('.invalid-feedback');
    if (existingError) {
        existingError.remove();
    }
}

// Initialize file upload enhancements for non-modern components
function initializeFileUploads() {
    const fileInputs = document.querySelectorAll('input[type="file"]:not(.image-input)');
    fileInputs.forEach(input => {
        if (!input.dataset.enhanced) {
            input.dataset.enhanced = 'true';
            enhanceFileInput(input);
        }
    });
}

// Enhance traditional file inputs
function enhanceFileInput(input) {
    // Create wrapper
    const wrapper = document.createElement('div');
    wrapper.className = 'file-input-wrapper';
    input.parentNode.insertBefore(wrapper, input);
    wrapper.appendChild(input);
    
    // Create custom button
    const button = document.createElement('button');
    button.type = 'button';
    button.className = 'btn btn-outline-primary file-select-btn';
    button.innerHTML = '<i class="fas fa-upload me-2"></i>Choose File';
    wrapper.appendChild(button);
    
    // Create file info display
    const fileInfo = document.createElement('div');
    fileInfo.className = 'file-info mt-2 text-muted small';
    fileInfo.style.display = 'none';
    wrapper.appendChild(fileInfo);
    
    // Hide original input
    input.style.display = 'none';
    
    // Button click handler
    button.addEventListener('click', () => input.click());
    
    // File change handler
    input.addEventListener('change', function() {
        if (this.files.length > 0) {
            const file = this.files[0];
            fileInfo.innerHTML = `
                <i class="fas fa-file me-1"></i>
                ${file.name} (${formatFileSize(file.size)})
            `;
            fileInfo.style.display = 'block';
            button.innerHTML = '<i class="fas fa-check me-2"></i>File Selected';
            button.classList.remove('btn-outline-primary');
            button.classList.add('btn-outline-success');
        } else {
            fileInfo.style.display = 'none';
            button.innerHTML = '<i class="fas fa-upload me-2"></i>Choose File';
            button.classList.remove('btn-outline-success');
            button.classList.add('btn-outline-primary');
        }
    });
}

// Initialize color picker enhancements
function initializeColorPickers() {
    const colorSelects = document.querySelectorAll('select[name*="color"]');
    colorSelects.forEach(select => {
        if (!select.dataset.enhanced) {
            select.dataset.enhanced = 'true';
            enhanceColorSelect(select);
        }
    });
}

// Enhance color select dropdowns
function enhanceColorSelect(select) {
    const options = select.querySelectorAll('option[data-color]');
    options.forEach(option => {
        const color = option.dataset.color;
        if (color) {
            option.style.background = color;
            option.style.color = getContrastColor(color);
        }
    });
    
    // Add change handler for preview
    select.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const color = selectedOption.dataset.color;
        
        if (color) {
            updateColorPreview(color, selectedOption.textContent);
        }
    });
}

// Get contrast color for text
function getContrastColor(hexColor) {
    const rgb = hexToRgb(hexColor);
    if (!rgb) return '#000';
    
    const brightness = (rgb.r * 299 + rgb.g * 587 + rgb.b * 114) / 1000;
    return brightness > 125 ? '#000' : '#fff';
}

// Convert hex to RGB
function hexToRgb(hex) {
    const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

// Update color preview
function updateColorPreview(color, colorName) {
    const preview = document.getElementById('selected-color-preview');
    if (preview) {
        const swatch = preview.querySelector('#color-swatch');
        const info = preview.querySelector('#color-info');
        
        if (swatch && info) {
            swatch.style.backgroundColor = color;
            info.textContent = colorName;
            preview.style.display = 'block';
        }
    }
}

// Initialize Bootstrap tooltips
function initializeTooltips() {
    if (typeof bootstrap !== 'undefined') {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
}

// Utility function to format file size
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Add CSS for enhanced form styling
const style = document.createElement('style');
style.textContent = `
    .focused {
        transform: scale(1.02);
        transition: transform 0.2s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }
    
    .file-input-wrapper {
        position: relative;
    }
    
    .file-select-btn {
        width: 100%;
        transition: all 0.3s ease;
    }
    
    .file-select-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .char-counter {
        font-size: 0.875rem;
        transition: color 0.3s ease;
    }
    
    .is-valid {
        border-color: #28a745;
    }
    
    .is-invalid {
        border-color: #dc3545;
    }
    
    .form-control, .form-select {
        transition: all 0.2s ease;
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    
    .shake {
        animation: shake 0.5s ease-in-out;
    }
`;
document.head.appendChild(style);
