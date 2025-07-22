@extends('admin.layout.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css" />
    <style>
        .dropify-wrapper {
            border: 2px dashed #ccc;
            border-radius: 5px;
        }
    </style>
@endpush

@section('content')
<main class="main-content">
    <div class="content-header fade-in">
        <h1>@yield('page-title', 'About')</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href=('{{ route('admin.about.index') }}')>About</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'Add About')</li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
         <form action="#" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Title -->
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <!-- Description -->
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" rows="5"></textarea>
    </div>

    <!-- Image with Dropify -->
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" class="dropify" 
            data-height="200" 
            data-max-file-size="2M"
            data-allowed-file-extensions="jpg jpeg png gif"
            data-default-file="" />
    </div>

    <!-- Experience & Client -->
    <div class="form-group">
        <label for="Experience">Experience</label>
        <input type="number" name="Experience" class="form-control">
    </div>

    <div class="form-group">
        <label for="client">Client</label>
        <input type="number" name="client" class="form-control">
    </div>

    <!-- Point Title & Description -->
    {{-- <div class="form-group">
        <label for="point_title">Point Title</label>
        <input type="text" name="point_title" class="form-control">
    </div>

    <div class="form-group">
        <label for="point_description">Point Description</label>
        <input type="text" name="point_description" class="form-control">
    </div> --}}

    <h4>Points Details</h4>
  {{-- @for($i = 1; $i <= 4; $i++)
    <div class="card p-2 mb-3">
        <h5>Point {{ $i }}</h5>

        <!-- Icon Upload -->
        <div class="form-group">
            <label>Icon Image</label>
            <input type="file" name="points[{{ $i }}][icon]" class="form-control dropify" />
        </div>

        <div class="form-group">
            <label>Title</label>
            <input type="text" name="points[{{ $i }}][title]" class="form-control">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="points[{{ $i }}][description]" class="form-control"></textarea>
        </div>
    </div>
@endfor --}}


    <button type="submit" class="btn btn-primary">Save</button>
</form>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof jQuery != 'undefined') {
            initializeDropify();
        } else {
            loadScript('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', function() {
                loadScript('https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/js/dropify.min.js', function() {
                    initializeDropify();
                });
            });
        }
    });

    function loadScript(url, callback) {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = url;
        script.onload = callback;
        document.head.appendChild(script);
    }

    function initializeDropify() {
        $('.dropify').dropify({
            messages: {
                default: 'Drag and drop a file here or click',
                replace: 'Drag and drop or click to replace',
                remove: 'Remove',
                error: 'Error'
            }
        });
    }
</script>
@endpush
        </div>
    </div>
</main>

@endsection