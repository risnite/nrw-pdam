<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/public/assets/css/app.css">
    <link rel="stylesheet" href="/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/public/assets/fontawesome/css/brands.min.css">
    <link rel="stylesheet" href="/public/assets/fontawesome/css/regular.min.css">
    <link rel="stylesheet" href="/public/assets/fontawesome/css/solid.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        {{-- Top Nav --}}
        @include('layouts.navigation')

        <!-- Page Heading (to be deleted)-->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif
        <div class="d-flex">
            @include('layouts.sidebar')
            <!-- Page Content -->
            <main class="flex-grow-1">
                {{ $slot }}
            </main>
        </div>
    </div>
    <script src="/public/assets/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>