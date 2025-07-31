@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Edit CTA',
            'description' => 'Update call-to-action section content',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'CTA Management', 'url' => route('admin.cta.index')],
                ['title' => 'Edit CTA', 'url' => '#']
            ],
            'actions' => '<a href="' . route('admin.cta.index') . '" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to CTA
            </a>'
        ])
        <div class="cta-admin">
            <form action="{{ route('admin.cta.update', $cta) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="page" class="form-label">Page</label>
                    <select name="page" id="page" class="form-control" required>
                        <option value="">Select Page</option>
                        @php
                            $allPages = [
                                'home' => 'Home',
                                'about' => 'About',
                                'industries' => 'Industries',
                                'services' => 'Services',
                                'other' => 'Other',
                            ];
                        @endphp
                        @foreach ($allPages as $key => $label)
                            <option value="{{ $key }}" @if ($cta->page == $key) selected @endif>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $cta->title }}"
                        required maxlength="255" placeholder="Enter title">
                </div>
                <div class="form-group mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" required maxlength="1000"
                        placeholder="Enter description">{{ $cta->description }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="button1_text" class="form-label">Button 1 Text</label>
                    <input type="text" name="button1_text" id="button1_text" class="form-control"
                        value="{{ $cta->button1_text }}" required maxlength="255" placeholder="Enter Button 1 text">
                </div>
                <div class="form-group mb-3">
                    <label for="button2_text" class="form-label">Button 2 Text</label>
                    <input type="text" name="button2_text" id="button2_text" class="form-control"
                        value="{{ $cta->button2_text }}" required maxlength="255" placeholder="Enter Button 2 text">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <button type="submit" class="btn btn-success me-2">Update CTA</button>
                    <a href="{{ route('admin.cta.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </main>
@endsection
