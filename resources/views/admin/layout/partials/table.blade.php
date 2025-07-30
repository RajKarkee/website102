{{-- Enhanced Admin Table Partial --}}
@props([
    'title' => null,
    'headers' => [],
    'items' => [],
    'actions' => [],
    'emptyMessage' => 'No data available',
    'searchable' => false,
    'exportable' => false,
    'itemsPerPage' => 10
])

<div class="admin-table-container">
    @if($title || $searchable || $exportable)
        <div class="table-controls mb-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    @if($title)
                        <h5 class="mb-0 text-dark fw-bold">{{ $title }}</h5>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end gap-2">
                        @if($searchable)
                            <div class="search-container">
                                <input type="text" 
                                       class="form-control form-control-sm" 
                                       id="tableSearch" 
                                       placeholder="Search records..."
                                       style="max-width: 200px;">
                                <i class="fas fa-search search-icon"></i>
                            </div>
                        @endif
                        
                        @if($exportable)
                            <button class="btn btn-outline-success btn-sm" onclick="exportTable()">
                                <i class="fas fa-download"></i> Export
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="adminDataTable">
                @if(count($headers) > 0)
                    <thead class="table-dark">
                        <tr>
                            @foreach($headers as $header)
                                <th class="border-0 fw-semibold">{{ $header }}</th>
                            @endforeach
                            @if(count($actions) > 0)
                                <th class="border-0 fw-semibold text-center" style="width: 120px;">Actions</th>
                            @endif
                        </tr>
                    </thead>
                @endif
                
                <tbody>
                    @forelse($items as $item)
                        <tr class="border-bottom">
                            {{ $item }}
                            @if(count($actions) > 0)
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        @foreach($actions as $action)
                                            {!! $action !!}
                                        @endforeach
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($headers) + (count($actions) > 0 ? 1 : 0) }}" 
                                class="text-center py-5 text-muted">
                                <div class="empty-state">
                                    <i class="fas fa-inbox fa-3x mb-3 opacity-50"></i>
                                    <h6 class="text-muted">{{ $emptyMessage }}</h6>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if(count($items) > $itemsPerPage)
            <div class="card-footer bg-light border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">
                        Showing {{ count($items) }} of {{ count($items) }} entries
                    </small>
                    <nav>
                        {{-- Pagination can be added here --}}
                    </nav>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    .admin-table-container {
        background: transparent;
    }
    
    .search-container {
        position: relative;
    }
    
    .search-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        pointer-events: none;
    }
    
    .table th {
        background: linear-gradient(135deg, #343a40 0%, #495057 100%);
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .table tbody tr:hover {
        background-color: rgba(0,123,255,0.05);
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.2s ease;
    }
    
    .empty-state {
        padding: 2rem;
    }
    
    .btn-group-sm .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
</style>

@if($searchable)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('tableSearch');
            const table = document.getElementById('adminDataTable');
            
            if (searchInput && table) {
                searchInput.addEventListener('keyup', function() {
                    const filter = this.value.toLowerCase();
                    const rows = table.querySelectorAll('tbody tr');
                    
                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(filter) ? '' : 'none';
                    });
                });
            }
        });
        
        @if($exportable)
        function exportTable() {
            // Simple CSV export functionality
            const table = document.getElementById('adminDataTable');
            let csv = [];
            const rows = table.querySelectorAll('tr');
            
            for (let i = 0; i < rows.length; i++) {
                const row = [], cols = rows[i].querySelectorAll('td, th');
                for (let j = 0; j < cols.length - 1; j++) { // Exclude actions column
                    row.push(cols[j].innerText);
                }
                csv.push(row.join(','));
            }
            
            const csvFile = new Blob([csv.join('\n')], { type: 'text/csv' });
            const downloadLink = document.createElement('a');
            downloadLink.download = 'admin_data.csv';
            downloadLink.href = window.URL.createObjectURL(csvFile);
            downloadLink.style.display = 'none';
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }
        @endif
    </script>
@endif
