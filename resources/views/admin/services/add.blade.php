@extends('admin.layout.app')
@section('content')
    <main class="main-content">
        <div class="content-header fade-in">
            <h1>Add New Service</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.service.index') }}">Services</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Service</li>
                </ol>
            </nav>
        </div>

        <div class="content-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Service Information</h4>
                        </div>
                        <div class="card-body service-form admin-form">
                            <form method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Service Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="icon" class="form-label">Service Icon</label>
                                    <input type="file" class="form-control" id="icon" name="icon"
                                        accept="image/*" onchange="previewIcon(this)">
                                    <small class="form-text text-muted">Upload an icon for this service (optional)</small>
                                    <div id="icon-preview" class="icon-preview mt-2" style="display: none;">
                                        <img id="preview-img" src="" alt="Icon Preview">
                                        <div class="preview-text">Icon Preview</div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="description" class="form-label">Short Description <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required
                                        placeholder="Brief description for service cards"></textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="long_description" class="form-label">Long Description</label>
                                    <textarea class="form-control" id="long_description" name="long_description" rows="5"
                                        placeholder="Detailed description for service pages"></textarea>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Service Points</label>
                                    <div id="points-container" class="dynamic-field-container">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="points[]"
                                                placeholder="Enter service point">
                                            <button type="button"
                                                class="btn btn-outline-danger remove-point">Remove</button>
                                        </div>
                                    </div>
                                    <button type="button" id="add-point"
                                        class="btn btn-outline-primary btn-sm add-field-btn">Add Point</button>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Point Descriptions</label>
                                    <div id="point-descriptions-container">
                                        <div class="input-group mb-2">
                                            <textarea class="form-control" name="points_description[]" rows="2" placeholder="Description for the point"></textarea>
                                            <button type="button"
                                                class="btn btn-outline-danger remove-description">Remove</button>
                                        </div>
                                    </div>
                                    <button type="button" id="add-description" class="btn btn-outline-primary btn-sm">Add
                                        Description</button>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Point Icons</label>
                                    <div id="point-icon-container" class="dynamic-field-container">
                                        <div class="input-group mb-2">
                                            <input type="file" class="form-control" name="point_icon[]" accept="image/*"
                                                onchange="previewDynamicIcon(this)">
                                            <button type="button"
                                                class="btn btn-outline-danger remove-point-icon">Remove</button>
                                        </div>
                                    </div>
                                    <button type="button" id="add-point-icon" class="btn btn-outline-primary btn-sm">Add
                                        Point Icon</button>
                                </div>


                                <div class="form-group mb-3">
                                    <label class="form-label">Icon Titles</label>
                                    <div id="icon-titles-container">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="icon_title[]"
                                                placeholder="Icon title">
                                            <button type="button"
                                                class="btn btn-outline-danger remove-icon-title">Remove</button>
                                        </div>
                                    </div>
                                    <button type="button" id="add-icon-title" class="btn btn-outline-primary btn-sm">Add
                                        Icon Title</button>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Icon Descriptions</label>
                                    <div id="icon-descriptions-container">
                                        <div class="input-group mb-2">
                                            <textarea class="form-control" name="icon_description[]" rows="2" placeholder="Icon description"></textarea>
                                            <button type="button"
                                                class="btn btn-outline-danger remove-icon-desc">Remove</button>
                                        </div>
                                    </div>
                                    <button type="button" id="add-icon-desc" class="btn btn-outline-primary btn-sm">Add
                                        Icon Description</button>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Add Service</button>
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
       
        document.getElementById('add-point-icon').addEventListener('click', function () {
    const container = document.getElementById('point-icon-container');
    const div = document.createElement('div');
    div.className = 'input-group mb-2';
    div.innerHTML = `
        <input type="file" class="form-control" name="point_icon[]" accept="image/*" onchange="previewDynamicIcon(this)">
        <button type="button" class="btn btn-outline-danger remove-point-icon">Remove</button>
    `;
    container.appendChild(div);
});

// Remove handler for dynamic icons
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-point-icon')) {
        e.target.parentElement.remove();
    }
});

// Preview for dynamic file inputs
function previewDynamicIcon(input) {
    const file = input.files?.[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
        const preview = document.createElement('img');
        preview.src = e.target.result;
        preview.style.width = '80px';
        preview.style.marginTop = '5px';

        // Remove old preview if any
        const existingPreview = input.parentElement.querySelector('img');
        if (existingPreview) existingPreview.remove();

        input.parentElement.appendChild(preview);
    };
    reader.readAsDataURL(file);
}


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
                    preview.classList.add('active');
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.style.display = 'none';
                preview.classList.remove('active');
            }
        }
    </script>
@endsection
