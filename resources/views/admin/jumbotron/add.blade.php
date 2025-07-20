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
<h1>Add New Jumbotron</h1>

    <div class="container-jumbotron">
        <form id="jumbotronForm" method="POST" action="{{ route('admin.jumbotron.add') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" required maxlength="255">
            </div>
            <div class="form-group">
                <label for="subtitle">Subtitle</label>
                <input type="text" id="subtitle" name="subtitle" class="form-control" required maxlength="255">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3" required maxlength="1000"></textarea>
            </div>
            <div class="form-group">
                <label for="background_image">Background Image</label>
                <input type="file" id="background_image" name="background_image" class="dropify" 
                    data-allowed-file-extensions="png jpg jpeg"
                    data-max-file-size="2M"
                    data-height="200"
                    data-show-remove="true"
                    data-show-loader="true"
                    data-show-errors="true"
                    data-errors-position="outside"
                    required>
            </div>
            <div class="form-group">
            </div>
                 
        </form>
           
            

</main>
@endsection