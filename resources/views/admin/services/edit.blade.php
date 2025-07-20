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

                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Service Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $serviceData->title }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="icon" class="form-label">Service Icon</label>
                                @if($serviceData->icon)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $serviceData->icon) }}" alt="Current Icon" style="width:60px;height:60px;border-radius:8px;">
                                        <small class="text-muted d-block">Current icon</small>
                                    </div>
                                @endif
                                <input type="file" class="form-control" id="icon" name="icon" accept="image/*" onchange="previewIcon(this)">
                                <small class="form-text text-muted">Upload a new icon to replace the current one (optional)</small>
                                <div id="icon-preview" class="mt-2" style="display: none;">
                                    <img id="preview-img" src="" alt="New Icon Preview" style="width:80px;height:80px;border-radius:8px;border:1px solid #ddd;">
                                    <small class="text-muted d-block">New icon preview</small>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Short Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $serviceData->description }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="long_description" class="form-label">Long Description</label>
                                <textarea class="form-control" id="long_description" name="long_description" rows="5">{{ $serviceData->long_description }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Service Points</label>
                                <div id="points-container">
                                    @php
                                        $points = is_array($serviceData->points) ? $serviceData->points : (is_string($serviceData->points) ? json_decode($serviceData->points, true) : []);
                                    @endphp
                                    @if($points && count($points) > 0)
                                        @foreach($points as $point)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="points[]" value="{{ $point }}" placeholder="Enter service point">
                                                <button type="button" class="btn btn-outline-danger remove-point">Remove</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="points[]" placeholder="Enter service point">
                                            <button type="button" class="btn btn-outline-danger remove-point">Remove</button>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" id="add-point" class="btn btn-outline-primary btn-sm">Add Point</button>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Point Descriptions</label>
                                <div id="point-descriptions-container">
                                    @php
                                        $pointsDescription = is_array($serviceData->points_description) ? $serviceData->points_description : (is_string($serviceData->points_description) ? json_decode($serviceData->points_description, true) : []);
                                    @endphp
                                    @if($pointsDescription && count($pointsDescription) > 0)
                                        @foreach($pointsDescription as $desc)
                                            <div class="input-group mb-2">
                                                <textarea class="form-control" name="points_description[]" rows="2">{{ $desc }}</textarea>
                                                <button type="button" class="btn btn-outline-danger remove-description">Remove</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="input-group mb-2">
                                            <textarea class="form-control" name="points_description[]" rows="2" placeholder="Description for the point"></textarea>
                                            <button type="button" class="btn btn-outline-danger remove-description">Remove</button>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" id="add-description" class="btn btn-outline-primary btn-sm">Add Description</button>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Icon Titles</label>
                                <div id="icon-titles-container">
                                    @php
                                        $iconTitles = is_array($serviceData->icon_title) ? $serviceData->icon_title : (is_string($serviceData->icon_title) ? json_decode($serviceData->icon_title, true) : []);
                                    @endphp
                                    @if($iconTitles && count($iconTitles) > 0)
                                        @foreach($iconTitles as $title)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="icon_title[]" value="{{ $title }}" placeholder="Icon title">
                                                <button type="button" class="btn btn-outline-danger remove-icon-title">Remove</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="icon_title[]" placeholder="Icon title">
                                            <button type="button" class="btn btn-outline-danger remove-icon-title">Remove</button>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" id="add-icon-title" class="btn btn-outline-primary btn-sm">Add Icon Title</button>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Icon Descriptions</label>
                                <div id="icon-descriptions-container">
                                    @php
                                        $iconDescriptions = is_array($serviceData->icon_description) ? $serviceData->icon_description : (is_string($serviceData->icon_description) ? json_decode($serviceData->icon_description, true) : []);
                                    @endphp
                                    @if($iconDescriptions && count($iconDescriptions) > 0)
                                        @foreach($iconDescriptions as $desc)
                                            <div class="input-group mb-2">
                                                <textarea class="form-control" name="icon_description[]" rows="2">{{ $desc }}</textarea>
                                                <button type="button" class="btn btn-outline-danger remove-icon-desc">Remove</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="input-group mb-2">
                                            <textarea class="form-control" name="icon_description[]" rows="2" placeholder="Icon description"></textarea>
                                            <button type="button" class="btn btn-outline-danger remove-icon-desc">Remove</button>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" id="add-icon-desc" class="btn btn-outline-primary btn-sm">Add Icon Description</button>
                            </div>

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

<script>
// Dynamic form fields
document.getElementById('add-point').addEventListener('click', function() {
    const container = document.getElementById('points-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" class="form-control" name="points[]" placeholder="Enter service point">
        <button type="button" class="btn btn-outline-danger remove-point">Remove</button>
    `;
    container.appendChild(div);
});

document.getElementById('add-description').addEventListener('click', function() {
    const container = document.getElementById('point-descriptions-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <textarea class="form-control" name="points_description[]" rows="2" placeholder="Description for the point"></textarea>
        <button type="button" class="btn btn-outline-danger remove-description">Remove</button>
    `;
    container.appendChild(div);
});

document.getElementById('add-icon-title').addEventListener('click', function() {
    const container = document.getElementById('icon-titles-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="text" class="form-control" name="icon_title[]" placeholder="Icon title">
        <button type="button" class="btn btn-outline-danger remove-icon-title">Remove</button>
    `;
    container.appendChild(div);
});

document.getElementById('add-icon-desc').addEventListener('click', function() {
    const container = document.getElementById('icon-descriptions-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <textarea class="form-control" name="icon_description[]" rows="2" placeholder="Icon description"></textarea>
        <button type="button" class="btn btn-outline-danger remove-icon-desc">Remove</button>
    `;
    container.appendChild(div);
});

// Remove buttons
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-point') ||
        e.target.classList.contains('remove-description') ||
        e.target.classList.contains('remove-icon-title') ||
        e.target.classList.contains('remove-icon-desc')) {
        e.target.parentElement.remove();
    }
});

// Icon preview function
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
