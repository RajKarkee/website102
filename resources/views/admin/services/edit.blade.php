@extends('admin.layout.app')

@section('content')
<main class="main-content">
    @include('admin.layout.partials.header', [
        'title' => 'Edit Service',
        'description' => 'Update service information and details',
        'breadcrumbs' => [
            ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['title' => 'Services', 'url' => route('admin.service.index')],
            ['title' => 'Edit: ' . $serviceData->title, 'url' => '#']
        ],
        'actions' => '<a href="' . route('admin.service.index') . '" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Back to Services
        </a>'
    ])

    <div class="content-body">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Service Information</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Service Title -->
                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Service Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $serviceData->title }}" required>
                            </div>

                            <!-- Service Icon -->
                            <div class="form-group mb-3">
                                @include('admin.components.image-upload', [
                                    'name' => 'icon',
                                    'label' => 'Service Icon',
                                    'required' => false,
                                    'accept' => 'image/*',
                                    'maxSize' => '1MB',
                                    'previewSize' => 'small',
                                    'currentImage' => $serviceData->icon ? asset('storage/' . $serviceData->icon) : null,
                                    'description' => 'Update the icon for this service or keep the current one.',
                                    'placeholder' => 'Upload New Icon'
                                ])
                            </div>

                            <!-- Short & Long Description -->
                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Short Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $serviceData->description }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="long_description" class="form-label">Long Description</label>
                                <textarea class="form-control" id="long_description" name="long_description" rows="5">{{ $serviceData->long_description }}</textarea>
                            </div>

                            <!-- Service Color -->
                            <div class="form-group mb-3">
                                <label for="color" class="form-label">Service Color</label>
                                <select class="form-control" id="color" name="colors" onchange="updateColorPreview(this)">
                                    <option value="">Select Color</option>
                                    @foreach($colors as $color)
                                        <option value="{{ $color->id }}" data-color="{{ $color->hex_code }}" style="background-color: {{ $color->hex_code }}; color: {{ $color->hex_code === '#FFFFFF' || $color->hex_code === '#ffffff' ? '#000' : '#fff' }};">
                                            {{ $color->color }} ({{ $color->hex_code }})
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Choose a color for this service (optional)</small>
                                <div id="selected-color-preview" class="mt-2" style="display: none;">
                                    <div class="d-flex align-items-center">
                                        <div id="color-swatch" class="border rounded me-2" style="width: 30px; height: 30px; background-color: #ffffff;"></div>
                                        <span id="color-info" class="text-muted">No color selected</span>
                                    </div>
                                </div>
                            </div>  


                            <!-- Service Points -->
                            <div class="form-group mb-3">
                                <label class="form-label">Service Points</label>
                                <div id="points-container">
                                    @php
                                        $points = is_array($serviceData->points) ? $serviceData->points : (is_string($serviceData->points) ? json_decode($serviceData->points, true) : []);
                                    @endphp
                                    @foreach($points ?? [''] as $point)
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="points[]" value="{{ $point }}" placeholder="Enter service point">
                                            <button type="button" class="btn btn-outline-danger remove-point">Remove</button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="add-point" class="btn btn-outline-primary btn-sm">Add Point</button>
                            </div>

                            <!-- Point Descriptions -->
                            <div class="form-group mb-3">
                                <label class="form-label">Point Descriptions</label>
                                <div id="point-descriptions-container">
                                    @php
                                        $pointsDescription = is_array($serviceData->points_description) ? $serviceData->points_description : (is_string($serviceData->points_description) ? json_decode($serviceData->points_description, true) : []);
                                    @endphp
                                    @foreach($pointsDescription ?? [''] as $desc)
                                        <div class="input-group mb-2">
                                            <textarea class="form-control" name="points_description[]" rows="2">{{ $desc }}</textarea>
                                            <button type="button" class="btn btn-outline-danger remove-description">Remove</button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="add-description" class="btn btn-outline-primary btn-sm">Add Description</button>
                            </div>

                            <!-- Icon Titles -->
                            <div class="form-group mb-3">
                                <label class="form-label">Icon Titles</label>
                                <div id="icon-titles-container">
                                    @php
                                        $iconTitles = is_array($serviceData->icon_title) ? $serviceData->icon_title : (is_string($serviceData->icon_title) ? json_decode($serviceData->icon_title, true) : []);
                                    @endphp
                                    @foreach($iconTitles ?? [''] as $title)
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="icon_title[]" value="{{ $title }}" placeholder="Icon title">
                                            <button type="button" class="btn btn-outline-danger remove-icon-title">Remove</button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="add-icon-title" class="btn btn-outline-primary btn-sm">Add Icon Title</button>
                            </div>

                            <!-- Icon Descriptions -->
                            <div class="form-group mb-3">
                                <label class="form-label">Icon Descriptions</label>
                                <div id="icon-descriptions-container">
                                    @php
                                        $iconDescriptions = is_array($serviceData->icon_description) ? $serviceData->icon_description : (is_string($serviceData->icon_description) ? json_decode($serviceData->icon_description, true) : []);
                                    @endphp
                                    @foreach($iconDescriptions ?? [''] as $desc)
                                        <div class="input-group mb-2">
                                            <textarea class="form-control" name="icon_description[]" rows="2">{{ $desc }}</textarea>
                                            <button type="button" class="btn btn-outline-danger remove-icon-desc">Remove</button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="add-icon-desc" class="btn btn-outline-primary btn-sm">Add Icon Description</button>
                            </div>

                            <!-- Point Icons -->
                            <div class="form-group mb-3">
                                <label class="form-label">Point Icons</label>
                                <div id="point-icons-container">
                                    @php
                                        $pointIcons = is_array($serviceData->point_icon) ? $serviceData->point_icon : (is_string($serviceData->point_icon) ? json_decode($serviceData->point_icon, true) : []);
                                    @endphp
                                    @foreach($pointIcons ?? [''] as $index => $icon)
                                        <div class="input-group mb-2 align-items-center">
                                            @if($icon)
                                                <div class="me-2">
                                                    <img src="{{ asset('storage/' . $icon) }}" alt="Icon" style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px;">
                                                </div>
                                            @endif
                                            <input type="file" name="point_icon[{{ $index }}]" class="form-control" accept="image/*">
                                        </div>
                                    @endforeach
                                    @if(empty($pointIcons))
                                        <div class="input-group mb-2">
                                            <input type="file" name="point_icon[0]" class="form-control" accept="image/*">
                                        </div>
                                    @endif
                                </div>
                                <button type="button" id="add-point-icon" class="btn btn-outline-primary btn-sm">Add Point Icon</button>
                            </div>

                            <!-- Submit -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Service</button>
                                <a href="{{ route('admin.service.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Scripts -->
