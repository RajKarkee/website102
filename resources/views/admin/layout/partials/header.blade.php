{{-- Enhanced Admin Header Partial --}}
@props([
    'title' => 'Admin Page',
    'description' => null,
    'breadcrumbs' => [],
    'actions' => null
])

<div class="content-header fade-in mb-4">
    <div class="d-flex justify-content-between align-items-start">
        <div class="flex-grow-1">
            <h1 class="h2 mb-1 fw-bold text-dark">{{ $title }}</h1>
            
            @if($description)
                <p class="text-muted mb-2">{{ $description }}</p>
            @endif
            
            @if(count($breadcrumbs) > 0)
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        @foreach($breadcrumbs as $breadcrumb)
                            @if($loop->last)
                                <li class="breadcrumb-item active text-primary fw-medium" aria-current="page">
                                    {{ $breadcrumb['title'] }}
                                </li>
                            @else
                                <li class="breadcrumb-item">
                                    <a href="{{ $breadcrumb['url'] }}" class="text-decoration-none">
                                        {{ $breadcrumb['title'] }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
            @endif
        </div>
        
        @if($actions)
            <div class="page-actions ms-3">
                {{ $actions }}
            </div>
        @endif
    </div>
</div>

<style>
    .content-header {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .breadcrumb {
        background: none;
        padding: 0.5rem 0;
        margin: 0;
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        content: var(--bs-breadcrumb-divider, ">");
        color: #6c757d;
    }
    
    .page-actions .btn {
        margin-left: 0.5rem;
    }
    
    .page-actions .btn:first-child {
        margin-left: 0;
    }
</style>
