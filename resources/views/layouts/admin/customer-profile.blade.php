<x-layouts.admin :title="$customer->fullname">

  <div class="p-4">

    <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded mt-8">

      <div class="py-8 px-6">
        <div class="w-1/4 mb-4 mx-auto rounded-full overflow-hidden">
          <img src="{{ $customer->imageUrl }}" class="w-full h-full">
        </div>

        <div class="text-center font-bold text-2xl text-gray-700">{{ $customer->fullname }}</div>

      </div>

      <div class="grid grid-cols-3 text-gray-600 text-center border-b border-gray-200">
        <a href="{{ route('admin.customers.profile', $customer) }}" class="py-4 @routeIs('admin.customers.profile') font-bold @endrouteIs">Customer Info</a>
        <a href="{{ route('admin.customers.orders', $customer) }}" class="py-4 @routeIs('admin.customers.orders') font-bold @endrouteIs border-l border-r border-gray-200">Orders</a>
        <a href="{{ route('admin.customers.favorites', $customer) }}" class="py-4 @routeIs('admin.customers.favorites') font-bold @endrouteIs">Favorites</a>
      </div>

      <div class="p-4 {{ $attributes }}">
        {{ $slot }}
      </div>

    </div>

  </div>

</x-layouts.admin>