<script>
document.getElementById('add-point').addEventListener('click', () => {
    const container = document.getElementById('points-container');
    container.insertAdjacentHTML('beforeend', `
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="points[]" placeholder="Enter service point">
            <button type="button" class="btn btn-outline-danger remove-point">Remove</button>
        </div>`);
});

document.getElementById('add-description').addEventListener('click', () => {
    const container = document.getElementById('point-descriptions-container');
    container.insertAdjacentHTML('beforeend', `
        <div class="input-group mb-2">
            <textarea class="form-control" name="points_description[]" rows="2" placeholder="Description for the point"></textarea>
            <button type="button" class="btn btn-outline-danger remove-description">Remove</button>
        </div>`);
});

document.getElementById('add-icon-title').addEventListener('click', () => {
    const container = document.getElementById('icon-titles-container');
    container.insertAdjacentHTML('beforeend', `
        <div class="input-group mb-2">
            <input type="text" class="form-control" name="icon_title[]" placeholder="Icon title">
            <button type="button" class="btn btn-outline-danger remove-icon-title">Remove</button>
        </div>`);
});

document.getElementById('add-icon-desc').addEventListener('click', () => {
    const container = document.getElementById('icon-descriptions-container');
    container.insertAdjacentHTML('beforeend', `
        <div class="input-group mb-2">
            <textarea class="form-control" name="icon_description[]" rows="2" placeholder="Icon description"></textarea>
            <button type="button" class="btn btn-outline-danger remove-icon-desc">Remove</button>
        </div>`);
});

document.getElementById('add-point-icon').addEventListener('click', () => {
    const container = document.getElementById('point-icons-container');
    const index = container.querySelectorAll('input[type="file"]').length;
    container.insertAdjacentHTML('beforeend', `
        <div class="input-group mb-2">
            <input type="file" name="point_icon[${index}]" class="form-control" accept="image/*">
        </div>`);
});

// Remove dynamic input
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('remove-point') ||
        e.target.classList.contains('remove-description') ||
        e.target.classList.contains('remove-icon-title') ||
        e.target.classList.contains('remove-icon-desc')) {
        e.target.closest('.input-group').remove();
    }
});

// Preview main icon
function previewIcon(input) {
    const preview = document.getElementById('icon-preview');
    const previewImg = document.getElementById('preview-img');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
    }
}

// Update color preview
function updateColorPreview(selectElement) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const colorPreview = document.getElementById('selected-color-preview');
    const colorSwatch = document.getElementById('color-swatch');
    const colorInfo = document.getElementById('color-info');

    if (selectedOption && selectedOption.dataset.color) {
        const color = selectedOption.dataset.color;
        colorSwatch.style.backgroundColor = color;
        colorInfo.textContent = `${selectedOption.text} (${color})`;
        colorPreview.style.display = 'flex';
    } else {
        colorSwatch.style.backgroundColor = '#ffffff';
        colorInfo.textContent = 'No color selected';
        colorPreview.style.display = 'none';
    }
}
</script>
@endsection
