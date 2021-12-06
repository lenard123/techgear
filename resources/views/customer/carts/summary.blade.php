<div class="bg-white shadow rounded px-5 py-6">
  <div class="flex justify-between mb-4">
    <span>Subtotal</span>
    <span class="text-gray-600">@currency($cartsData->subtotal)</span>
  </div>

  <div class="flex justify-between border-b border-gray-200 pb-4 mb-4">
    <span>Shipping Fee</span>
    <span class="text-gray-600">@currency($cartsData->shippingFee)</span>
  </div>

  <div class="flex justify-between mb-6">
    <span>Total</span>
    <span class="text-gray-800 font-semibold">@currency($cartsData->total)</span>
  </div>

  <a href="{{ route('checkout') }}" class="btn btn-primary rounded  text-center my-1 block">Check out</a>

</div>