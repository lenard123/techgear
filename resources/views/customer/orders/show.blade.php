<x-profile-page title="Order Details">
  @inject('status', \App\Enums\OrderStatus::class)
  <div class="bg-white shadow-lg rounded border-t-2 border-b-2 border-blue-500">

    <div class="py-5 px-8">
      <p class="text-lg text-blue-500 font-semibold mb-8">Purchase Receipt</p>
      <div class="grid grid-cols-4">
        <div class="col-span-3">
          <span class="block text-gray-500">Date</span>
          <span class="block text-gray-700 font-semibold">{{ $order->created_at->toFormattedDateString() }}</span>
        </div>

        <div>
          <span class="block text-gray-500">Order Id</span>
          <span class="block text-gray-700 font-semibold">#{{ str_pad($order->id, 7, "0", STR_PAD_LEFT) }}</span>
        </div>

      </div>
    </div>

    <div class="py-5 px-8 bg-gray-100">

      @foreach ($order->order_items as $item)
        <div class="grid grid-cols-4 mb-4">
          <div class="col-span-3">
            <a href="">
              <span class="font-light text-lg text-gray-500 hover:text-gray-700">{{ $item->product->name }}</span>
            </a>  
            <span class="block text-sm text-gray-500">{{ $item->quantity }} × @currency($item->price)</span>
          </div>
          <div class="text-lg font-light">@currency($item->subtotal())</div>
        </div>
      @endforeach

      <div class="grid grid-cols-4">
        <div class="col-span-3">
          <span class="font-light">Shipping</span>
        </div>
        <div class="text-lg font-light">@currency($order->shipping_fee)</div>
      </div>

    </div>

    <div class="grid grid-cols-4 px-8 py-4">
      <div class="col-span-3"></div>
      <div class="font-semibold text-lg text-blue-500">@currency($order->grandTotal())</div>
    </div>

    <div class="px-8 pb-5">

      <div class="text-lg text-blue-500 font-semibold mb-4">Order Status</div>

      <div class="h-1 bg-gray-200 rounded relative">
        <div class="absolute top-0 w-full h-full grid grid-cols-3">
          @for ($i = 1; $i < $order->status; $i++)
            <div class="h-full bg-blue-500"></div>
          @endfor
        </div>
        <div class="absolute flex w-full justify-between">
          @foreach ($status::all() as $state)            
            <div class="h-3 w-3 rounded-full -mt-1 @if ($state <= $order->status) bg-blue-500 @endif"></div>
          @endforeach
        </div>

      </div>

      <div class="flex justify-between text-xs  text-gray-700 mb-4">
        @foreach ($status::all() as $key => $value)
          <span class="capitalize">{{ strtolower($key) }} </span>
        @endforeach
      </div>

    </div>

  </div>
</x-profile-page>