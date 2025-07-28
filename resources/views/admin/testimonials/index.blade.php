@extends('admin.layout.app')
@section('content')
    <main class="main-content">
        <div class="content-header fade-in">
            <h1>@yield('page-title', 'Testimonials')</h1>
            <p class="text-muted">Testimonials</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'Testimonial')</li>
                </ol>
            </nav>
        </div>
        <div class="service">



            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif




            <div class="container">
                <div class="d-flex justify-content-between mb-3">
                    <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#testimonialForm">+
                        Add</button>

                </div>

                {{-- Form --}}
                <div id="testimonialForm" class="collapse mb-4">
                    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <label>Image:</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label>Description:</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        <div class="mb-2">
                            <label>Sub-description:</label>
                            <textarea name="sub_description" class="form-control"></textarea>
                        </div>
                        <div class="mb-2">
                            <label>Others:</label>
                            <textarea name="others" class="form-control" placeholder="optional"></textarea>
                        </div>
                        <!-- Optional: ensure status is always saved as disabled by default -->
                        <input type="hidden" name="status" value="0">

                        <button class="btn btn-success">Submit</button>
                    </form>
                </div>

                {{-- Table --}}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Sub-description</th>
                            <th>Others</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($testimonials as $testimonial)
                            <tr>
                                <td>
                                    @if ($testimonial->image)
                                        <img src="{{ asset('storage/' . $testimonial->image) }}" width="60"
                                            height="60">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $testimonial->description }}</td>
                                <td>{{ $testimonial->sub_description }}</td>
                                <td>{{ $testimonial->others ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('admin.testimonials.status', $testimonial) }}"
                                        class="btn btn-sm {{ $testimonial->status ? 'btn-success' : 'btn-secondary' }}">
                                        {{ $testimonial->status ? 'Enabled' : 'Disabled' }}
                                    </a>
                                </td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                                        class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <!-- Delete Form -->
                                    <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No testimonials yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>





        </div>
    </main>
@endsection
