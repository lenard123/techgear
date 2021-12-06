<div class="bg-white border border-gray-200 rounded shadow dark:bg-gray-900 dark:border-gray-700 hover:shadow-2xl flex flex-row md:flex-col">

  {{-- Image --}}
  <a href="#" class="flex-shrink-0 block w-2/5 md:w-full">
    <div class="ratio-4/3">
      <img src="{{ $product->image->url }}"/>
    </div>
  </a>

  {{-- Wrapper --}}
  <div class="flex flex-col flex-grow p-4">

    {{-- Description --}}
    <div class="flex-grow pb-5">
      <a href="{{ route('categories.show', $product->category) }}" class="block text-gray-500 text-sm">{{ $product->category->name }}</a>
      <a 
        href="#" 
        class="block text-gray-600 text-md leading-6 font-semibold hover:text-primary"
      >{{ $product->name }}</a>
    </div>

    {{-- Price --}}
    <div class="flex justify-between">
      <div>
        <span class="block text-gray-600 text-lg leading-6 font-semibold">@currency($product->price)</span>
      </div>


      @auth
      <div class="flex items-center">

        {{-- Add to favorite --}}
        <form action="{{ route('favorites.index') }}" method="POST">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <button type="submit" class="text-red-500 my-auto block">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
          </button>
        </form>

        <!-- Add to Cart -->
        <form 
          method="post" 
          action="{{ route('carts.store') }}"
          >
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <button type="submit" class="ml-2 p-1 bg-primary text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>            
          </button>
        </form>
      </div>
      @endauth


    </div>

  </div>{{-- End of Wrapper --}}

</div>
