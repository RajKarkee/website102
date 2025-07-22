@extends('admin.layout.app')
@section('content')
<main class="main-content">
    <div class="content-header fade-in">
        <h1>Add Points</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.about.index') }}">About</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Points</li>
            </ol>
        </nav>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.about.addPoint') }}' method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="point_title" class="form-label">Point Title</label>
                        <input type="text" name="point_title" id="point_title" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="point_description" class="form-label">Point Description</label>
                        <textarea name="point_description" id="point_description" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="row">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Point {{ $i }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label for="point_{{ $i }}_title">Title</label>
                                            <input type="text" name="point_{{ $i }}[title]" id="point_{{ $i }}_title" class="form-control" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="point_{{ $i }}_description">Description</label>
                                            <textarea name="point_{{ $i }}[description]" id="point_{{ $i }}_description" class="form-control" rows="2" required></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="point_{{ $i }}_icon">Icon</label>
                                            <input type="file" name="point_{{ $i }}[icon]" id="point_{{ $i }}_icon" class="form-control dropify" data-height="150" accept="image/*,.svg" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <div class="text-end mt-3">
                        <a href="{{ route('admin.about.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Points</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@push('styles')
<style>
    .card {
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .card-header {
        border-radius: 8px 8px 0 0;
    }
    .dropify-wrapper {
        border: 2px dashed #ccc;
        border-radius: 5px;
    }
    .form-label {
        font-weight: 500;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('.dropify').dropify({
            messages: {
                default: 'Drag and drop an icon here or click',
                replace: 'Drag and drop or click to replace',
                remove: 'Remove',
                error: 'Error uploading file.'
            },
            error: {
                fileSize: 'The file size is too big (2MB max).',
                imageFormat: 'Only image formats are allowed (.svg, .png, .jpg, .jpeg).'
            }
        });
    });
</script>
@endpush