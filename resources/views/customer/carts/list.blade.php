<div class="bg-white rounded shadow">
  <div class="hidden lg:grid grid-cols-2 text-center text-sm py-4 border-b border-gray-300">
    <div>PRODUCT</div>
    <div class="grid grid-cols-3">
      <div>PRICE</div>
      <div>QUANTITY</div>
      <div>SUM</div>
    </div>
  </div>

  @foreach($cartsData->items as $cart)
  <x-cart-card :cart="$cart" />
  @endforeach

  <div class="flex justify-end p-5">
    <form action="{{ route('carts.clear') }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="border border-gray-400 text-gray-400 px-5 py-2 rounded hover:shadow">
        Clear Cart
      </button>
    </form>
  </div>
</div>