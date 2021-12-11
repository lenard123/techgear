<x-layouts.main :title="$title" class="bg-gray-50 flex flex-col min-h-screen">

    @push('css')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    @endpush

    @include('layouts.customer.header')
    @include('layouts.customer.sidebar')

    <div class="flex-grow">
        {{ $slot }}
    </div>

    @include('layouts.customer.footer')

    @include('layouts.customer.alert-message')

    @push('scripts')
        <script src="{{ asset('js/app.js') }}" defer></script>
        @stack('postScripts')
    @endpush

</x-layouts.main>