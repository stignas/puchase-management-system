<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"
          integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/6759c1c345.js" crossorigin="anonymous"></script>
    <title>Purchase Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@if(Route::has('login'))
    @auth
        <a href="{{ url('/dashboard') }}">Dashboard</a>
    @else
        <main class="height-100vh">
            <div class="container text-center height-100">
                <div class="grid-5x5 height-100">
                    <div class="grid-logo">
                        <div class="p-3">
                            <a href="{{ route('home') }}">
                                <x-application-logo/>
                            </a>
                        </div>
                    </div>
                    <div class="grid-form">
                        <div class="p-3 bg-secondary border border-info">
                            <!-- Login form -->
                            <div id="login-form-container">
                                <x-login-form/>
                            </div>
                            <!-- Forgot password form -->
                            <div id="forgot-password-container" class="hide">
                                <x-forgot-password/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endauth
@endif
</body>
</html>
