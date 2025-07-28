@extends('admin.layout.app')
@section('content')
<main class="main-content">
    <div class="content-header fade-in">
        <h1>Edit Service</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.service.index') }}">Services</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Service</li>
            </ol>
        </nav>
    </div>

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
                                <label for="icon" class="form-label">Service Icon</label>
                                @if($serviceData->icon)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $serviceData->icon) }}" alt="Current Icon" style="width:60px;height:60px;border-radius:8px;">
                                        <small class="text-muted d-block">Current icon</small>
                                    </div>
                                @endif
                                <input type="file" class="form-control" id="icon" name="icon" accept="image/*" onchange="previewIcon(this)">
                                <div id="icon-preview" class="mt-2" style="display: none;">
                                    <img id="preview-img" src="" alt="New Icon Preview" style="width:80px;height:80px;border-radius:8px;border:1px solid #ddd;">
                                    <small class="text-muted d-block">New icon preview</small>
                                </div>
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
</script>
@endsection
