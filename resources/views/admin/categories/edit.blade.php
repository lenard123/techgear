<x-layouts.admin :title="$category->name">

  <div class="p-4">
    <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded">

      <div class="py-3 px-4 border-b border-gray-200">
        <h1 class="text-gray-800 font-semibold">Category Information</h1>
      </div>

      <div class="p-4">
        <form action="{{ route('admin.categories.show', $category) }}" method="POST">

          @method('PUT')
          @csrf

          <x-input.text
            label-class="text-gray-800"
            input-class="simple-input-1"
            error-class="error"
            type="text"
            required
            label="Name"
            name="name"
            :value="$category->name"
          />

          <div class="flex justify-end mt-4">
            <button class="btn btn-primary rounded">Submit</button>
          </div>

        </form>
      </div>
    </div>
  </div>

</x-layouts.admin>