{{-- Enhanced Admin Form Fields Partial --}}

{{-- Text Input Field --}}
@if(!function_exists('renderTextField'))
    @php
        function renderTextField($name, $label, $value = '', $required = false, $placeholder = '', $type = 'text', $help = '', $icon = null) {
            $hasError = old($name) !== null && session('errors') && session('errors')->has($name);
            $inputClass = 'form-control' . ($hasError ? ' is-invalid' : '');
            $oldValue = old($name, $value);
            
            $html = '<div class="form-group mb-3">';
            
            if ($label) {
                $html .= '<label for="' . $name . '" class="form-label">';
                if ($icon) {
                    $html .= '<i class="' . $icon . ' me-2"></i>';
                }
                $html .= $label;
                if ($required) {
                    $html .= ' <span class="text-danger">*</span>';
                }
                $html .= '</label>';
            }
            
            $html .= '<input type="' . $type . '" ';
            $html .= 'id="' . $name . '" ';
            $html .= 'name="' . $name . '" ';
            $html .= 'class="' . $inputClass . '" ';
            $html .= 'value="' . htmlspecialchars($oldValue) . '" ';
            $html .= 'placeholder="' . $placeholder . '" ';
            if ($required) {
                $html .= 'required ';
            }
            $html .= '>';
            
            if ($help) {
                $html .= '<small class="form-text text-muted">' . $help . '</small>';
            }
            
            if ($hasError) {
                $html .= '<div class="invalid-feedback">' . session('errors')->first($name) . '</div>';
            }
            
            $html .= '</div>';
            
            return $html;
        }
    @endphp
@endif

{{-- Textarea Field --}}
@if(!function_exists('renderTextareaField'))
    @php
        function renderTextareaField($name, $label, $value = '', $required = false, $placeholder = '', $rows = 3, $help = '', $icon = null) {
            $hasError = old($name) !== null && session('errors') && session('errors')->has($name);
            $inputClass = 'form-control' . ($hasError ? ' is-invalid' : '');
            $oldValue = old($name, $value);
            
            $html = '<div class="form-group mb-3">';
            
            if ($label) {
                $html .= '<label for="' . $name . '" class="form-label">';
                if ($icon) {
                    $html .= '<i class="' . $icon . ' me-2"></i>';
                }
                $html .= $label;
                if ($required) {
                    $html .= ' <span class="text-danger">*</span>';
                }
                $html .= '</label>';
            }
            
            $html .= '<textarea ';
            $html .= 'id="' . $name . '" ';
            $html .= 'name="' . $name . '" ';
            $html .= 'class="' . $inputClass . '" ';
            $html .= 'rows="' . $rows . '" ';
            $html .= 'placeholder="' . $placeholder . '" ';
            if ($required) {
                $html .= 'required ';
            }
            $html .= '>' . htmlspecialchars($oldValue) . '</textarea>';
            
            if ($help) {
                $html .= '<small class="form-text text-muted">' . $help . '</small>';
            }
            
            if ($hasError) {
                $html .= '<div class="invalid-feedback">' . session('errors')->first($name) . '</div>';
            }
            
            $html .= '</div>';
            
            return $html;
        }
    @endphp
@endif

{{-- Select Field --}}
@if(!function_exists('renderSelectField'))
    @php
        function renderSelectField($name, $label, $options = [], $selected = '', $required = false, $placeholder = 'Select option...', $help = '', $icon = null) {
            $hasError = old($name) !== null && session('errors') && session('errors')->has($name);
            $inputClass = 'form-select' . ($hasError ? ' is-invalid' : '');
            $oldValue = old($name, $selected);
            
            $html = '<div class="form-group mb-3">';
            
            if ($label) {
                $html .= '<label for="' . $name . '" class="form-label">';
                if ($icon) {
                    $html .= '<i class="' . $icon . ' me-2"></i>';
                }
                $html .= $label;
                if ($required) {
                    $html .= ' <span class="text-danger">*</span>';
                }
                $html .= '</label>';
            }
            
            $html .= '<select ';
            $html .= 'id="' . $name . '" ';
            $html .= 'name="' . $name . '" ';
            $html .= 'class="' . $inputClass . '" ';
            if ($required) {
                $html .= 'required ';
            }
            $html .= '>';
            
            if (!$required) {
                $html .= '<option value="">' . $placeholder . '</option>';
            }
            
            foreach ($options as $value => $text) {
                $isSelected = (string)$oldValue === (string)$value ? 'selected' : '';
                $html .= '<option value="' . $value . '" ' . $isSelected . '>' . $text . '</option>';
            }
            
            $html .= '</select>';
            
            if ($help) {
                $html .= '<small class="form-text text-muted">' . $help . '</small>';
            }
            
            if ($hasError) {
                $html .= '<div class="invalid-feedback">' . session('errors')->first($name) . '</div>';
            }
            
            $html .= '</div>';
            
            return $html;
        }
    @endphp
@endif

{{-- Checkbox Field --}}
@if(!function_exists('renderCheckboxField'))
    @php
        function renderCheckboxField($name, $label, $checked = false, $help = '') {
            $hasError = old($name) !== null && session('errors') && session('errors')->has($name);
            $isChecked = old($name, $checked) ? 'checked' : '';
            
            $html = '<div class="form-group mb-3">';
            $html .= '<div class="form-check">';
            $html .= '<input type="checkbox" ';
            $html .= 'id="' . $name . '" ';
            $html .= 'name="' . $name . '" ';
            $html .= 'class="form-check-input' . ($hasError ? ' is-invalid' : '') . '" ';
            $html .= 'value="1" ';
            $html .= $isChecked . ' >';
            $html .= '<label class="form-check-label" for="' . $name . '">' . $label . '</label>';
            $html .= '</div>';
            
            if ($help) {
                $html .= '<small class="form-text text-muted">' . $help . '</small>';
            }
            
            if ($hasError) {
                $html .= '<div class="invalid-feedback">' . session('errors')->first($name) . '</div>';
            }
            
            $html .= '</div>';
            
            return $html;
        }
    @endphp
@endif

{{-- File Upload Field --}}
@if(!function_exists('renderFileField'))
    @php
        function renderFileField($name, $label, $required = false, $accept = '', $help = '', $icon = 'fas fa-upload') {
            $hasError = old($name) !== null && session('errors') && session('errors')->has($name);
            $inputClass = 'form-control' . ($hasError ? ' is-invalid' : '');
            
            $html = '<div class="form-group mb-3">';
            
            if ($label) {
                $html .= '<label for="' . $name . '" class="form-label">';
                if ($icon) {
                    $html .= '<i class="' . $icon . ' me-2"></i>';
                }
                $html .= $label;
                if ($required) {
                    $html .= ' <span class="text-danger">*</span>';
                }
                $html .= '</label>';
            }
            
            $html .= '<input type="file" ';
            $html .= 'id="' . $name . '" ';
            $html .= 'name="' . $name . '" ';
            $html .= 'class="' . $inputClass . '" ';
            if ($accept) {
                $html .= 'accept="' . $accept . '" ';
            }
            if ($required) {
                $html .= 'required ';
            }
            $html .= '>';
            
            if ($help) {
                $html .= '<small class="form-text text-muted">' . $help . '</small>';
            }
            
            if ($hasError) {
                $html .= '<div class="invalid-feedback">' . session('errors')->first($name) . '</div>';
            }
            
            $html .= '</div>';
            
            return $html;
        }
    @endphp
@endif
