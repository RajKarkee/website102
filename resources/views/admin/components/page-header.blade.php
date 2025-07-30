{{-- Admin Page Header Component --}}
@props([
    'title' => 'Admin Page',
    'breadcrumbs' => [],
    'actions' => null
])

<div class="content-header fade-in">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-1">{{ $title }}</h1>
            @if(count($breadcrumbs) > 0)
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-home"></i> Home
                            </a>
                        </li>
                        @foreach($breadcrumbs as $breadcrumb)
                            @if($loop->last)
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $breadcrumb['title'] }}
                                </li>
                            @else
                                <li class="breadcrumb-item">
                                    <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
            @endif
        </div>
        @if($actions)
            <div class="page-actions">
                {{ $actions }}
            </div>
        @endif
    </div>
</div>
