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
    <link rel="stylesheet" href="{{ asset('assets/css/admin-app.css') }}">
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
