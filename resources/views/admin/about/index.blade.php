@extends('admin.layout.app')

@section('content')
<main class="main-content">
    @include('admin.layout.partials.header', [
        'title' => 'About Management',
        'description' => 'Manage your company about section content',
        'breadcrumbs' => [
            ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['title' => 'About Management', 'url' => '#']
        ],
        'actions' => '<a href="' . route('admin.about.add') . '" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add About Section
        </a>'
    ])


        @if (session('success'))
            @include('admin.layout.partials.alert', ['type' => 'success', 'message' => session('success')])
        @endif
        @if (session('error'))
            @include('admin.layout.partials.alert', ['type' => 'danger', 'message' => session('error')])
        @endif    <div class="card">
        <div class="card-body">
            @if($about->isEmpty())
            <div class="text-right mb-3">
                <a href="{{{ route('admin.about.add') }}}" class="btn btn-primary">Add About</a>
            </div>
            @endif
                <table id="aboutTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($about as $about)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $about->title }}</td>
                            <td>{{ Str::limit($about->description, 50) }}</td>
                            <td>
                                @if($about->image)
                                    <img src="{{ asset('storage/' . $about->image) }}" alt="About Image" width="80">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.about.edit', $about->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.about.delete', $about->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                                <a href="{{ route('admin.about.addPoint',$about->id) }}" class="btn btn-sm btn-info">Add points</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @push('scripts')
                <!-- Include jQuery and jsTable (or DataTables) JS/CSS here -->
                <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
                <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
                <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#aboutTable').DataTable();
                    });
                </script>
                @endpush
                {{-- {{ $abouts->links() }} --}}
            {{-- @else
                <p>No about information found.</p>
            @endif --}}
        </div>
    </div>
</main>
@endsection