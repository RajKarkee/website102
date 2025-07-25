@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        <div class="content-header fade-in">
            <h1>CTA Management</h1>

        </div>
        <div class="cta-admin">
            <a href="{{ route('admin.cta.create') }}" class="btn btn-primary mb-3">Add New CTA</a>
            <div class="table-responsive">
                <table class="table table-hover align-middle shadow-sm border rounded">
                    <thead class="table-light">
                        <tr style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                            <th>Page</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Button 1</th>
                            <th>Button 2</th>
                            <th style="width:160px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ctas as $cta)
                            <tr>
                                <td>
                                    <span class="badge bg-primary text-uppercase">{{ $cta->page }}</span>
                                </td>
                                <td>{{ Str::limit($cta->title, 32) }}</td>
                                <td class="small">{{ Str::limit($cta->description, 60) }}</td>
                                <td>{{ Str::limit($cta->button1_text, 18) }}</td>
                                <td>
                                    @if ($cta->button2_text)
                                        {{ Str::limit($cta->button2_text, 18) }}
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.cta.edit', $cta) }}" class="btn btn-warning btn-sm me-1"
                                        style="color: #fff; background-color: #ffc107; border-color: #ffc107; transition: background 0.2s;"
                                        onmouseover="this.style.backgroundColor='#e0a800'"
                                        onmouseout="this.style.backgroundColor='#ffc107'">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.cta.destroy', $cta) }}" method="POST"
                                        style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            style="color: #fff; background-color: #dc3545; border-color: #dc3545; transition: background 0.2s;"
                                            onmouseover="this.style.backgroundColor='#a71d2a'"
                                            onmouseout="this.style.backgroundColor='#dc3545'"
                                            onclick="return confirm('Delete this CTA?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No CTAs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
