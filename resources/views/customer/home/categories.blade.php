<div class="hidden lg:block py-5">
  <div class="container mx-auto sm:px-5">
    <h1 class="text-4xl font-bold text-center font-iceland text-gray-700">Categories</h1>

    <ul class="flex justify-center gap-3 flex-wrap mt-8">
      @foreach($categories as $category)
      <li>
        <a 
          class="py-2 px-5 rounded-full block | bg-gray-200 hover:bg-gray-300 | text-gray-700" 
          href="{{ route('categories.show', $category) }}"
        >{{ $category->name }}</a>
      </li>
      @endforeach
    </ul>

  </div>
</div>
