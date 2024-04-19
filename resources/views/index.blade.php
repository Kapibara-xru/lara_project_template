<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ getenv('APP_NAME') }}</title>

    @vite(['resources/scss/style.scss', 'resources/js/main.js'])
</head>
<body>
    <main id="app"></main>

    <script>
        window.flashMessage = @json(session('flash_message', '{}'));
    </script>
</body>
</html>
