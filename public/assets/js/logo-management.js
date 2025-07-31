// Logo Management JavaScript
document.addEventListener('DOMContentLoaded', function() {
    initializeLogoSearch();
    initializeTooltips();
});

// Search functionality
function initializeLogoSearch() {
    const searchInput = document.getElementById('logoSearch');
    const table = document.getElementById('logoTable');
    
    if (!searchInput || !table) return;
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = table.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            if (row.querySelector('.empty-state')) return; // Skip empty state row
            
            const text = row.textContent.toLowerCase();
            const shouldShow = text.includes(searchTerm);
            
            row.style.display = shouldShow ? '' : 'none';
        });
        
        // Update showing count
        updateShowingCount();
    });
}

// Initialize Bootstrap tooltips
function initializeTooltips() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

// Export table to CSV
function exportTable() {
    const table = document.getElementById('logoTable');
    if (!table) return;
    
    let csv = [];
    const rows = table.querySelectorAll('tr');
    
    // Add headers
    const headers = [];
    const headerCells = table.querySelectorAll('thead th');
    headerCells.forEach(cell => {
        if (cell.textContent.trim() !== 'Actions') {
            headers.push('"' + cell.textContent.trim() + '"');
        }
    });
    csv.push(headers.join(','));
    
    // Add data rows
    const dataRows = table.querySelectorAll('tbody tr');
    dataRows.forEach(row => {
        if (row.style.display === 'none' || row.querySelector('.empty-state')) return;
        
        const cols = [];
        const cells = row.querySelectorAll('td');
        
        cells.forEach((cell, index) => {
            if (index < cells.length - 1) { // Skip actions column
                let text = cell.textContent.trim();
                // Clean up the text
                text = text.replace(/\s+/g, ' ');
                cols.push('"' + text + '"');
            }
        });
        
        if (cols.length > 0) {
            csv.push(cols.join(','));
        }
    });
    
    // Create download
    const csvContent = csv.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    
    const a = document.createElement('a');
    a.href = url;
    a.download = 'logos_' + new Date().toISOString().split('T')[0] + '.csv';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
}

// Update showing count after search
function updateShowingCount() {
    const table = document.getElementById('logoTable');
    const footer = document.querySelector('.card-footer small');
    
    if (!table || !footer) return;
    
    const visibleRows = table.querySelectorAll('tbody tr:not([style*="display: none"])');
    const emptyStateRow = table.querySelector('tbody tr .empty-state');
    const count = emptyStateRow ? 0 : visibleRows.length;
    
    footer.textContent = `Showing ${count} logo${count !== 1 ? 's' : ''}`;
}

// Confirmation dialogs with enhanced styling
function confirmActivation(logoName) {
    return confirm(`Set "${logoName}" as the active logo?\n\nThis will deactivate the current active logo.`);
}

function confirmDeletion(logoName) {
    return confirm(`Delete "${logoName}"?\n\nThis action cannot be undone.`);
}
