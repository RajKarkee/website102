// Admin sidebar functionality
document.addEventListener('DOMContentLoaded', function() {
    // Ensure overlay is hidden on page load (fix for clickability issues)
    const overlay = document.getElementById('overlay');
    if (overlay) {
        overlay.classList.remove('show');
        overlay.style.display = 'none';
    }
    
    // Initialize Bootstrap collapse for submenu toggles
    const collapseElements = document.querySelectorAll('[data-bs-toggle="collapse"]');
    
    collapseElements.forEach(element => {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('data-bs-target');
            const target = document.querySelector(targetId);
            const arrow = this.querySelector('.arrow');
            
            if (target) {
                // Toggle the submenu
                if (target.classList.contains('show')) {
                    target.classList.remove('show');
                    this.classList.add('collapsed');
                } else {
                    // Close other open submenus
                    document.querySelectorAll('.submenu.show').forEach(openSubmenu => {
                        if (openSubmenu !== target) {
                            openSubmenu.classList.remove('show');
                            const parentLink = document.querySelector(`[data-bs-target="#${openSubmenu.id}"]`);
                            if (parentLink) {
                                parentLink.classList.add('collapsed');
                            }
                        }
                    });
                    
                    target.classList.add('show');
                    this.classList.remove('collapsed');
                }
            }
        });
        
        // Initialize collapsed state
        element.classList.add('collapsed');
    });
    
    // Mobile sidebar toggle
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    
    if (menuToggle && sidebar && overlay) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
            
            // On desktop, never show overlay
            if (window.innerWidth >= 992) {
                overlay.classList.remove('show');
                overlay.style.display = 'none';
            }
        });
        
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
            overlay.style.display = 'none';
        });
    }
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 991) {
            if (sidebar) sidebar.classList.remove('show');
            if (overlay) {
                overlay.classList.remove('show');
                overlay.style.display = 'none';
            }
        }
    });
    
    // Initial check for desktop
    if (window.innerWidth >= 992 && overlay) {
        overlay.classList.remove('show');
        overlay.style.display = 'none';
    }
});
