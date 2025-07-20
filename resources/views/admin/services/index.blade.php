@extends('admin.layout.app')
@section('content')
<main class="main-content">
    <div class="content-header fade-in">
        <h1>@yield('page-title', 'Services')</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'Services')</li>
            </ol>
        </nav>
    </div>
    <div class="service">
        <h1>Services Management</h1>
        <p>Welcome to the services page. Here you can manage your services.</p>
        <a href='{{ route('admin.service.add') }}' class="btn btn-primary mb-3">Add New Service</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="service-table" class="table table-striped table-bordered service-table">
            <thead>
                <tr>
                    <th>SID</th>
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td class="service-icon">
                        @if($service->icon)
                            <img src="{{ asset('storage/' . $service->icon) }}" alt="Icon">
                        @else
                            <span class="text-muted">No Icon</span>
                        @endif
                    </td>
                    <td>{{ $service->title }}</td>
                    <td class="service-description">{{ Str::limit($service->description, 100) }}</td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="showServiceDetails({{ $service->id }})">
                            <i class="fas fa-info-circle"></i> Details
                        </button>
                    </td>
                    <td class="service-actions">
                        <a href="{{ route('admin.service.edit', $service->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $service->id }}">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No services found. <a href="{{ route('admin.service.add') }}">Add your first service</a></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        // Delete functionality
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const serviceId = this.dataset.id;
                if (confirm('Are you sure you want to delete this service?')) {
                    // Create a form to submit DELETE request
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/service/delete/${serviceId}`;

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';

                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';

                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });

        // Show service details function
        function showServiceDetails(serviceId) {
            // Fetch service details via AJAX
            fetch(`/admin/service/details/${serviceId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modalServiceTitle').textContent = data.title;
                    document.getElementById('modalLongDescription').textContent = data.long_description || 'No long description available';

                    // Display service points
                    const pointsList = document.getElementById('modalServicePoints');
                    pointsList.innerHTML = '';
                    if (data.points && data.points.length > 0) {
                        data.points.forEach(point => {
                            const li = document.createElement('li');
                            li.textContent = point;
                            pointsList.appendChild(li);
                        });
                    } else {
                        pointsList.innerHTML = '<li>No service points available</li>';
                    }

                    // Display point descriptions
                    const descriptionsList = document.getElementById('modalPointDescriptions');
                    descriptionsList.innerHTML = '';
                    if (data.points_description && data.points_description.length > 0) {
                        data.points_description.forEach(desc => {
                            const li = document.createElement('li');
                            li.textContent = desc;
                            descriptionsList.appendChild(li);
                        });
                    } else {
                        descriptionsList.innerHTML = '<li>No point descriptions available</li>';
                    }

                    // Display icon titles
                    const iconTitlesList = document.getElementById('modalIconTitles');
                    iconTitlesList.innerHTML = '';
                    if (data.icon_title && data.icon_title.length > 0) {
                        data.icon_title.forEach(title => {
                            const li = document.createElement('li');
                            li.textContent = title;
                            iconTitlesList.appendChild(li);
                        });
                    } else {
                        iconTitlesList.innerHTML = '<li>No icon titles available</li>';
                    }

                    // Display icon descriptions
                    const iconDescList = document.getElementById('modalIconDescriptions');
                    iconDescList.innerHTML = '';
                    if (data.icon_description && data.icon_description.length > 0) {
                        data.icon_description.forEach(desc => {
                            const li = document.createElement('li');
                            li.textContent = desc;
                            iconDescList.appendChild(li);
                        });
                    } else {
                        iconDescList.innerHTML = '<li>No icon descriptions available</li>';
                    }

                    // Show the modal
                    const modal = new bootstrap.Modal(document.getElementById('serviceDetailsModal'));
                    modal.show();
                })
                .catch(error => {
                    console.error('Error fetching service details:', error);
                    alert('Error loading service details');
                });
        }
    </script>

    <!-- Service Details Modal -->
    <div class="modal fade service-details-modal" id="serviceDetailsModal" tabindex="-1" aria-labelledby="serviceDetailsModalLabel" aria-hidden="true">
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
    </div>
    </script>
</main>
@endsection
