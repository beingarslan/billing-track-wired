<!DOCTYPE html>
<html lang="en" data-bs-theme="purple-light">
<!-- For RTL verison -->
<!-- <html lang="en" dir="rtl"> -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- viewport-fit=cover makes env(safe-area-inset-*) resolve on notched iPhones,
         which mobile.css uses for the sticky action bar and back-to-top button. --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('bt.headerTitleText') }}</title>
    <link rel="stylesheet" href="/build/assets/app.css">
    @include('layouts._head')
    <script src="/build/assets/app.js"></script>
        @include('layouts._js_global')
        @yield('javaScript')
</head>
<body class="layout-fixed sidebar-expand-lg sidebar-{{$sidebarMode}}">
<div class="app-wrapper">
    @include('client_center.layouts._header')
    @include('client_center.layouts.sidebar')
    <main class="app-main">
        @yield('content')
    </main>
</div>
<div id="modal-placeholder"></div>
{{-- Companion to the null guard in layouts/_js_global: this shell had no .back-to-top, and
     these are long scrolling list pages on a phone. Same markup as layouts/master. --}}
<a href="#" class="back-to-top">
    <i class="fa fa-chevron-circle-up"></i>
</a>
</body>
</html>
