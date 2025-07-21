@extends('admin.layout.app')

@section('content')
<main class="main-content">
    <div class="content-header fade-in">
        <h1>@yield('page-title', 'About')</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'About')</li>
            </ol>
        </nav>
    </div>


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>   
    @endif

    <div class="card">
        <div class="card-body">
            <div class="text-right mb-3">
                <a href="{{{ route('admin.about.add') }}}" class="btn btn-primary">Add About</a>
            </div>
            
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
                    {{-- <tbody>
                        @foreach($abouts as $about)
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
                                <form action="{{ route('admin.about.destroy', $about->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody> --}}
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