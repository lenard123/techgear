<x-layouts.admin :title="$order->code">
  @inject('status', \App\Enums\OrderStatus::class)
  <div class="p-8">

    <div class="bg-white rounded shadow-lg">
      <div class="p-4 border-b border-gray-200">
        <span class="font-semibold text-lg text-gray-800">Order Details</span>
      </div>

      <div class="p-4">

        <div class="flex justify-between pb-4 border-b border-gray-200">

          <div class="text-sm">
            <p class="font-bold">{{ $order->firstname . ' '. $order->lastname }}</p>
            <p>{{ $order->email }}</p>
            <p>{{ $order->phone }}</p>
            <p>{{ $order->address }}</p>
          </div>

          <div>
            <div class="text-xs font-semibold grid gap-y-1 gap-x-4 grid-cols-2">
              <p>Order #</p>
              <p class="text-right">{{ $order->code }}</p>

              <p>Order Status</p>
              <div class="text-right">
                @if ($order->is_cancelled)
                  <span>Cancelled</span>
                @else
                  @if ($order->status === $status::PREPARING)
                    <span>Preparing</span>
                  @elseif($order->status === $status::SHIPPED)
                    <span>Shipped</span>
                  @elseif($order->status === $status::DELIVERY)
                    <span>Delivery</span>
                  @elseif($order->status === $status::DELIVERED)
                    <span>Delivered</span>
                  @endif
                @endif
              </div>

              <p>Order Date</p>
              <p class="text-right">{{ $order->created_at->toFormattedDateString() }}</p>

              <p>Total Amount</p>
              <p class="text-right">@currency($order->grandTotal())</p>

              <p>Payment Method</p>
              <p class="text-right">Cash on Delivery</p>
            </div>
          </div>

        </div>

        <table class="mt-4 text-gray-800 text-sm border-collapse border border-gray-200 w-full">
          
          <thead>
            <tr>
              <th class="py-4 px-3 border border-gray-200 text-left" width="20%">Photo</th>
              <th class="py-4 px-3 border border-gray-200 text-left">Description</th>
            </tr>
          </thead>

          <tbody>
            @foreach($order->order_items as $item)
            <tr>
              <td class="py-4 px-3 border border-gray-200">
                <div class="w-full relative" style="padding-top: 75%;">
                  <img 
                    src="{{ $item->product->imageUrl }}" 
                    class="rounded object-cover absolute top-0 left-0 h-full w-full"
                  />
                </div>
              </td>
              <td class="py-4 px-3 border border-gray-200 align-top">
                <div class="flex flex-col gap-2 justify-start font-semibold text-gray-700">
                  <p>{{ $item->product->name }}</p>
                  <p>
                    <span class="font-semibold">Quantity: </span>
                    <span class="font-light">{{ $item->quantity }}</span>
                  </p>
                  <p>
                    <span class="font-semibold">Price: </span>
                    <span class="font-light">@currency($item->price)</span>
                  </p>
                  <p>
                    <span class="font-semibold">Total: </span>
                    <span class="font-light">@currency($item->subtotal())</span>
                  </p>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>

        </table>

        <div class="mt-4 flex justify-between pb-4 border-b border-gray-200">

          <div>
            <img src="{{ $order->qr }}" height="150" width="150">
          </div>

          <table class="text-sm">
            <tr class="border-t border-gray-200">
              <td class="font-bold text-gray-600 py-2 px-6">Sub Total</td>
              <td>@currency($order->subtotal())</td>
            </tr>
            <tr class="border-t border-gray-200">
              <td class="font-bold text-gray-600 py-2 px-6">Shipping Cost</td>
              <td>@currency($order->shipping_fee)</td>
            </tr>
            <tr class="border-t border-gray-200">
              <td class="font-bold text-gray-600 py-2 px-6">Discount</td>
              <td>@currency(0)</td>
            </tr>
            <tr class="border-t border-gray-200">
              <td class="font-bold text-gray-600 py-2 px-6">Total</td>
              <td class="text-lg font-bold pr-2 text-gray-600">@currency($order->grandTotal())</td>
            </tr>
          </table>

        </div>

        <div class="mt-4 flex justify-end gap-4" x-data>
            @if($order->isCancellable())
            <button 
              @@click='$dispatch("open-modal", {
                action: @json(route('admin.orders.cancel', $order)),
                message: "Are you sure to cancel this order?"
              })'
              class="btn btn-red rounded"
            >Cancel Order</button>
            @endif

            @if(! $order->is_cancelled)
              @if($order->status === $status::PREPARING)
                <button 
                  @@click='$dispatch("open-modal", {
                    action: @json(route('admin.orders.ship', $order)),
                    message: "Are you sure that this order is shipped?"
                  })'
                  class="btn btn-primary rounded"
                >Ship Order</button>
              @elseif($order->status === $status::SHIPPED)
                <button 
                  @@click='$dispatch("open-modal", {
                    action: @json(route('admin.orders.deliver', $order)),
                    message: "Are you sure to deliver this order?"
                  })'
                  class="btn btn-primary rounded"
                >Deliver Order</button>
              @elseif($order->status === $status::DELIVERY)
                <button
                  @@click='$dispatch("open-modal", {
                    action: @json(route('admin.orders.complete', $order)),
                    message: "Are you sure that this order is completed?"
                  })' 
                  class="btn btn-primary rounded"
                >Complete Order</button>
              @endif
            @endif
        </div>

      </div>

    </div>
  </div>

  @push('modal')

    <div class="bg-white rounded w-1/4" @@click.outside="closeModal()">
      <div class="p-4 flex justify-between items-center border-b border-gray-200">
        <h4 class="text-gray-800 font-semibold">Confirm Action</h4>

        <button class="text-gray-600" @@click="closeModal()">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>

      </div>

      <form class="p-4" method="POST" :action="data?.action">
        @csrf
        @method('PATCH')
        <div class="text-center text-sm text-gray-800" x-text="data?.message"></div>

        <div class="mt-6 gap-4 flex items-center justify-center">

          <button type="button" class="text-blue-500" @@click="closeModal()">Cancel</button>
          <button type="submit" class="btn btn-primary rounded">Submit</button>

        </div>

      </form>

    </div>

  @endpush

</x-layouts.admin>