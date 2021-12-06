<x-layouts.customer title="Shopping Cart">

  <div class="py-5 container mx-auto sm:px-5">

    <h1 class="text-2xl font-semibold text-center text-gray-800">Shopping Cart</h1>

    @if ($cartsData->items->isEmpty())

      <div class="bg-white py-6 px-5 text-gray-600 mt-8 max-w-2xl mx-auto shadow-lg">
        <div class="text-center sm:text-left text-xl border-b border-gray-200 pb-5 mb-3">No Items in cart</div>
        <div class="text-sm text-primary">
          <a href="{{ route('home') }}">Shop Now</a>
        </div>
      </div>

    @else

      <div class="grid lg:grid-cols-12 gap-4 text-gray-500 mt-8">

        <div class="lg:col-span-9">
          @include('customer.carts.list')
        </div>

        <div class="lg:col-span-3">
          @include('customer.carts.summary')
        </div>
      </div>

    @endif

  </div>

</x-layouts.customer>