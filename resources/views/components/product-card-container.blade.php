<div class="py-5">
  <div class="container mx-auto sm:px-5">
    <h1 class="text-2xl text-center mb-8">Featured Products</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4">

      @foreach ($products as $product)
      <x-product-card :product="$product" />
      @endforeach

    </div>

  </div>
</div>