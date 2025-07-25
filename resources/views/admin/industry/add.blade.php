@extends('admin.layout.app')

@push('styles')
    <style>
        .dropify-wrapper {
            border: 2px dashed #ccc;
            border-radius: 5px;
        }

        .dropify-wrapper .dropify-message p {
            font-size: 14px;
        }

        .point-input {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .point-number {
            font-weight: bold;
            min-width: 25px;
        }

        .point-input .form-control {
            flex: 1;
        }

        .remove-point {
            color: #dc3545;
            cursor: pointer;
            font-size: 20px;
            padding: 0 5px;
            user-select: none;
            border: none;
            background: none;
            min-width: 30px;
            text-align: center;
        }

        .remove-point:hover {
            color: #c82333;
            background-color: rgba(220, 53, 69, 0.1);
            border-radius: 3px;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .container-indus {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
@endpush

@section('content')
    <main class="main-content">
        <div class="content-header fade-in">
            <h1>@yield('page-title', 'Industry')</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.industry.index') }}">Industry</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'Add Industry')</li>
                </ol>
            </nav>
        </div>

        <div class="container-indus">
            <form id="industryForm" method="POST" action="{{ route('admin.industry.add') }}" enctype="multipart/form-data">
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
                        data-default-file="" 
                        required>
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" required maxlength="255" 
                           value="{{ old('title') }}" placeholder="Enter industry title">
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="3" required maxlength="1000" 
                              placeholder="Enter industry description">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Points</label>
                    <div id="points-wrapper">
                        @if(old('points'))
                            @foreach(old('points') as $index => $point)
                                <div class="point-input">
                                    <span class="point-number">{{ $index + 1 }}.</span>
                                    <input type="text" name="points[]" class="form-control" maxlength="255" 
                                           required placeholder="Point {{ $index + 1 }}" value="{{ $point }}">
                                    <button type="button" class="remove-point" title="Remove point">&times;</button>
                                </div>
                            @endforeach
                        @else
                            <div class="point-input">
                                <span class="point-number">1.</span>
                                <input type="text" name="points[]" class="form-control" maxlength="255" 
                                       required placeholder="Point 1">
                                <button type="button" class="remove-point" title="Remove point">&times;</button>
                            </div>
                        @endif
                    </div>

                    <div class="form-group mt-3 d-flex align-items-center gap-2">
                        <button type="button" id="add-point" class="btn btn-secondary">
                            <i class="fas fa-plus"></i> Add Point
                        </button>
                        <span id="point-count" class="ms-2 text-muted">1/4 Points</span>
                    </div>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="text-end mt-4">
                    <a href="{{ route('admin.industry.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        // Function to initialize dropify
        function initDropify() {
            if (typeof $.fn.dropify === 'function') {
                console.log('Initializing dropify...');
                $('.dropify').dropify({
                    messages: {
                        'default': 'Drag and drop an icon here or click',
                        'replace': 'Drag and drop or click to replace',
                        'remove': 'Remove',
                        'error': 'Oops, something wrong happened.'
                    }
                });
            } else {
                console.log('Dropify not loaded yet, retrying in 100ms...');
                setTimeout(initDropify, 100);
            }
        }

        // Wait for jQuery to be ready and ensure DOM is fully loaded
        $(document).ready(function() {
            console.log('DOM ready, initializing...');
            console.log('jQuery version:', $.fn.jquery);
            
            // Initialize dropify with retry mechanism
            initDropify();

            // Points functionality variables
            const maxPoints = 4;
            const $pointsWrapper = $('#points-wrapper');
            const $addPointBtn = $('#add-point');
            const $pointCountSpan = $('#point-count');

            // Function to update point numbering
            function updatePointNumbering() {
                $pointsWrapper.find('.point-input').each(function(index) {
                    const pointNumber = index + 1;
                    $(this).find('.point-number').text(pointNumber + '.');
                    $(this).find('input[name="points[]"]').attr('placeholder', 'Point ' + pointNumber);
                });
            }

            // Function to update point count and button state
            function updatePointCount() {
                const count = $pointsWrapper.find('.point-input').length;
                console.log('Current point count:', count);
                
                $pointCountSpan.text(count + '/' + maxPoints + ' Points');
                
                if (count >= maxPoints) {
                    $addPointBtn.prop('disabled', true);
                    console.log('Add button disabled - max points reached');
                } else {
                    $addPointBtn.prop('disabled', false);
                    console.log('Add button enabled');
                }
                
                updatePointNumbering();
            }

            // Add point functionality
            $(document).on('click', '#add-point', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('Add point button clicked');
                
                const count = $('#points-wrapper').find('.point-input').length;
                console.log('Current count before adding:', count);
                
                if (count < maxPoints) {
                    const pointNumber = count + 1;
                    const newPointHtml = `
                        <div class="point-input" style="display: none;">
                            <span class="point-number">${pointNumber}.</span>
                            <input type="text" name="points[]" class="form-control" maxlength="255" 
                                   required placeholder="Point ${pointNumber}">
                            <button type="button" class="remove-point" title="Remove point">&times;</button>
                        </div>
                    `;
                    
                    const $newPoint = $(newPointHtml);
                    $pointsWrapper.append($newPoint);
                    $newPoint.fadeIn(300);
                    updatePointCount();
                    
                    // Focus on the new input
                    $newPoint.find('input').focus();
                    console.log('New point added successfully');
                } else {
                    console.log('Cannot add point - max limit reached');
                    alert('Maximum 4 points allowed');
                }
            });

            // Remove point functionality using event delegation
            $pointsWrapper.on('click', '.remove-point', function(e) {
                e.preventDefault();
                console.log('Remove point clicked');
                
                const $pointDiv = $(this).closest('.point-input');
                const currentCount = $pointsWrapper.find('.point-input').length;
                
                if (currentCount > 1) {
                    $pointDiv.fadeOut(300, function() {
                        $(this).remove();
                        updatePointCount();
                        console.log('Point removed successfully');
                    });
                } else {
                    console.log('Cannot remove - at least one point required');
                    alert('At least one point is required');
                }
            });

            // Initialize the count on page load
            updatePointCount();

            // Form validation before submit
            $('#industryForm').on('submit', function(e) {
                const title = $('#title').val().trim();
                const description = $('#description').val().trim();
                const iconFile = $('#icon')[0].files[0];
                const points = [];
                
                // Collect all points
                $pointsWrapper.find('input[name="points[]"]').each(function() {
                    const pointValue = $(this).val().trim();
                    if (pointValue) {
                        points.push(pointValue);
                    }
                });

                // Validation
                if (!title) {
                    alert('Please enter a title');
                    $('#title').focus();
                    e.preventDefault();
                    return false;
                }

                if (!description) {
                    alert('Please enter a description');
                    $('#description').focus();
                    e.preventDefault();
                    return false;
                }

                if (!iconFile) {
                    alert('Please select an icon file');
                    e.preventDefault();
                    return false;
                }

                if (points.length === 0) {
                    alert('Please enter at least one point');
                    $pointsWrapper.find('input[name="points[]"]').first().focus();
                    e.preventDefault();
                    return false;
                }

                // Check for empty points
                let hasEmptyPoints = false;
                $pointsWrapper.find('input[name="points[]"]').each(function() {
                    if (!$(this).val().trim()) {
                        hasEmptyPoints = true;
                        $(this).focus();
                        return false;
                    }
                });

                if (hasEmptyPoints) {
                    alert('Please fill in all point fields or remove empty ones');
                    e.preventDefault();
                    return false;
                }

                console.log('Form validation passed');
                console.log('Title:', title);
                console.log('Description:', description);
                console.log('Points:', points);
                console.log('Icon file:', iconFile ? iconFile.name : 'None');
                
                // Form will submit normally if we reach here
                return true;
            });

            // Debug information
            console.log('Script initialized successfully');
            console.log('Add point button exists:', $addPointBtn.length > 0);
            console.log('Points wrapper exists:', $pointsWrapper.length > 0);
            
            // Test button state after initialization
            setTimeout(function() {
                console.log('Button disabled state:', $addPointBtn.prop('disabled'));
                console.log('Button visible:', $addPointBtn.is(':visible'));
                console.log('Initial points count:', $pointsWrapper.find('.point-input').length);
            }, 100);

            // Success message handling (if you have flash messages)
            @if(session('success'))
                alert('{{ session('success') }}');
            @endif

            @if(session('error'))
                alert('{{ session('error') }}');
            @endif
        });
    </script>
@endpush