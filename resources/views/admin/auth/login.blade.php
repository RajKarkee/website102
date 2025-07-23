<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('Front/login/main.css') }}">


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
        <div class="logo">
            <div class="logo-icon"></div>
            <div class="logo-text">logo</div>
        </div>

        <h2 class="login-title">Login</h2>

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="form-group">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="signin-btn">Login</button>
        </form>
    </div>
</body>

</html>
