<x-layouts.admin title="All Orders">
  @inject('status', \App\Enums\OrderStatus::class)
  <div class="p-8">

    <div class="bg-white rounded shadow-lg">

      <div class="p-4 border-b border-gray-200">
        <span class="font-semibold text-lg text-gray-800">All Orders</span>
      </div>

      <div class="p-4">

        <div class="grid grid-cols-8 font-semibold text-sm border-b border-gray-200 p-4 gap-4">
          <span>Order ID</span>
          <span>Date</span>
          <span class="col-span-2">Customer</span>
          <span>Amount</span>
          <span>Status</span>
          <span>Payment</span>
          <span class="text-right">Actions</span>
        </div>

        @foreach ($orders as $order)
        <div class="grid grid-cols-8 border-b border-gray-200 p-4 text-sm gap-2">
          <div>{{ $order->code }}</div>
          <div>{{ $order->created_at->diffForHumans() }}</div>
          <div class="col-span-2">
            <a href="{{ route('admin.customers.profile', $order->user) }}" class="hover:text-primary"> 
              {{ $order->user->fullname }}
            </a>
          </div>
          <div>@currency($order->total + $order->shipping_fee)</div>
          <div class="text-white text-xs">
            @if ($order->is_cancelled)
              <span class="inline-block px-2 py-1 bg-red-500 rounded">CANCELLED</span>
            @else
              @if ($order->status === $status::PREPARING)
                <span class="inline-block px-2 py-1 bg-blue-500 rounded">PREPARING</span>
              @elseif($order->status === $status::SHIPPED)
                <span class="inline-block px-2 py-1 bg-purple-500 rounded">SHIPPED</span>
              @elseif($order->status === $status::DELIVERY)
                <span class="inline-block px-2 py-1 bg-yellow-500 rounded">DELIVERY</span>
              @elseif($order->status === $status::DELIVERED)
                <span class="inline-block px-2 py-1 bg-green-500 rounded">DELIVERED</span>
              @endif
            @endif
          </div>
          <div class="text-xs font-semibold">Cash On Delivery</div>
          <div>
            <div class="flex justify-end gap-2">
              <a href="{{ route('admin.orders.show', $order) }}" class="border border-green-200 bg-green-100 p-2 rounded-full text-green-400 hover:bg-green-400 hover:text-white hover:border-green-400 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <div class="py-4 px-8">
        {{ $orders->links() }}
      </div>

    </div>

  </div>
</x-layouts.admin>