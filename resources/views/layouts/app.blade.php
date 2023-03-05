<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <title>{{ config('app.name', 'Purchase Management System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="d-flex flex-column height-100vh">
<!-- Header -->
<header class="app-header p-3">
    @include('layouts.navigation')
</header>
<!-- Main -->
<main class="app-main d-flex h-100">
    <!-- Navigation -->
    <aside class="app-nav p-3 flex-grow-0">
        <x-side-nav/>
    </aside>
    <!-- Page Content -->
    <section class="app-section flex-grow-1">
        {{ $slot }}
    </section>
</main>
<!-- Footer -->
<footer class="app-footer p-3 d-flex justify-content-between">
    <div class="">
        &COPY 2023. All rights reserved
    </div>
    <!-- Location info from location views -->
    <div>
        @yield('current-page')
    </div>
</footer>
</body>
</html>
