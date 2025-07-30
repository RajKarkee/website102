{{-- Admin Status Badge Component --}}
@props([
    'status' => 'active',
    'type' => 'default', // default, boolean, custom
    'customStatuses' => [], // For custom status mappings
    'size' => 'normal' // small, normal, large
])

@php
    $sizeClass = match($size) {
        'small' => 'badge-sm',
        'large' => 'badge-lg',
        default => ''
    };

    if ($type === 'boolean') {
        $badgeClass = $status ? 'bg-success' : 'bg-secondary';
        $badgeText = $status ? 'Active' : 'Inactive';
        $badgeIcon = $status ? 'fas fa-check' : 'fas fa-times';
    } elseif ($type === 'custom' && isset($customStatuses[$status])) {
        $config = $customStatuses[$status];
        $badgeClass = $config['class'] ?? 'bg-secondary';
        $badgeText = $config['text'] ?? $status;
        $badgeIcon = $config['icon'] ?? null;
    } else {
        // Default status mappings
        $statusMap = [
            'active' => ['class' => 'bg-success', 'text' => 'Active', 'icon' => 'fas fa-check'],
            'inactive' => ['class' => 'bg-secondary', 'text' => 'Inactive', 'icon' => 'fas fa-times'],
            'pending' => ['class' => 'bg-warning', 'text' => 'Pending', 'icon' => 'fas fa-clock'],
            'approved' => ['class' => 'bg-success', 'text' => 'Approved', 'icon' => 'fas fa-check'],
            'rejected' => ['class' => 'bg-danger', 'text' => 'Rejected', 'icon' => 'fas fa-times'],
            'draft' => ['class' => 'bg-info', 'text' => 'Draft', 'icon' => 'fas fa-edit'],
            'published' => ['class' => 'bg-primary', 'text' => 'Published', 'icon' => 'fas fa-eye'],
            'archived' => ['class' => 'bg-dark', 'text' => 'Archived', 'icon' => 'fas fa-archive'],
        ];
        
        $config = $statusMap[strtolower($status)] ?? ['class' => 'bg-secondary', 'text' => ucfirst($status), 'icon' => null];
        $badgeClass = $config['class'];
        $badgeText = $config['text'];
        $badgeIcon = $config['icon'];
    }
@endphp

<span class="badge {{ $badgeClass }} {{ $sizeClass }}">
    @if($badgeIcon)
        <i class="{{ $badgeIcon }}"></i>
    @endif
    {{ $badgeText }}
</span>

@once
    @push('styles')
    <style>
        .badge-sm {
            font-size: 0.65rem;
            padding: 0.25rem 0.4rem;
        }
        .badge-lg {
            font-size: 0.9rem;
            padding: 0.5rem 0.75rem;
        }
        .badge i {
            margin-right: 0.25rem;
        }
    </style>
    @endpush
@endonce
