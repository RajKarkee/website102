<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('Front/main.css') }}">
    @stack('styles')
    <style>
    .header {
        background: linear-gradient(135deg, var(--primary-color), var(--hover-color));
        color: var(--text-light);
        height: var(--header-height);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 100%;
        padding: 0 20px;
    }

    .logo {
        font-size: 1.5rem;
        font-weight: bold;
        color: var(--text-light);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .menu-toggle {
        display: none;
        background: none;
        border: none;
        color: var(--text-light);
        font-size: 1.2rem;
        cursor: pointer;
        padding: 5px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .menu-toggle:hover {
        background-color: rgba(255,255,255,0.1);
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .user-menu {
        position: relative;
    }

    .user-btn {
        background: none;
        border: none;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .user-btn:hover {
        background-color: rgba(255,255,255,0.1);
    }

    .user-dropdown {
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        border-radius: 8px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        min-width: 200px;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        z-index: 1001;
    }

    .user-dropdown.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .user-dropdown a {
        display: block;
        padding: 12px 16px;
        color: #333;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .user-dropdown a:hover {
        background-color: #f8f9fa;
    }

    .user-dropdown a:first-child {
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .user-dropdown a:last-child {
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }
 </style>
</head>
<body>
    @include('admin.layout.header')
    
 

 
    @include('admin.layout.sidebar')

    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>

    <!-- Main Content -->
    @yield('content')
   
    <!-- jQuery first -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Dropify -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/js/dropify.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {
            // Mobile menu toggle
            $('#menuToggle').on('click', function() {
                $('#sidebar').toggleClass('show');
                $('#overlay').toggleClass('show');
            });

            // Close sidebar when clicking overlay
            $('#overlay').on('click', function() {
                $('#sidebar').removeClass('show');
                $('#overlay').removeClass('show');
            });

            // User dropdown toggle
            $('#userBtn').on('click', function(e) {
                e.preventDefault();
                $('#userDropdown').toggleClass('show');
            });

            // Close user dropdown when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.user-menu').length) {
                    $('#userDropdown').removeClass('show');
                }
            });

            // Sidebar dropdown functionality
            $('.nav-link[data-bs-toggle="collapse"]').on('click', function(e) {
                e.preventDefault();
                
                const target = $(this).data('bs-target');
                const submenu = $(target);
                const arrow = $(this).find('.arrow');
                
                // Toggle submenu
                if (submenu.hasClass('show')) {
                    submenu.removeClass('show');
                    arrow.removeClass('rotated');
                } else {
                    // Close other submenus
                    $('.submenu').removeClass('show');
                    $('.arrow').removeClass('rotated');
                    
                    // Open clicked submenu
                    submenu.addClass('show');
                    arrow.addClass('rotated');
                }
            });

            // Active nav link
            $('.nav-link').on('click', function() {
                if (!$(this).hasClass('submenu-toggle')) {
                    $('.nav-link').removeClass('active');
                    $(this).addClass('active');
                }
            });

            // Smooth scrolling
            $('a[href^="#"]').on('click', function(event) {
                var target = $(this.getAttribute('href'));
                if (target.length) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                }
            });

            // Close mobile menu when window is resized
            $(window).on('resize', function() {
                if ($(window).width() > 768) {
                    $('#sidebar').removeClass('show');
                    $('#overlay').removeClass('show');
                }
            });

            // Add loading animation to cards
            $('.stat-card').each(function(index) {
                $(this).delay(index * 100).queue(function() {
                    $(this).addClass('fade-in').dequeue();
                });
            });
       
        });
    </script>
    @stack('scripts')
</body>
</html>