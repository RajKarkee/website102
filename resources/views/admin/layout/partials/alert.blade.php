
@foreach (['success', 'error', 'warning', 'info'] as $msg)
    @if(session($msg))
        <div class="alert alert-{{ $msg == 'error' ? 'danger' : $msg }} alert-dismissible fade show d-flex align-items-center shadow-sm border-0" role="alert">
            <i class="me-2 fas 
                @if($msg == 'success') fa-check-circle text-success
                @elseif($msg == 'error') fa-times-circle text-danger
                @elseif($msg == 'warning') fa-exclamation-triangle text-warning
                @elseif($msg == 'info') fa-info-circle text-info
                @endif"></i>
            <div class="flex-grow-1">
                {{ session($msg) }}
            </div>
            <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endforeach


@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-start shadow-sm border-0" role="alert">
        <i class="me-2 fas fa-times-circle text-danger mt-1"></i>
        <div>
            <strong class="d-block">Please fix the following errors:</strong>
            <ul class="mb-0 ps-3 small">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
