<x-layouts.customer :title="$product->name">
  <div class="py-5 container mx-auto sm:px-5">
    <div class="bg-white grid grid-cols-12 p-4 shadow">
      <div class="col-span-4">
        <div class="ratio-4/3">
          <img src="{{ $product->imageUrl }}" />
        </div>
      </div>
      <div class="col-span-8 px-8">

        <div class="pb-5  border-b border-gray-200">
          <h1 class="text-3xl text-gray-700">{{ $product->name }}</h1>
          <h4 class="text-gray-600">{{ $product->category->name }}</h4>
        </div>

        <div class="py-5 border-b border-gray-200">
          <h3 class="font-bold text-gray-700 text-xl">@currency($product->price)</h3>
          <div class="unreset mt-5 text-gray-700">
            {!! $product->description !!}
          </div>
        </div>

        <div class="flex justify-between mt-5">
          <form action="{{ route('favorites.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="btn btn-outline-pink rounded">Add to Favorites</button>
          </form>
          <form action="{{ route('carts.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="btn btn-primary rounded">Add to Cart</button>
          </form>
        </div>

      </div>
    </div>
  </div>
</x-layouts.customer>