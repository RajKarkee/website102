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

    
    <!-- Dropify CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/css/dropify.min.css">
    



    <link rel="stylesheet" href="{{ asset('Front/main.css') }}">
    
    @stack('styles')
    <style>
        :root {
            --header-height: 60px;
            --sidebar-width: 250px;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }

        .header {
            background: linear-gradient(135deg, var(--primary-color), var(--hover-color));
            color: var(--text-light);
            height: var(--header-height);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
            padding: 0 20px;
        }

        .sidebar {
            position: fixed;
            top: var(--header-height);
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 20px;
            flex: 1;
            min-height: calc(100vh - var(--header-height));
            background-color: #f8f9fa;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 5px;
            margin: 0 10px;
        }

        .nav-link:hover, .nav-link.active {
            background-color: #f8f9fa;
            color: var(--primary-color);
        }

        .submenu {
            background-color: #f8f9fa;
            overflow: hidden;
            transition: height 0.3s ease-out;
            padding-left: 25px;
        }

        .submenu .nav-link {
            padding: 8px 15px;
            font-size: 0.95em;
            opacity: 0.9;
            transition: all 0.3s ease;
        }

        .submenu .nav-link:hover {
            opacity: 1;
            padding-left: 20px;
        }

        .arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
            width: 16px;
            height: 16px;
            display: inline-block;
            text-align: center;
            line-height: 16px;
        }

        .arrow.rotated {
            transform: rotate(180deg);
        }

        /* Prevent text selection during navigation */
        .nav-link {
            user-select: none;
            -webkit-user-select: none;
            cursor: pointer;
            position: relative;
        }

        /* Active state styles */
        .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }

        .nav-item {
            position: relative;
        }

        .nav-link i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }

        .submenu {
            padding-left: 30px;
            display: none;
            overflow: hidden;
        }

        .submenu.show {
            display: block;
        }

        .arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .arrow.rotated {
            transform: rotate(180deg);
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
            background-color: rgba(255, 255, 255, 0.1);
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
            background-color: rgba(255, 255, 255, 0.1);
        }

        .user-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
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

   
    <!-- Core JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropify/0.2.2/js/dropify.min.js" defer></script>



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
            $(document).on('click', '.nav-link[data-bs-toggle="collapse"]', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const $this = $(this);
                const $submenu = $($this.data('bs-target'));
                const $arrow = $this.find('.arrow');
                
                // Close other submenus
                $('.submenu').not($submenu).slideUp(300);
                $('.arrow').not($arrow).removeClass('rotated');
                
                // Toggle current submenu
                $submenu.slideToggle(300, function() {
                    // Update arrow only after animation completes
                    $arrow.toggleClass('rotated');
                });
                
                // Set active state
                $('.nav-link').not($this).removeClass('active');
                $this.toggleClass('active');
                e.preventDefault();
                e.stopPropagation();

                const target = $(this).data('bs-target');
                const submenu = $(target);
                const arrow = $(this).find('.arrow');

                // Toggle current submenu
                submenu.slideToggle(300);
                arrow.toggleClass('rotated');

                // Close other submenus
                $('.submenu').not(submenu).slideUp(300);
                $('.arrow').not(arrow).removeClass('rotated');
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
    </script>@stack('scripts')
</body>

</html>
