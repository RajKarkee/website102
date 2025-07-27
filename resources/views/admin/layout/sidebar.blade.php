
    <!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-nav">
        <!-- Dashboard -->
        <div class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </div>

        <!-- Users Management -->
        <div class="nav-item">
            <a href="#" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#userSubmenu">
                <i class="fas fa-users"></i>
                <span>Users</span>
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="submenu" id="userSubmenu">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">All Users</a>
                <a href="{{ route('admin.dashboard') }}" class="nav-link">Add User</a>
                <a href="{{ route('admin.dashboard') }}" class="nav-link">User Roles</a>
            </div>
        </div>

        <!-- Content Management -->
        <div class="nav-item">
            <a href="{{ route('admin.jumbotron.index') }}" class="nav-link {{ request()->routeIs('admin.jumbotron.*') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                <span>Jumbotron</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.about.index') }}" class="nav-link {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                <i class="fas fa-info-circle"></i>
                <span>About</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.industry.index') }}" class="nav-link {{ request()->routeIs('admin.industry.*') ? 'active' : '' }}">
                <i class="fas fa-industry"></i>
                <span>Industry</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.service.index') }}" class="nav-link {{ request()->routeIs('admin.service.*') ? 'active' : '' }}">
                <i class="fas fa-wrench"></i>
                <span>Services</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.cta.index') }}" class="nav-link {{ request()->routeIs('admin.cta.*') ? 'active' : '' }}">
                <i class="fas fa-bullhorn"></i>
                <span>CTA Management</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.team.index') }}" class="nav-link {{ request()->routeIs('admin.team.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Team</span>
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.position.index') }}" class="nav-link {{ request()->routeIs('admin.position.*') ? 'active' : '' }}">
                <i class="fas fa-briefcase"></i>
                <span>Positions</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <i class="fas fa-comments"></i>
                <span>Testimonials</span>
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.partner.index') }}" class="nav-link {{ request()->routeIs('admin.partner.*') ? 'active' : '' }}">
                <i class="fas fa-handshake"></i>
                <span>Partners</span>
            </a>
        </div>

        <!-- Products Management -->
        <div class="nav-item">
            <a href="#" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#productSubmenu">
                <i class="fas fa-box"></i>
                <span>Products</span>
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="submenu" id="productSubmenu">
                <a href="{{ route('admin.products.index') }}" class="nav-link">All Products</a>
                <a href="{{ route('admin.products.create') }}" class="nav-link">Add Product</a>
                <a href="{{ route('admin.products.categories.index') }}" class="nav-link">Categories</a>
            </div>
        </div>

        <!-- Orders Management -->
        <div class="nav-item">
            <a href="#" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#orderSubmenu">
                <i class="fas fa-shopping-cart"></i>
                <span>Orders</span>
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="submenu" id="orderSubmenu">
                <a href="{{ route('admin.orders.index') }}" class="nav-link">All Orders</a>
                <a href="{{ route('admin.orders.pending') }}" class="nav-link">Pending Orders</a>
                <a href="{{ route('admin.orders.completed') }}" class="nav-link">Completed Orders</a>
            </div>
        </div>

        <!-- Reports -->
        <div class="nav-item">
            <a href="#" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#reportSubmenu">
                <i class="fas fa-file-alt"></i>
                <span>Reports</span>
                <i class="fas fa-chevron-down arrow"></i>
            </a>
            <div class="submenu" id="reportSubmenu">
                <a href="{{ route('admin.reports.sales') }}" class="nav-link">Sales Report</a>
                <a href="{{ route('admin.reports.users') }}" class="nav-link">User Report</a>
                <a href="{{ route('admin.reports.products') }}" class="nav-link">Product Report</a>
            </div>
        </div>

        <!-- Analytics -->
        <div class="nav-item">
            <a href="{{ route('admin.analytics') }}" class="nav-link {{ request()->routeIs('admin.analytics') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                <span>Analytics</span>
            </a>
        </div>
    </div>
</nav>
</aside>
{{-- 
            <div class="nav-item">
                <a href="#" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#userSubmenu">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                    <i class="fas fa-chevron-down arrow"></i>
                </a>
                <div class="submenu" id="userSubmenu">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">All Users</a>
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Add User</a>
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">User Roles</a>
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
                <a href="{{ route('admin.testimonials.index') }}" class="nav-link">
                    <i class="fas fa-comments"></i>
                    <span>Testimonials</span>
                </a>


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
                </div> --}}
</aside><!-- End of Sidebar -->
        {{-- <div class="nav-item">
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
 --}}
