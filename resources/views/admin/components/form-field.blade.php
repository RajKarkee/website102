{{-- Admin Form Field Component --}}
@props([
    'name' => '',
    'label' => '',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'help' => '',
    'icon' => null,
    'options' => [], // For select, radio, checkbox
    'rows' => 3, // For textarea
    'accept' => '', // For file inputs
    'multiple' => false,
    'readonly' => false,
    'disabled' => false,
    'min' => null,
    'max' => null,
    'step' => null
])

@php
    $hasError = $errors->has($name);
    $inputClass = 'form-control' . ($hasError ? ' is-invalid' : '');
    $inputId = $name . '_' . Str::random(5);
    $oldValue = old($name, $value);
@endphp

<div class="form-group mb-3">
    @if($label)
        <label for="{{ $inputId }}" class="form-label">
            @if($icon)
                <i class="{{ $icon }}"></i>
            @endif
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    
    @switch($type)
        @case('textarea')
            <textarea 
                id="{{ $inputId }}"
                name="{{ $name }}"
                class="{{ $inputClass }}"
                rows="{{ $rows }}"
                placeholder="{{ $placeholder }}"
                {{ $required ? 'required' : '' }}
                {{ $readonly ? 'readonly' : '' }}
                {{ $disabled ? 'disabled' : '' }}
            >{{ $oldValue }}</textarea>
            @break
            
        @case('select')
            <select 
                id="{{ $inputId }}"
                name="{{ $name }}"
                class="{{ $inputClass }}"
                {{ $required ? 'required' : '' }}
                {{ $disabled ? 'disabled' : '' }}
                {{ $multiple ? 'multiple' : '' }}
            >
                @if(!$multiple && !$required)
                    <option value="">{{ $placeholder ?: 'Select option...' }}</option>
                @endif
                @foreach($options as $optionValue => $optionLabel)
                    <option value="{{ $optionValue }}" 
                            {{ (string)$oldValue === (string)$optionValue ? 'selected' : '' }}>
                        {{ $optionLabel }}
                    </option>
                @endforeach
            </select>
            @break
            
        @case('file')
            <input 
                type="file"
                id="{{ $inputId }}"
                name="{{ $name }}"
                class="{{ $inputClass }}"
                {{ $accept ? 'accept=' . $accept : '' }}
                {{ $multiple ? 'multiple' : '' }}
                {{ $required ? 'required' : '' }}
                {{ $disabled ? 'disabled' : '' }}
            >
            @break
            
        @case('checkbox')
            <div class="form-check">
                <input 
                    type="checkbox"
                    id="{{ $inputId }}"
                    name="{{ $name }}"
                    class="form-check-input{{ $hasError ? ' is-invalid' : '' }}"
                    value="1"
                    {{ $oldValue ? 'checked' : '' }}
                    {{ $disabled ? 'disabled' : '' }}
                >
                <label class="form-check-label" for="{{ $inputId }}">
                    {{ $placeholder ?: $label }}
                </label>
            </div>
            @break
            
        @case('radio')
            @foreach($options as $optionValue => $optionLabel)
                <div class="form-check">
                    <input 
                        type="radio"
                        id="{{ $inputId }}_{{ $loop->index }}"
                        name="{{ $name }}"
                        class="form-check-input{{ $hasError ? ' is-invalid' : '' }}"
                        value="{{ $optionValue }}"
                        {{ (string)$oldValue === (string)$optionValue ? 'checked' : '' }}
                        {{ $disabled ? 'disabled' : '' }}
                    >
                    <label class="form-check-label" for="{{ $inputId }}_{{ $loop->index }}">
                        {{ $optionLabel }}
                    </label>
                </div>
            @endforeach
            @break
            
        @default
            <input 
                type="{{ $type }}"
                id="{{ $inputId }}"
                name="{{ $name }}"
                class="{{ $inputClass }}"
                value="{{ $oldValue }}"
                placeholder="{{ $placeholder }}"
                {{ $required ? 'required' : '' }}
                {{ $readonly ? 'readonly' : '' }}
                {{ $disabled ? 'disabled' : '' }}
                {{ $min !== null ? 'min=' . $min : '' }}
                {{ $max !== null ? 'max=' . $max : '' }}
                {{ $step !== null ? 'step=' . $step : '' }}
            >
    @endswitch
    
    @if($help)
        <small class="form-text text-muted">{{ $help }}</small>
    @endif
    
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
