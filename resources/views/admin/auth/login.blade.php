
<!DOCTYPE html>website102
<html lang="en">
<head>
    <meta charset="UTwebsite102F-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('Front/login/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="wave-shape"></div>
        <div class="wave-shape"></div>
    </div>
    <div class="login-container">
        <div class="logo mb-3">
            <div class="logo-icon"><i class="fas fa-user-shield fa-2x"></i></div>
            <div class="logo-text fw-bold">Admin Panel</div>
        </div>
        <h2 class="login-title mb-3">Sign In</h2>

        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('error') }}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" autocomplete="off">
            @csrf
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required autofocus>
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="signin-btn btn btn-primary w-100">Login</button>
        </form>
    </div>
</body>
</html>
