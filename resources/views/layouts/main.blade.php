<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }}</title>
  @stack('css')
</head>
<body {{ $attributes }}>

{{ $slot }}

@stack('scripts')
</body>
</html>