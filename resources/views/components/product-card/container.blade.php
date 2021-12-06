<div class="py-5">
  <div class="container mx-auto sm:px-5">
    <h1 class="text-4xl font-bold text-center font-iceland text-gray-700">{{ $title }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 mt-8">

      @foreach ($products as $product)
      <x-product-card.item :product="$product" />
      @endforeach

    </div>

  </div>
</div>