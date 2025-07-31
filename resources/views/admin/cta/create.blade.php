@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Add New CTA',
            'description' => 'Create a new call-to-action section',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'CTA Management', 'url' => route('admin.cta.index')],
                ['title' => 'Add CTA', 'url' => '#']
            ],
            'actions' => '<a href="' . route('admin.cta.index') . '" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to CTA
            </a>'
        ])
        <div class="cta-admin">
            <form action="{{ route('admin.cta.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="page" class="form-label">Page</label>
                    <select name="page" id="page" class="form-control" required>
                        <option value="">Select Page</option>
                        @foreach ($availablePages as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required maxlength="255"
                        placeholder="Enter title">
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" required maxlength="1000"
                        placeholder="Enter description"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="button1_text" class="form-label">Button 1 Text</label>
                    <input type="text" name="button1_text" id="button1_text" class="form-control" required
                        maxlength="255" placeholder="Enter Button 1 text">
                </div>
                <div class="form-group mb-3">
                    <label for="button2_text" class="form-label">Button 2 Text</label>
                    <input type="text" name="button2_text" id="button2_text" class="form-control" required
                        maxlength="255" placeholder="Enter Button 2 text">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <button type="submit" class="btn btn-success me-2">Save CTA</button>
                    <a href="{{ route('admin.cta.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </main>
@endsection
