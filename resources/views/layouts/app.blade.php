<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <link rel="stylesheet" href="{{ asset('assets') }}/css/app.css">
  {{-- bootstrap --}}
  <link rel="stylesheet" href="/public/assets/css/bootstrap.min.css">
  {{-- fontawesome --}}
  <link rel="stylesheet" href="/public/assets/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="/public/assets/fontawesome/css/brands.min.css">
  <link rel="stylesheet" href="/public/assets/fontawesome/css/regular.min.css">
  <link rel="stylesheet" href="/public/assets/fontawesome/css/solid.min.css">
  {{-- leaflet --}}
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet-gesture-handling/dist/leaflet-gesture-handling.min.css"
    type="text/css">
  <script src="https://unpkg.com/leaflet-gesture-handling"></script>
  {{-- leaflet draw --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
  {{-- turf --}}
  <script src='https://unpkg.com/@turf/turf@6/turf.min.js'></script>
  {{-- chartjs 4.2.1 --}}
  <script src="/public/assets/js/chart.umd.js"></script>
  {{-- chartjs-datalabel --}}
  <script src="/public/assets/js/chartjs-plugin-datalabels.min.js"></script>
  <!-- Scripts -->
  {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body>
  <div style="min-height: 100vh">
    {{-- Top Nav --}}
    @include('layouts.navigation')

    <!-- Page Heading (to be deleted)-->
    {{-- @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif --}}
    <div class="d-flex" style="min-height: 88vh">
      @include('layouts.sidebar')
      <!-- Page Content -->
      <main class="flex-grow-1 bg-secondary bg-opacity-25 p-3">
        {{ $slot }}
      </main>
    </div>
  </div>
  {{-- bootstrap js --}}
  <script src="/public/assets/js/bootstrap.bundle.min.js"></script>
  {{-- jquery js --}}
  <script src="/public/assets/js/jquery.min.js"></script>
</body>

</html>
