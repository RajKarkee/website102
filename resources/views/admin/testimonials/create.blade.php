@extends('admin.layout.app')

@section('content')
    <main class="main-content">
        @include('admin.layout.partials.header', [
            'title' => 'Add Testimonial',
            'description' => 'Create a new customer testimonial',
            'breadcrumbs' => [
                ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['title' => 'Testimonials Management', 'url' => route('admin.testimonials.index')],
                ['title' => 'Add Testimonial', 'url' => '#']
            ],
            'actions' => '<a href="' . route('admin.testimonials.index') . '" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back</a>'
        ])

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-star me-2"></i>Add New Testimonial
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Customer Image</label>
                                @include('admin.components.image-upload', [
                                    'name' => 'image',
                                    'accept' => 'image/*',
                                    'previewSize' => 'sm'
                                ])
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Additional Notes <small class="text-muted">(Optional)</small></label>
                                <textarea name="others" class="form-control" rows="3" placeholder="Role, company, or other details..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Testimonial <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" rows="4" required placeholder="What did the customer say about your service?"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Customer Details</label>
                        <textarea name="sub_description" class="form-control" rows="2" placeholder="Customer name, company, or other identifying information..."></textarea>
                    </div>
                    <input type="hidden" name="status" value="0">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Add Testimonial
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
