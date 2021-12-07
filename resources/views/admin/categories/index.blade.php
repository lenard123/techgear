<x-layouts.admin title="Manage Categories">
  <div class="py-8 px-6">

    <div class="flex justify-between items-center">
      <h1 class="font-semibold text-lg text-gray-800">All Categories</h1>
      <a href="{{ route('admin.categories.create') }}" class="btn btn-primary rounded-full">Add New Category</a>
    </div>

    <div class="mt-6 bg-white rounded shadow-lg">

      <div class="p-4 border-b border-gray-200">
        <span class="font-semibold text-lg text-gray-800">Categories</span>
      </div>

      <div class="p-4">

        <div class="flex justify-between border-b border-gray-200 p-4">
          <span class="font-semibold text-sm ml-6">Name</span>
          <span class="font-semibold text-sm">Options</span>
        </div>

        @foreach($categories as $category)

          <div class="flex justify-between border-b border-gray-200 p-4 items-center">
            <div class="flex items-center gap-2">
              <form action="{{ route('admin.categories.featured', $category) }}" method="POST">
                @csrf
                @method('PATCH')
                <button 
                  type="submit"
                  @if ($category->is_featured) class="text-yellow-500 hover:text-yellow-600 flex" @endif
                  @if (! $category->is_featured) class="text-gray-700 hover:text-gray-800 flex" @endif
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                  </svg>
                </button>
              </form>
              <span class="text-sm text-gray-800">{{ $category->name }}</span>
            </div>
            <div class="flex gap-2">
              
              <a href="{{ route('admin.categories.show', $category) }}" class="border border-blue-200 bg-blue-100 p-2 rounded-full text-blue-400 hover:bg-blue-400 hover:text-white hover:border-blue-400 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
              </a>

              <a x-data @@click='$dispatch("open-modal", @json(route('admin.categories.show', $category)))' href="#" class="border border-red-200 bg-red-100 p-2 rounded-full text-red-400 hover:bg-red-400 hover:text-white hover:border-red-400 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </a>

            </div>
          </div>

        @endforeach

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