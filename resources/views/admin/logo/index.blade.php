@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Logo Management',
            'description' => 'Manage your company logo and branding information',
            'breadcrumbs' => [
                ['title' => 'Logo Management', 'url' => '#']
            ],
            'actions' => '<a href="' . route('admin.logo.create') . '" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Logo
            </a>'
        ])

        <div class="logo-admin">
            @include('components.alerts')

            @include('admin.layout.partials.table', [
                'title' => 'Company Logos',
                'headers' => ['#', 'Logo', 'Company Name', 'Tagline', 'Contact', 'Status', 'Created'],
                'items' => $logos->map(function($logo, $index) {
                    return view('admin.logo.partials.table-row', compact('logo', 'index'))->render();
                }),
                'searchable' => true,
                'exportable' => true,
                'emptyMessage' => 'No logos found. Create your first logo to get started.'
            ])

            @if($logos->count() > 0)
                <div class="mt-4">
                    <div class="card border-info border-0 shadow-sm rounded-3">
                        <div class="card-body bg-light">
                            <h6 class="card-title d-flex align-items-center mb-3">
                                <i class="fas fa-lightbulb text-warning me-2"></i> 
                                <span class="fw-bold">Quick Tips</span>
                            </h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled mb-0 small">
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Only one logo can be active at a time
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            The active logo will be used across your website
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled mb-0 small">
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Upload high-quality images for better results
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Supported formats: JPEG, PNG, JPG, GIF, SVG
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection
                                    @foreach($logos as $logo)
                                        <tr class="{{ $logo->is_active ? 'table-success' : '' }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($logo->logo_image)
                                                    <img src="{{ asset('storage/' . $logo->logo_image) }}" 
                                                         alt="{{ $logo->company_name }}"
                                                         class="rounded border border-primary" 
                                                         style="width: 60px; height: 60px; object-fit: contain;">
                                                @else
                                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center" 
                                                         style="width: 60px; height: 60px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="fw-semibold">{{ $logo->company_name }}</div>
                                                @if($logo->website)
                                                    <small class="text-muted">{{ $logo->website }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($logo->tagline)
                                                    <small class="text-muted fst-italic">{{ Str::limit($logo->tagline, 40) }}</small>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($logo->phone)
                                                    <div><i class="fas fa-phone text-primary"></i> {{ $logo->phone }}</div>
                                                @endif
                                                @if($logo->email)
                                                    <div><i class="fas fa-envelope text-primary"></i> {{ $logo->email }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                @if($logo->is_active)
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check"></i> Active
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.logo.show', $logo) }}" 
                                                       class="btn btn-sm btn-outline-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.logo.edit', $logo) }}" 
                                                       class="btn btn-sm btn-outline-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @if(!$logo->is_active)
                                                        <form action="{{ route('admin.logo.activate', $logo) }}" 
                                                              method="POST" 
                                                              style="display: inline-block;"
                                                              onsubmit="return confirm('Set this logo as active?')">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-sm btn-outline-success">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form action="{{ route('admin.logo.destroy', $logo) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-outline-danger"
                                                                onclick="return confirm('Delete this logo? This action cannot be undone.')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-image fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No logos found</h5>
                            <p class="text-muted">Create your first company logo to get started.</p>
                            <a href="{{ route('admin.logo.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Create First Logo
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            @if($logos->count() > 0)
                <!-- Quick Stats -->
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-image fa-2x mb-2"></i>
                                <h5>{{ $logos->count() }}</h5>
                                <small>Total Logos</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-check-circle fa-2x mb-2"></i>
                                <h5>{{ $logos->where('is_active', true)->count() }}</h5>
                                <small>Active</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-share-alt fa-2x mb-2"></i>
                                <h5>{{ $logos->whereNotNull('facebook_url')->count() + $logos->whereNotNull('twitter_url')->count() + $logos->whereNotNull('instagram_url')->count() }}</h5>
                                <small>With Social Links</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-phone fa-2x mb-2"></i>
                                <h5>{{ $logos->whereNotNull('phone')->count() }}</h5>
                                <small>With Contact Info</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection
