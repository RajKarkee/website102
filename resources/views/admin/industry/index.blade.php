@extends('admin.layout.app')
@section('content')
<main class="main-content">
    <div class="content-header fade-in">
        <h1>@yield('page-title', 'Industry')</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('page-title', 'Industry')</li>
            </ol>
        </nav>
    </div>

    <div class="container-indus">
        <style>
            .point-input { margin-bottom: 10px; display: flex; align-items: center; }
            .point-number { margin-right: 10px; font-weight: bold; }
            .remove-point { color: red; cursor: pointer; margin-left: 10px; font-size: 20px; }
            
            /* Dropify customization */
     
        </style>
        <div class="text-right">
<a href="{{ route('admin.industry.add') }}" class="btn btn-primary mb-3">Add Industry</a>
</div>
<table id="industry-table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>SID</th>
            <th>Icon</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($industries as $industry)
        <tr>
            <td>{{ $industry->id }}</td>
            <td>
                @if($industry->icon)
                    <img src="{{ asset('storage/' . $industry->icon) }}" alt="Icon" style="width:40px;height:40px;border-radius:8px;">
                @else
                    <span class="text-muted">No Icon</span>
                @endif
            </td>
            <td>{{ $industry->title }}</td>
            <td>{{ $industry->description }}</td>
            <td>
                <a href="{{ route('admin.industry.edit', $industry->id) }}" class="btn btn-sm btn-warning mr-1">Edit</a>
                <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $industry->id }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@push('styles')
<style>
    #industry-table th, #industry-table td {
        vertical-align: middle;
        text-align: center;
    }
    #industry-table img {
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border: 1px solid #eee;
    }
    .delete-btn {
        transition: background 0.2s;
    }
    .delete-btn:hover {
        background: #c82333;
        color: #fff;
    }
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    $('#industry-table').DataTable();

    $('.delete-btn').on('click', function() {
        const id = $(this).data('id');
        if (confirm('Are you sure you want to delete this industry?')) {
            $.ajax({
                url: '{{ url("admin/industry/delete") }}/' + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    location.reload();
                },
                error: function() {
                    alert('Delete failed.');
                }
            });
        }
    });
});
</script>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/js/dropify.min.js"></script>
@endpush
@push('scripts')
<script>
$(function() {
            let maxPoints = 4;

    function updatePointNumbering() {
        $('#points-wrapper .point-input').each(function(index) {
            $(this).find('.point-number').text((index + 1) + '.');
        });
    }

    function updatePointCount() {
        let count = $('#points-wrapper .point-input').length;
        $('#point-count').text(count + '/' + maxPoints + ' Points');
        $('#add-point').prop('disabled', count >= maxPoints);
        updatePointNumbering();
    }

            // Add point button click handler
            $('#add-point').on('click', function() {
                console.log('Add point clicked');
                let count = $('#points-wrapper .point-input').length;
                if (count < maxPoints) {
                    const newPoint = $(`
                        <div class="point-input">
                            <span class="point-number">${count + 1}.</span>
                            <input type="text" name="points[]" class="form-control d-inline-block w-75" maxlength="255" required placeholder="Point">
                            <span class="remove-point">&times;</span>
                        </div>
                    `).hide();
                    
                    $('#points-wrapper').append(newPoint);
                    newPoint.fadeIn(300);
                    updatePointCount();
                }
            });

            // Remove point click handler (using event delegation)
            $('#points-wrapper').on('click', '.remove-point', function() {
                $(this).closest('.point-input').fadeOut(300, function() {
                    $(this).remove();
                    updatePointCount();
                });
            });

    // Initialize the count
    updatePointCount();
});
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css" />
@endpush


@endsection
