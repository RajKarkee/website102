
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-nav">
            <div class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#userSubmenu">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                    <i class="fas fa-chevron-down arrow"></i>
                </a>
                <div class="submenu" id="userSubmenu">
                    <a href="#" class="nav-link">All Users</a>
                    <a href="#" class="nav-link">Add User</a>
                    <a href="#" class="nav-link">User Roles</a>
                </div>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.jumbotron.index') }}" class="nav-link">
                    <i class="fas fa-chart-bar"></i>
                    <span>Jumbotron</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.about.index') }}" class="nav-link">
                    <i class="fas fa-info-circle"></i>
                    <span>About</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#productSubmenu">
                    <i class="fas fa-box"></i>
                    <span>Products</span>
                    <i class="fas fa-chevron-down arrow"></i>
                </a>
                <div class="submenu" id="productSubmenu">
                    <a href="#" class="nav-link">All Products</a>
                    <a href="#" class="nav-link">Add Product</a>
                    <a href="#" class="nav-link">Categories</a>
                </div>
            </div>

            <div class="nav-item">
                <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#orderSubmenu">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                    <i class="fas fa-chevron-down arrow"></i>
                </a>
                <div class="submenu" id="orderSubmenu">
                    <a href="#" class="nav-link">All Orders</a>
                    <a href="#" class="nav-link">Pending Orders</a>
                    <a href="#" class="nav-link">Completed Orders</a>
                </div>
            </div>

            <div class="nav-item">
                <a href="{{ route('admin.partner.index') }}" class="nav-link">
                    <i class="fas fa-handshake"></i>
                    <span>Partners</span>
                </a>
            </div>

            <div class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-chart-bar"></i>
                    <span>Analytics</span>
                </a>

<nav class="sidebar" id="sidebar">
    <div class="sidebar-nav">
        <div class="nav-item">
            <a href="#" class="nav-link active">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#userSubmenu">
                <i class="fas fa-users"></i>
                <span>Users</span>
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="submenu" id="userSubmenu">
                <a href="#" class="nav-link">All Users</a>
                <a href="#" class="nav-link">Add User</a>
                <a href="#" class="nav-link">User Roles</a>

            </div>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.jumbotron.index') }}" class="nav-link">
                <i class="fas fa-chart-bar"></i>
                <span>Jumbotron</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.about.index') }}" class="nav-link">
                <i class="fas fa-info-circle"></i>
                <span>About</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.cta.index') }}" class="nav-link">
                <i class="fas fa-bullhorn"></i>
                <span>CTA Management</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.team.index') }}" class="nav-link">
                <i class="fas fa-users"></i>
                <span>Team</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.position.index') }}" class="nav-link">
                <i class="fas fa-briefcase"></i>
                <span>Positions</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#productSubmenu">
                <i class="fas fa-box"></i>
                <span>Products</span>
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="submenu" id="productSubmenu">
                <a href="#" class="nav-link">All Products</a>
                <a href="#" class="nav-link">Add Product</a>
                <a href="#" class="nav-link">Categories</a>
            </div>

            <div class="nav-item">
                <a href="{{ route('admin.service.index') }}" class="nav-link">
                    <i class="fas fa-wrench"></i>
                    <span>Services</span>
                </a>

        </div>
        <div class="nav-item">
            <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#orderSubmenu">
                <i class="fas fa-shopping-cart"></i>
                <span>Orders</span>
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="submenu" id="orderSubmenu">
                <a href="#" class="nav-link">All Orders</a>
                <a href="#" class="nav-link">Pending Orders</a>
                <a href="#" class="nav-link">Completed Orders</a>

            </div>
        </div>
        <div class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-chart-bar"></i>
                <span>Analytics</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.industry.index') }}" class="nav-link">
                <i class="fas fa-industry"></i>
                <span>Industry</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.service.index') }}" class="nav-link">
                <i class="fas fa-wrench"></i>
                <span>Services</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#reportSubmenu">
                <i class="fas fa-file-alt"></i>
                <span>Reports</span>
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="submenu" id="reportSubmenu">
                <a href="#" class="nav-link">Sales Report</a>
                <a href="#" class="nav-link">User Report</a>
                <a href="#" class="nav-link">Product Report</a>
            </div>
        </div>
    </div>
</nav>
