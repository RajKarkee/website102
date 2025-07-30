{{-- Admin Stats Card Component --}}
@props([
    'title' => '',
    'value' => '',
    'icon' => 'fas fa-chart-bar',
    'color' => 'primary',
    'trend' => null, // 'up', 'down', 'neutral'
    'trendValue' => null,
    'link' => null
])

@php
    $cardClass = match($color) {
        'primary' => 'border-primary text-primary',
        'success' => 'border-success text-success',
        'warning' => 'border-warning text-warning',
        'danger' => 'border-danger text-danger',
        'info' => 'border-info text-info',
        'secondary' => 'border-secondary text-secondary',
        default => 'border-primary text-primary'
    };

    $trendIcon = match($trend) {
        'up' => 'fas fa-arrow-up text-success',
        'down' => 'fas fa-arrow-down text-danger',
        'neutral' => 'fas fa-minus text-muted',
        default => null
    };
@endphp

<div class="card stat-card {{ $cardClass }} h-100">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div class="flex-grow-1">
                <h6 class="card-subtitle mb-2 text-muted">{{ $title }}</h6>
                <h3 class="card-title mb-0">{{ $value }}</h3>
                
                @if($trend && $trendValue)
                    <small class="text-muted mt-2 d-block">
                        <i class="{{ $trendIcon }}"></i>
                        {{ $trendValue }}
                    </small>
                @endif
            </div>
            <div class="stat-icon">
                <i class="{{ $icon }} fa-2x opacity-50"></i>
            </div>
        </div>
        
        @if($link)
            <a href="{{ $link }}" class="stretched-link"></a>
        @endif
    </div>
</div>

@once
    @push('styles')
    <style>
        .stat-card {
            transition: all 0.3s ease;
            position: relative;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .stat-card .stat-icon {
            opacity: 0.7;
        }
        
        .stat-card:hover .stat-icon {
            opacity: 1;
        }
    </style>
    @endpush
@endonce
