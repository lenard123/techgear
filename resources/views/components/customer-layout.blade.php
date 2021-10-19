<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
    <title>{{ isset($title) ? $title . ' | ' : ''}}TechGear</title>
</head>
<body class="bg-gray-50" style="height: 125vh">

@include('components.customer-header')
@include('components.customer-sidebar')

{{ $slot }}

<script src="{{ asset('js/app.js') }}" defer></script>
@stack('scripts')
</body>
</html>