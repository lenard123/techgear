<x-layouts.main class="bg-gray-100" :title="$title">

  @push('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
  @endpush

  @include('layouts.admin.header')
  @include('layouts.admin.sidebar')

  <div class="lg:pl-64 pt-16">
    {{ $slot }}
  </div>

  @push('scripts')
    <script type="text/javascript" src="{{ asset('js/admin.js') }}" defer></script>
  @endpush

  @include('layouts.customer.alert-message')

  @include('layouts.admin.modal')

</x-layouts.main>