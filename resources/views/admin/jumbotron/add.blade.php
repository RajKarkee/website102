@extends('admin.layout.app')
@section('content')
    <main class="main-content">
        <div class="content-header fade-in">
            <h1>@yield('page-title', 'Jumbotron')</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.jumbotron.index') }}">Jumbotron</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'Add Jumbotron')</li>
                </ol>
            </nav>
        </div>
        @push('styles')
        <style>
              .hidden { display: none; }

        #imageInputsWrapper {
            display: flex;
            gap: 15px;
            flex-wrap: nowrap;
            overflow-x: auto;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f1f1f1;
        }

        .image-input-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            min-width: 140px;
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .preview-img {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #eee;
        }

        .delete-btn {
            background-color: #ff4d4f;
            border: none;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }

        .delete-btn:hover {
            background-color: #d9363e;
        }

        #addImageBtn {
            background-color: #1890ff;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        #addImageBtn:hover {
            background-color: #1475cc;
        }
            </style>
        @endpush


        <div class="jumbotron">
            <form id="jumbotronForm" method="POST" action="{{ route('admin.jumbotron.add') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="page-title" class="title">Page Title</label>
                    <select id="categorySelect" name="page" class="form-control" required>
                    <option value="Home">Home</option>
                    <option value="About">About</option>
                    <option value="Industry">Industry</option>
                    <option value="Services">Services</option>
                    </select>
                </div>
                <br>
                <div id="sliderContainer" class="hidden">
                    <label>
                    <input type="checkbox" id="homeSlider" name="slider">
                    Enable Slider
                    </label>
                </div>
                <br>
                <div id="imageInputSection" class="hidden">
                    <div id="imageInputsWrapper">
                    <div class="image-input-group">
                        <input type="file" name="images[]" class="image-input" accept="image/*" >
                        <img src="" class="preview-image hidden">
                        <button type="button" class="delete-btn">Delete</button>
                    </div>
                </div>
                <br>
                <button type="button" id="addImageBtn" class="btn btn-secondary">Add Another Image</button>
                </div>


                <div class="form-group ">
                
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" required maxlength="255" placeholder="Enter title">
                </div>
                <div class="form-group ">
                <label for="subtitle" class="form-label">Subtitle</label>
                <input type="text" id="subtitle" name="subtitle" class="form-control" required maxlength="255" placeholder="Enter subtitle">
                </div>
                <div class="form-group ">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3" required maxlength="1000"
                    placeholder="Enter description"></textarea>
                </div>
                <div class="form-group ">
                <label for="background_image" class="form-label">Background Image</label>
                <input type="file" id="background_image" name="background_image" class="form-control" accept="image/png, image/jpeg" required>
                </div>
                <div class="form-">
                    <label for="icon" class="form-label">Icon</label>
                    <input type="file" id="icon" name="icon" class="form-control" accept="image/png, image/jpeg, image/svg+xml" required>

                </div>
                <div class="form-group ">
                <label for="badge" class="form-label">Badge</label>
                <input type="text" id="badge" name="badge" class="form-control" required maxlength="255" placeholder="Enter badge text">
                </div>
                <br>
                <div class="d-grid">
                <button type="submit" class="btn btn-primary">Add Jumbotron</button>
                </div>
            </form>
                
        </div>
    </main>
    @push('scripts')
    <script>
        $(document).ready(function(){
            $('#categorySelect').on('change',function(){
                if($(this).val()=='Home'){
                    $('#sliderContainer').removeClass('hidden');
                }else{
                    $('#sliderContainer').addClass('hidden');
                    $('#homeSlider').prop('checked', false);
                    $('#imageInputSection').addClass('hidden');
                    resetImageInputs();
                }
            });
            $('#homeSlider').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#imageInputSection').removeClass('hidden');
                } else {
                    $('#imageInputSection').addClass('hidden');
                    resetImageInputs();
                }
            });
            $('#addImageBtn').on('click', function() {
                const newInputGroup = `
                    <div class="image-input-group">
                        <input type="file" name="images[]" class="image-input" accept="image/*">
                        <img src="" class="preview-image hidden">
                        <button type="button" class="delete-btn">Delete</button>
                    </div>
                `;
                $('#imageInputsWrapper').append(newInputGroup);
            });

            // Add event handler for delete button
            $('#imageInputsWrapper').on('click', '.delete-btn', function() {
                $(this).closest('.image-input-group').remove();
            });
            $('#imageInputsWrapper').on('change','.image-input', function() {
                const file = this.files[0];
                const previewImg = $(this).siblings('.preview-image');
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.attr('src', e.target.result).removeClass('hidden');
                    }
                    reader.readAsDataURL(file);
                } else {
                    previewImg.addClass('hidden');
                }
            });
            function resetImageInputs(){
                $('#imageInputsWrapper').html(`
                    <div class="image-input-group">
                        <input type="file" name="images[]" class="image-input" accept="image/*">
                        <img src="" class="preview-image hidden">
                        <button type="button" class="delete-btn">Delete</button>
                    </div>
                `);
            }

            
            
        });

      </script>  
    @endpush
@endsection
