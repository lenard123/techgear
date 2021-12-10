<x-layouts.admin title="Manage Products">

  <div class="py-8 px-6">

    <div class="flex justify-between items-center">
      <h1 class="font-semibold text-lg text-gray-800">Manage Products</h1>
      <a href="{{ route('admin.products.create') }}" class="btn btn-primary rounded-full">Add New Product</a>
    </div>

    <div class="mt-6 bg-white rounded shadow-lg">
      <div class="p-4 border-b border-gray-200">
        <span class="font-semibold text-lg text-gray-800">All Products</span>
      </div>

      <div class="p-4">

        <div class="grid grid-cols-12 border-b border-gray-200 p-4 gap-4">
          <span class="font-semibold text-sm col-span-5">Name</span>
          <span class="font-semibold text-sm col-span-3">Info</span>
          <span class="font-semibold text-sm col-span-2">Status</span>
          <span class="font-semibold text-sm col-span-2 text-right">Options</span>
        </div>

        @foreach($products as $product)
        <div class="grid grid-cols-12 border-b border-gray-200 p-4 text-sm gap-2">

          <div class="col-span-5 grid grid-cols-5 gap-2">
            <div class="col-span-1">
              <div class="w-full relative" style="padding-top: 75%;">
                <img 
                  src="{{ $product->imageUrl }}" 
                  class="object-cover absolute top-0 left-0 h-full w-full"
                />
              </div>
            </div>
            <p class="col-span-4 text-gray-700">{{ $product->name }}</p>
          </div>

          <div class="col-span-3 flex flex-col text-gray-800">
            <p>
              <span class="font-semibold">Price: </span>
              <span>@currency($product->price)</span>
            </p>
            <p>
              <span class="font-semibold">Category: </span>
              <span>{{ $product->category->name }}</span>
            </p>
            <p>
              <span class="font-semibold">Stocks: </span>
              <span>{{ $product->quantity }}</span>
            </p>
          </div>

          <div class="col-span-2 flex flex-wrap gap-y-1 gap-x-2">

            @if($product->is_featured)
            <span class="bg-pink-500 text-xs text-gray-100 py-1 px-2 rounded-full font-semibold self-start">Featured</span>
            @endif

            @if($product->is_published)
              <span class="bg-green-500 text-xs text-gray-100 py-1 px-2 rounded-full font-semibold self-start">Published</span>
            @else
              <span class="bg-yellow-500 text-xs text-gray-100 py-1 px-2 rounded-full font-semibold self-start">Unpublished</span>
            @endif

            @if($product->quantity <= 0)
              <span class="bg-red-500 text-xs text-gray-100 py-1 px-2 rounded-full font-semibold self-start">Out of stock</span>
            @endif
          </div>

          <div class="col-span-2">
            <div class=" flex gap-2 justify-end">
              <a href="{{ route('admin.products.show', $product) }}" class="border border-blue-200 bg-blue-100 p-2 rounded-full text-blue-400 hover:bg-blue-400 hover:text-white hover:border-blue-400 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
              </a>

              <button x-data @@click='$dispatch("open-modal", @json(route('admin.products.delete', $product)))' class="border border-red-200 bg-red-100 p-2 rounded-full text-red-400 hover:bg-red-400 hover:text-white hover:border-red-400 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </button>
            </div>
          </div>

        </div>
        @endforeach

      </div>

      <div class="py-4 px-8">
        {{ $products->links() }}
      </div>

    </div>

  </div>

  @push('modal')

    <div class="bg-white rounded w-1/4" @@click.outside="closeModal()">
      <div class="p-4 flex justify-between items-center border-b border-gray-200">
        <h4 class="text-gray-800 font-semibold">Delete Confirmation</h4>

        <button class="text-gray-600" @@click="closeModal()">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>

      </div>

      <form class="p-4" method="POST" :action="data">
        @csrf
        @method('DELETE')
        <div class="text-center text-sm text-gray-800">Are you sure to delete this?</div>

        <div class="mt-6 gap-4 flex items-center justify-center">

          <button type="button" class="text-blue-500" @@click="closeModal()">Cancel</button>
          <button type="submit" class="btn btn-primary rounded">Delete</button>

        </div>

      </form>

    </div>

  @endpush

</x-layouts.admin>
