@extends('admin.layout.app')
@section('content')
<main class="main-content">
    <div class="content-header fade-in">
        <h1>@yield('page-title', 'Industry')</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.industry.index') }}">Industry</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'Edit Industry')</li>
            </ol>
        </nav>
    </div>

    <div class="container-indus">
        <style>
            .point-input { margin-bottom: 10px; display: flex; align-items: center; }
            .point-number { margin-right: 10px; font-weight: bold; }
            .remove-point { color: red; cursor: pointer; margin-left: 10px; font-size: 20px; }
            
            /* Dropify customization */
            .dropify-wrapper {
                border: 2px dashed #ccc;
                border-radius: 5px;
            }
            .dropify-wrapper:hover {
                background: #f8f9fa;
            }
            .dropify-wrapper .dropify-preview {
                background-color: #fff;
                padding: 10px;
            }
            .dropify-wrapper .dropify-clear {
                border: none;
                padding: 5px 10px;
                border-radius: 3px;
                background: #dc3545;
                color: #fff;
            }
            .dropify-wrapper .dropify-message p {
                font-size: 16px;
                color: #666;
            }
        </style>

        <form id="industryForm" method="POST" action="{{ route('admin.industry.edit', $industryData->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="icon">Icon</label>
                <input type="file" id="icon" name="icon" class="dropify" 
                    data-allowed-file-extensions="png jpg jpeg svg" 
                    data-max-file-size="2M"
                    data-height="200"
                    data-show-remove="true"
                    data-show-loader="true"
                    data-show-errors="true"
                    data-errors-position="outside"
                    data-allowed-formats="landscape"
                    data-default-file="{{ asset('storage/' . $industryData->icon) }}"
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" required maxlength="255" value="{{ $industryData->title }}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3" required maxlength="1000">{{ $industryData->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="Points">Points</label>
                <div id="points-wrapper">
                    @php
                        $points = json_decode($industryData->services, true) ?? [];
                    @endphp
                    @foreach($points as $index => $point)
                        <div class="point-input">
                            <span class="point-number">{{ $index + 1 }}.</span>
                            <input type="text" name="points[]" class="form-control d-inline-block w-75" maxlength="255" required value="{{ $point }}" placeholder="Point">
                            <span class="remove-point">&times;</span>
                        </div>
                    @endforeach
                </div>

                <div class="form-group mt-2">
                    <button type="button" id="add-point" class="btn btn-secondary">Add Point</button>
                    <span id="point-count" class="ml-2">{{ count($points) }}/4 Points</span>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </form>
    </div>
</main>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css" />
@endpush

@push('scripts')
<script>
$(function() {
    // Initialize dropify
    if ($.fn.dropify) {
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop an icon here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Oops, something wrong happened.'
            },
            error: {
                'fileSize': 'The file size is too big (2M max).',
                'fileExtension': 'The file extension is not allowed (png, jpg, jpeg, svg only).'
            }
        });
    }

    let maxPoints = 4;

    function updatePointNumbering() {
        $('#points-wrapper .point-input').each(function(index) {
            $(this).find('.point-number').text((index + 1) + '.');
        });
    }

    function updatePointCount() {
        let count = $('#points-wrapper .point-input').length;
        $('#point-count').text(count + '/' + maxPoints + ' Points');
        $('#add-point').prop('disabled', count >= maxPoints);
        updatePointNumbering();
    }

    // Add point button click handler
    $('#add-point').on('click', function() {
        console.log('Add point clicked');
        let count = $('#points-wrapper .point-input').length;
        if (count < maxPoints) {
            const newPoint = $(`
                <div class="point-input">
                    <span class="point-number">${count + 1}.</span>
                    <input type="text" name="points[]" class="form-control d-inline-block w-75" maxlength="255" required placeholder="Point">
                    <span class="remove-point">&times;</span>
                </div>
            `).hide();
            
            $('#points-wrapper').append(newPoint);
            newPoint.fadeIn(300);
            updatePointCount();
        }
    });

    // Remove point click handler (using event delegation)
    $('#points-wrapper').on('click', '.remove-point', function() {
        $(this).closest('.point-input').fadeOut(300, function() {
            $(this).remove();
            updatePointCount();
        });
    });

    // Initialize the count
    updatePointCount();
});
</script>
@endpush
@endsection
