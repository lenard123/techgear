<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
    <title>{{  isset($title) ? $title . ' | ' : ''}}TechGear</title>
</head>
<body class="bg-gray-50">

@include('layouts.customer.header')
@include('layouts.customer.sidebar')

{{ $slot }}

@include('layouts.customer.alert-message')

@stack('scripts')
<script src="{{ asset('js/app.js') }}" defer></script>
@stack('postScripts')

</body>
</html>