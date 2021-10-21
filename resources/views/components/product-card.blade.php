<div class="bg-white border border-gray-200 rounded shadow dark:bg-gray-900 dark:border-gray-700 hover:shadow-2xl flex flex-row md:flex-col">

  {{-- Image --}}
  <a href="#" class="flex-shrink-0 block w-2/5 md:w-full">
    <div class="ratio-4/3">
      <img src="{{ $product->imageUrl() }}"/>
    </div>
  </a>

  {{-- Wrapper --}}
  <div class="flex flex-col flex-grow p-4">

    {{-- Description --}}
    <div class="flex-grow pb-5">
      <a href="#" class="block text-gray-500 text-sm">{{ $product->category->name }}</a>
      <a 
        href="#" 
        class="block text-gray-600 text-md leading-6 font-semibold hover:text-blue-500"
      >{{ $product->name }}</a>
    </div>

    {{-- Price --}}
    <div class="flex justify-between">
      <div>
        <span class="block text-gray-600 text-lg leading-6 font-semibold">{{ $product->price }}</span>
      </div>
    </div>

  </div>{{-- End of Wrapper --}}

</div>
