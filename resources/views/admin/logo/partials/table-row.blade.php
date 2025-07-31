<tr class="{{ $logo->is_active ? 'table-success' : '' }}" data-logo-id="{{ $logo->id }}">
    <td class="fw-bold text-primary">{{ $index + 1 }}</td>
    <td>
        @if($logo->logo_image)
            <img src="{{ asset('storage/' . $logo->logo_image) }}" 
                 alt="{{ $logo->company_name }}"
                 class="rounded border shadow-sm" 
                 style="height: 50px; width: auto; object-fit: contain;"
                 loading="lazy">
        @else
            <div class="d-flex align-items-center justify-content-center bg-light border rounded" 
                 style="height: 50px; width: 50px;">
                <i class="fas fa-image text-muted"></i>
            </div>
        @endif
    </td>
    <td>
        <div>
            <strong class="text-dark">{{ $logo->company_name }}</strong>
            @if($logo->website)
                <br>
                <small>
                    <a href="{{ $logo->website }}" 
                       target="_blank" 
                       class="text-decoration-none text-primary"
                       data-bs-toggle="tooltip" 
                       title="Visit website">
                        <i class="fas fa-external-link-alt me-1"></i>{{ Str::limit($logo->website, 25) }}
                    </a>
                </small>
            @endif
        </div>
    </td>
    <td>
        @if($logo->tagline)
            <span class="text-muted fst-italic">"{{ Str::limit($logo->tagline, 30) }}"</span>
        @else
            <em class="text-muted">No tagline</em>
        @endif
    </td>
    <td>
        <div class="small">
            @if($logo->phone)
                <div class="mb-1">
                    <i class="fas fa-phone text-success me-1"></i>
                    <a href="tel:{{ $logo->phone }}" 
                       class="text-decoration-none"
                       data-bs-toggle="tooltip" 
                       title="Call {{ $logo->phone }}">{{ $logo->phone }}</a>
                </div>
            @endif
            @if($logo->email)
                <div>
                    <i class="fas fa-envelope text-info me-1"></i>
                    <a href="mailto:{{ $logo->email }}" 
                       class="text-decoration-none"
                       data-bs-toggle="tooltip" 
                       title="Send email to {{ $logo->email }}">{{ Str::limit($logo->email, 20) }}</a>
                </div>
            @endif
            @if(!$logo->phone && !$logo->email)
                <em class="text-muted">No contact info</em>
            @endif
        </div>
    </td>
    <td>
        @if($logo->is_active)
            <span class="badge bg-success d-flex align-items-center">
                <i class="fas fa-star me-1"></i> Active
            </span>
        @else
            <span class="badge bg-secondary d-flex align-items-center">
                <i class="fas fa-pause me-1"></i> Inactive
            </span>
        @endif
    </td>
    <td>
        <small class="text-muted">{{ $logo->created_at->format('M d, Y') }}</small>
        <br>
        <small class="text-muted">{{ $logo->created_at->diffForHumans() }}</small>
    </td>
    <td>
        <div class="btn-group btn-group-sm" role="group">
            <a href="{{ route('admin.logo.show', $logo) }}" 
               class="btn btn-outline-info" 
               data-bs-toggle="tooltip" 
               title="View Details">
                <i class="fas fa-eye"></i>
            </a>
            <a href="{{ route('admin.logo.edit', $logo) }}" 
               class="btn btn-outline-primary" 
               data-bs-toggle="tooltip" 
               title="Edit Logo">
                <i class="fas fa-edit"></i>
            </a>
            @if(!$logo->is_active)
                <form action="{{ route('admin.logo.activate', $logo) }}" 
                      method="POST" 
                      class="d-inline"
                      onsubmit="return confirmActivation('{{ $logo->company_name }}')">
                    @csrf
                    @method('PATCH')
                    <button type="submit" 
                            class="btn btn-outline-success"
                            data-bs-toggle="tooltip" 
                            title="Set as Active Logo">
                        <i class="fas fa-star"></i>
                    </button>
                </form>
            @endif
            <form action="{{ route('admin.logo.destroy', $logo) }}" 
                  method="POST" 
                  class="d-inline"
                  onsubmit="return confirmDeletion('{{ $logo->company_name }}')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="btn btn-outline-danger"
                        data-bs-toggle="tooltip" 
                        title="Delete Logo">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </td>
</tr>
