{{-- Admin Action Buttons Component --}}
@props([
    'resource' => null,
    'routePrefix' => '',
    'actions' => ['show', 'edit', 'delete'], // Available: show, edit, delete, activate, deactivate
    'size' => 'sm',
    'customActions' => [], // Array of custom action buttons
    'confirmDelete' => true,
    'deleteMessage' => 'Are you sure you want to delete this item?'
])

@php
    $btnSize = $size === 'sm' ? 'btn-sm' : ($size === 'lg' ? 'btn-lg' : '');
@endphp

<div class="btn-group" role="group" aria-label="Actions">
    @foreach($actions as $action)
        @switch($action)
            @case('show')
                @if($resource)
                    <a href="{{ route($routePrefix . '.show', $resource) }}" 
                       class="btn btn-info {{ $btnSize }}" 
                       title="View Details">
                        <i class="fas fa-eye"></i>
                    </a>
                @endif
                @break
                
            @case('edit')
                @if($resource)
                    <a href="{{ route($routePrefix . '.edit', $resource) }}" 
                       class="btn btn-primary {{ $btnSize }}" 
                       title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                @endif
                @break
                
            @case('delete')
                @if($resource)
                    <form action="{{ route($routePrefix . '.destroy', $resource) }}" 
                          method="POST" 
                          class="d-inline"
                          @if($confirmDelete) 
                              onsubmit="return confirm('{{ $deleteMessage }}')" 
                          @endif>
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-danger {{ $btnSize }}" 
                                title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                @endif
                @break
                
            @case('activate')
                @if($resource)
                    <form action="{{ route($routePrefix . '.activate', $resource) }}" 
                          method="POST" 
                          class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="btn btn-success {{ $btnSize }}" 
                                title="Activate">
                            <i class="fas fa-check"></i>
                        </button>
                    </form>
                @endif
                @break
                
            @case('deactivate')
                @if($resource)
                    <form action="{{ route($routePrefix . '.deactivate', $resource) }}" 
                          method="POST" 
                          class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="btn btn-warning {{ $btnSize }}" 
                                title="Deactivate">
                            <i class="fas fa-pause"></i>
                        </button>
                    </form>
                @endif
                @break
        @endswitch
    @endforeach
    
    {{-- Custom Actions --}}
    @foreach($customActions as $customAction)
        {!! $customAction !!}
    @endforeach
</div>
