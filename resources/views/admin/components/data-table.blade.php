{{-- Admin Data Table Component --}}
@props([
    'headers' => [],
    'rows' => [],
    'actions' => [],
    'emptyMessage' => 'No data available',
    'searchable' => false,
    'sortable' => false
])

<div class="admin-table-wrapper">
    @if($searchable)
        <div class="table-controls mb-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="search-box">
                        <input type="text" 
                               class="form-control" 
                               id="tableSearch" 
                               placeholder="Search records..."
                               onkeyup="filterTable()">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="table-info">
                        <small class="text-muted">
                            Showing <span id="recordCount">{{ count($rows) }}</span> records
                        </small>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover admin-table" id="dataTable">
            <thead class="table-dark">
                <tr>
                    @foreach($headers as $header)
                        <th class="{{ $sortable ? 'sortable' : '' }}" 
                            @if($sortable) onclick="sortTable({{ $loop->index }})" @endif>
                            {{ $header }}
                            @if($sortable)
                                <i class="fas fa-sort sort-icon"></i>
                            @endif
                        </th>
                    @endforeach
                    @if(count($actions) > 0)
                        <th class="text-center">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($rows as $row)
                    <tr>
                        @foreach($row as $cell)
                            <td>{!! $cell !!}</td>
                        @endforeach
                        @if(count($actions) > 0)
                            <td class="text-center">
                                <div class="btn-group" role="group">
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
                            class="text-center py-4 text-muted">
                            <i class="fas fa-inbox fa-2x mb-2"></i>
                            <br>{{ $emptyMessage }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($searchable || $sortable)
    @push('scripts')
    <script>
        function filterTable() {
            const input = document.getElementById('tableSearch');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('dataTable');
            const rows = table.getElementsByTagName('tr');
            let visibleCount = 0;

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length - 1; j++) {
                    if (cells[j].textContent.toLowerCase().includes(filter)) {
                        found = true;
                        break;
                    }
                }

                if (found) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            }

            document.getElementById('recordCount').textContent = visibleCount;
        }

        @if($sortable)
        function sortTable(columnIndex) {
            const table = document.getElementById('dataTable');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            
            const header = table.querySelectorAll('th')[columnIndex];
            const isAscending = header.classList.contains('sort-asc');
            
            // Reset all sort icons
            table.querySelectorAll('.sort-icon').forEach(icon => {
                icon.className = 'fas fa-sort sort-icon';
            });
            table.querySelectorAll('th').forEach(th => {
                th.classList.remove('sort-asc', 'sort-desc');
            });
            
            // Sort rows
            rows.sort((a, b) => {
                const aText = a.cells[columnIndex].textContent.trim();
                const bText = b.cells[columnIndex].textContent.trim();
                
                if (isAscending) {
                    header.classList.add('sort-desc');
                    header.querySelector('.sort-icon').className = 'fas fa-sort-down sort-icon';
                    return bText.localeCompare(aText, undefined, { numeric: true });
                } else {
                    header.classList.add('sort-asc');
                    header.querySelector('.sort-icon').className = 'fas fa-sort-up sort-icon';
                    return aText.localeCompare(bText, undefined, { numeric: true });
                }
            });
            
            // Append sorted rows
            rows.forEach(row => tbody.appendChild(row));
        }
        @endif
    </script>
    @endpush
@endif

@push('styles')
<style>
    .admin-table-wrapper {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .search-box {
        position: relative;
    }
    
    .search-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }
    
    .admin-table th.sortable {
        cursor: pointer;
        user-select: none;
    }
    
    .admin-table th.sortable:hover {
        background-color: rgba(255,255,255,0.1);
    }
    
    .sort-icon {
        margin-left: 5px;
        opacity: 0.6;
    }
    
    .admin-table tbody tr:hover {
        background-color: rgba(0,123,255,0.05);
    }
</style>
@endpush
