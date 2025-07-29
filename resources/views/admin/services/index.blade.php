@extends('admin.layout.app')
@section('content')
<main class="main-content">
    <div class="content-header fade-in">
        <h1>Services Management</h1>
        <p class="text-muted">Welcome to the services page. Here you can manage your services.</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Services</li>
            </ol>
        </nav>
    </div>
    <div class="service">
        {{-- @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif --}}
        @include('components.alerts')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Services List</h3>
                <a href="{{ route('admin.service.add') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Service
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="servicesTable" class="table table-striped nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Icon</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>{{ $service->id }}</td>
                                <td class="service-icon">
                                    @if($service->icon)
                                        <img src="{{ asset('storage/' . $service->icon) }}" alt="Service Icon" class="img-fluid">
                                    @else
                                        <span class="text-muted">No Icon</span>
                                    @endif
                                </td>
                                <td>{{ $service->title }}</td>
                                <td>{{ Str::limit($service->description, 100) }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="showServiceDetails({{ $service->id }})">
                                        <i class="fas fa-info-circle"></i> Details
                                    </button>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.service.edit', $service->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.service.delete', $service->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-btn" onclick="return confirm('Are you sure you want to delete this service?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>    
                </table>
            </div>@push('styles')
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <style>
        .service-icon img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        #servicesTable_filter {
            margin-bottom: 10px;
        }
        .dataTables_processing {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 1em;
            background: rgba(255,255,255,0.9);
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            z-index: 100;
        }
        .table-responsive {
            position: relative;
            min-height: 200px;
        }
        /* Prevent text selection during loading */
        .processing * {
            user-select: none !important;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            const table = $('#servicesTable').DataTable({
                responsive: true,
                processing: true,
                pageLength: 10,
                stateSave: false,
                deferRender: true,
                ordering: true,
                search: {
                    return: true
                },
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>'
                }
            });

            // Delete functionality
            $(document).on('click', '#servicesTable .delete-btn', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const serviceId = $(this).data('id');
                if (confirm('Are you sure you want to delete this service?')) {
                    const form = $('<form>', {
                        'method': 'POST',
                        'action': `/admin/service/delete/${serviceId}`
                    }).append($('<input>', {
                        'type': 'hidden',
                        'name': '_token',
                        'value': '{{ csrf_token() }}'
                    })).append($('<input>', {
                        'type': 'hidden',
                        'name': '_method',
                        'value': 'DELETE'
                    }));
                    
                    $(document.body).append(form);
                    form.submit();
                }
            });
        });

        // Show service details function
        // function showServiceDetails(serviceId) {
        //     // Fetch service details via AJAX
        //     fetch(`/admin/service/details/${serviceId}`)
        //         .then(response => response.json())
        //         .then(data => {
        //             document.getElementById('modalServiceTitle').textContent = data.title;
        //             document.getElementById('modalLongDescription').textContent = data.long_description || 'No long description available';

        //             // Display service points
        //             const pointsList = document.getElementById('modalServicePoints');
        //             pointsList.innerHTML = '';
        //             if (data.points && data.points.length > 0) {
        //                 data.points.forEach(point => {
        //                     const li = document.createElement('li');
        //                     li.textContent = point;
        //                     pointsList.appendChild(li);
        //                 });
        //             } else {
        //                 pointsList.innerHTML = '<li>No service points available</li>';
        //             }

        //             // Display point descriptions
        //             const descriptionsList = document.getElementById('modalPointDescriptions');
        //             descriptionsList.innerHTML = '';
        //             if (data.points_description && data.points_description.length > 0) {
        //                 data.points_description.forEach(desc => {
        //                     const li = document.createElement('li');
        //                     li.textContent = desc;
        //                     descriptionsList.appendChild(li);
        //                 });
        //             } else {
        //                 descriptionsList.innerHTML = '<li>No point descriptions available</li>';
        //             }

        //             // Display icon titles
        //             const iconTitlesList = document.getElementById('modalIconTitles');
        //             iconTitlesList.innerHTML = '';
        //             if (data.icon_title && data.icon_title.length > 0) {
        //                 data.icon_title.forEach(title => {
        //                     const li = document.createElement('li');
        //                     li.textContent = title;
        //                     iconTitlesList.appendChild(li);
        //                 });
        //             } else {
        //                 iconTitlesList.innerHTML = '<li>No icon titles available</li>';
        //             }

        //             // Display icon descriptions
        //             const iconDescList = document.getElementById('modalIconDescriptions');
        //             iconDescList.innerHTML = '';
        //             if (data.icon_description && data.icon_description.length > 0) {
        //                 data.icon_description.forEach(desc => {
        //                     const li = document.createElement('li');
        //                     li.textContent = desc;
        //                     iconDescList.appendChild(li);
        //                 });
        //             } else {
        //                 iconDescList.innerHTML = '<li>No icon descriptions available</li>';
        //             }

        //             // Show the modal
        //             const modal = new bootstrap.Modal(document.getElementById('serviceDetailsModal'));
        //             modal.show();
        //         })
        //         .catch(error => {
        //             console.error('Error fetching service details:', error);
        //             alert('Error loading service details');
        //         });
        // }
    </script>

    <!-- Service Details Modal -->
    {{-- <div class="modal fade service-details-modal" id="serviceDetailsModal" tabindex="-1" aria-labelledby="serviceDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="serviceDetailsModalLabel">Service Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 id="modalServiceTitle" class="text-primary mb-3"></h6>

                    <div class="detail-section">
                        <strong>Long Description:</strong>
                        <p id="modalLongDescription" class="mt-2"></p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-section">
                                <strong>Service Points:</strong>
                                <ul id="modalServicePoints" class="mt-2"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-section">
                                <strong>Point Descriptions:</strong>
                                <ul id="modalPointDescriptions" class="mt-2"></ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-section">
                                <strong>Icon Titles:</strong>
                                <ul id="modalIconTitles" class="mt-2"></ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-section">
                                <strong>Icon Descriptions:</strong>
                                <ul id="modalIconDescriptions" class="mt-2"></ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}
</main>
@endsection
