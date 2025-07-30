{{-- Admin Form Card Component --}}
@props([
    'title' => 'Form',
    'subtitle' => null,
    'icon' => 'fas fa-edit',
    'action' => '',
    'method' => 'POST',
    'enctype' => null,
    'submitText' => 'Save',
    'cancelUrl' => null,
    'submitIcon' => 'fas fa-save',
    'cancelIcon' => 'fas fa-times'
])

<div class="card border-primary shadow rounded-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">
            <i class="{{ $icon }}"></i> {{ $title }}
            @if($subtitle)
                <small class="ms-2 opacity-75">{{ $subtitle }}</small>
            @endif
        </h5>
    </div>
    <div class="card-body">
        <form action="{{ $action }}" 
              method="{{ strtoupper($method) === 'GET' ? 'GET' : 'POST' }}"
              @if($enctype) enctype="{{ $enctype }}" @endif>
            
            @if(strtoupper($method) !== 'GET' && strtoupper($method) !== 'POST')
                @method($method)
            @endif
            
            @if(strtoupper($method) !== 'GET')
                @csrf
            @endif
            
            {{ $slot }}
            
            <div class="form-actions mt-4 pt-3 border-top">
                <div class="d-flex justify-content-end gap-2">
                    @if($cancelUrl)
                        <a href="{{ $cancelUrl }}" class="btn btn-secondary">
                            <i class="{{ $cancelIcon }}"></i> Cancel
                        </a>
                    @endif
                    <button type="submit" class="btn btn-primary">
                        <i class="{{ $submitIcon }}"></i> {{ $submitText }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
