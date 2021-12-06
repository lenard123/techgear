<x-profile-page title="Orders">
  
  @inject('status', \App\Enums\OrderStatus::class)

  <div class="bg-white rounded shadow">

    <div class="p-5 border-b border-gray-200">
      <h1 class="text-4xl text-gray-800 font-semibold">Orders</h1>
    </div>

    @if ($orders->isEmpty())
      <div class="py-10 text-center">You don't have any orders</div>
    @else
      @foreach($orders as $order)
        <div class="p-5 border-gray-200 @if(!$loop->last) border-b @endif">

          <div class="mb-3">
            <a href="{{ route('orders.show', $order) }}">
              <h2 class="text-xl inline hover:text-blue-500">#{{ str_pad($order->id, 7, "0", STR_PAD_LEFT) }}</h2>
              <h4 class="text-sm text-gray-500 inline">from {{ $order->created_at->diffForHumans() }}</h4>
            </a>
          </div>

          <div class="grid grid-cols-12 border-b border-gray-200 py-3">
            <div class="col-span-4 text-gray-500">
              Items
            </div>
            <div class="col-span-8 text-gray-700">
              {{ $order->quantity }}
            </div>
          </div>

          <div class="grid grid-cols-12 border-b border-gray-200 py-3">
            <div class="col-span-4 text-gray-500">
              Payment
            </div>
            <div class="col-span-8 text-gray-700">
              Cash on Delivery
            </div>
          </div>

          <div class="grid grid-cols-12 border-b border-gray-200 py-3">
            <div class="col-span-4 text-gray-500">
              Total
            </div>
            <div class="col-span-8 text-gray-700">
              @currency($order->total + $order->shipping_fee)
            </div>
          </div>

          <div class="grid grid-cols-12 py-3">
            <div class="col-span-4 text-gray-500">
              Status
            </div>
            <div class="col-span-8 text-gray-700" x-data>
              @if ($order->is_cancelled)
                <span class="inline-block px-2 py-1 bg-red-500 text-white text-sm">Cancelled</span>
              @else
                @if ($order->status === $status::PREPARING)
                  <span class="inline-block px-2 py-1 bg-blue-500 text-white text-sm" x-tooltip="We are still processing your order">PREPARING</span>
                @elseif($order->status === $status::SHIPPED)
                  <span class="inline-block px-2 py-1 bg-purple-500 text-white text-sm" x-tooltip="Your order has been shipped">SHIPPED</span>
                @elseif($order->status === $status::DELIVERY)
                  <span class="inline-block px-2 py-1 bg-yellow-500 text-white text-sm" x-tooltip="Your is order is out for delivery. Please prepare the exact amount, thank you.">DELIVERY</span>
                @elseif($order->status === $status::DELIVERED)
                  <span class="inline-block px-2 py-1 bg-green-500 text-white text-sm" x-tooltip="Your order has been delivered.">DELIVERED</span>
                @endif
              @endif
            </div>
          </div>

        </div>
      @endforeach
    @endif

  </div>

</x-profile-page>