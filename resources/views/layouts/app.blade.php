<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $texts['title'] ?? config('app.name') }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.3.95/css/materialdesignicons.min.css">
    @stack('head')
</head>
<body>
@stack('main')
<script src="{{ asset(mix('js/manifest.js')) }}"></script>
<script src="{{ asset(mix('js/vendor.js')) }}"></script>
<script src="{{ asset(mix('js/app.js')) }}"></script>
</body>
</html>
