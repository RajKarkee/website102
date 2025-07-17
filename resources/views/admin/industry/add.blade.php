@extends('admin.layout.app')
@section('content')
<main class="main-content">
    <div class="content-header fade-in">
        <h1>@yield('page-title', 'Industry')</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'Industry')</li>
            </ol>
        </nav>
    </div>

    <div class="container-indus">
        <style>
            .point-input { margin-bottom: 10px; display: flex; align-items: center; }
            .point-number { margin-right: 10px; font-weight: bold; }
            .remove-point { color: red; cursor: pointer; margin-left: 10px; font-size: 20px; }
            
            /* Dropify customization */
     
        </style>

        <form id="industryForm" method="POST" action="{{ route('industry.add') }}" enctype="multipart/form-data">
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
                    data-default-file=""
                    required>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" required maxlength="255">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3" required maxlength="1000"></textarea>
            </div>

            <div class="form-group">
                <label for="Points">Points </label>

                <div id="points-wrapper">
                    <div class="point-input">
                        <span class="point-number">1.</span>
                        <input type="text" name="points[]" class="form-control d-inline-block w-75" maxlength="255" required placeholder="Point">
                        <span class="remove-point">&times;</span>
                    </div>
                </div>

                <div class="form-group mt-2">
                    <button type="button" id="add-point" class="btn btn-secondary">Add Point</button>
                    <span id="point-count" class="ml-2">1/4 Points</span>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</main>

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

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/js/dropify.min.js"></script>
@endpush
@endsection
