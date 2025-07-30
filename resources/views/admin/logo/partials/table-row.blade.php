{{-- Logo Table Row Partial --}}
<td class="fw-bold text-primary">{{ $index + 1 }}</td>
<td>
    @if($logo->logo_image)
        <img src="{{ asset('storage/' . $logo->logo_image) }}" 
             alt="{{ $logo->company_name }}"
             class="rounded border shadow-sm" 
             style="height: 50px; width: auto; object-fit: contain;">
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
                <a href="{{ $logo->website }}" target="_blank" class="text-decoration-none text-primary">
                    <i class="fas fa-external-link-alt me-1"></i>{{ $logo->website }}
                </a>
            </small>
        @endif
    </div>
</td>
<td>
    @if($logo->tagline)
        <span class="text-muted fst-italic">"{{ $logo->tagline }}"</span>
    @else
        <em class="text-muted">No tagline</em>
    @endif
</td>
<td>
    <div class="small">
        @if($logo->phone)
            <div class="mb-1">
                <i class="fas fa-phone text-success me-1"></i>
                <a href="tel:{{ $logo->phone }}" class="text-decoration-none">{{ $logo->phone }}</a>
            </div>
        @endif
        @if($logo->email)
            <div>
                <i class="fas fa-envelope text-info me-1"></i>
                <a href="mailto:{{ $logo->email }}" class="text-decoration-none">{{ $logo->email }}</a>
            </div>
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
           title="View Details">
            <i class="fas fa-eye"></i>
        </a>
        <a href="{{ route('admin.logo.edit', $logo) }}" 
           class="btn btn-outline-primary" 
           title="Edit Logo">
            <i class="fas fa-edit"></i>
        </a>
        @if(!$logo->is_active)
            <form action="{{ route('admin.logo.activate', $logo) }}" 
                  method="POST" 
                  class="d-inline"
                  title="Set as Active">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-outline-success">
                    <i class="fas fa-star"></i>
                </button>
            </form>
        @endif
        <form action="{{ route('admin.logo.destroy', $logo) }}" 
              method="POST" 
              class="d-inline"
              onsubmit="return confirm('Are you sure you want to delete this logo? This action cannot be undone.')"
              title="Delete Logo">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    </div>
</td>
