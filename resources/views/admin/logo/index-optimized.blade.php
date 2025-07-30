@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        <x-admin.page-header 
            title="Logo Management"
            :breadcrumbs="[
                ['title' => 'Logo Management', 'url' => '#']
            ]">
            <x-slot name="actions">
                <a href="{{ route('admin.logo.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Logo
                </a>
            </x-slot>
        </x-admin.page-header>

        <div class="logo-admin">
            @include('components.alerts')

            @php
                $headers = ['#', 'Logo', 'Company Name', 'Tagline', 'Status', 'Created'];
                $rows = [];
                
                foreach($logos as $logo) {
                    $logoImage = $logo->logo_image 
                        ? '<img src="' . asset('storage/' . $logo->logo_image) . '" alt="' . $logo->company_name . '" style="height: 40px; width: auto; border-radius: 4px;">'
                        : '<i class="fas fa-image text-muted fa-2x"></i>';
                        
                    $status = view('admin.components.status-badge', [
                        'status' => $logo->is_active,
                        'type' => 'boolean'
                    ])->render();
                    
                    $actions = view('admin.components.action-buttons', [
                        'resource' => $logo,
                        'routePrefix' => 'admin.logo',
                        'actions' => ['show', 'edit', 'delete'],
                        'customActions' => !$logo->is_active ? [
                            '<form action="' . route('admin.logo.activate', $logo) . '" method="POST" class="d-inline">
                                ' . csrf_field() . method_field('PATCH') . '
                                <button type="submit" class="btn btn-success btn-sm" title="Set as Active">
                                    <i class="fas fa-star"></i>
                                </button>
                            </form>'
                        ] : []
                    ])->render();
                    
                    $rows[] = [
                        $logo->id,
                        $logoImage,
                        '<div>
                            <strong>' . $logo->company_name . '</strong>
                            ' . ($logo->website ? '<br><small><a href="' . $logo->website . '" target="_blank" class="text-muted">' . $logo->website . '</a></small>' : '') . '
                        </div>',
                        $logo->tagline ?: '<em class="text-muted">No tagline</em>',
                        $status,
                        $logo->created_at->format('M d, Y'),
                        $actions
                    ];
                }
            @endphp

            <x-admin.data-table 
                :headers="$headers"
                :rows="$rows"
                :searchable="true"
                :sortable="true"
                empty-message="No logos found. Create your first logo to get started."
            />

            @if($logos->count() > 0)
                <div class="mt-4">
                    <div class="card border-info">
                        <div class="card-body">
                            <h6 class="card-title">
                                <i class="fas fa-info-circle text-info"></i> Quick Tips
                            </h6>
                            <ul class="mb-0 small text-muted">
                                <li>Only one logo can be active at a time</li>
                                <li>The active logo will be used across your website</li>
                                <li>Upload high-quality images for better results</li>
                                <li>Supported formats: JPEG, PNG, JPG, GIF, SVG</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection
