<x-layouts.admin title="Add New Product">

  <form 
    class="py-8 px-6" 
    method="POST" 
    enctype="multipart/form-data" 
    action="{{ route('admin.products.create') }}"
    >

    @csrf

    <h1 class="font-semibold text-lg text-gray-800">Add New Product</h1>

    <div class="grid grid-cols-3 mt-6 gap-4">

      <div class="col-span-2 flex flex-col gap-4">
        <div class="bg-white shadow-lg rounded">
          <div class="py-3 px-4 border-b border-gray-200">
            <h2 class="text-gray-800 font-semibold">Product Information</h2>
          </div>

          <div class="px-4 py-5 text-gray-800">

            <x-input.text
              label="Product Name: "
              label-class="font-light text-sm"
              input-class="simple-input-1 mt-2"
              error-class="error"
              type="text"
              name="name"
              required
            />

            <div class="mt-4">
              <label class="font-light text-sm">Product Category: </label>
              <select class="simple-input-1 mt-2" required="" name="category_id">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected':'' }}>{{ $category->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="mt-4" x-data="{hasLimit: @json(old('max_order')?true:false)}">
              <div class="flex gap-5">
                <label class="font-light text-sm">Limit purchase: </label>
                <x-input.switch x-model="hasLimit"/>
              </div>

              <div class="mt-4" x-show="hasLimit" x-cloak>
                <x-input.text
                  label="Max Order: "
                  label-class="font-light text-sm"
                  input-class="simple-input-1"
                  min="0"
                  name="max_order"
                  type="number"
                />
              </div>

            </div>
          </div>
        </div>

        <div class="bg-white shadow-lg rounded">
          <div class="py-3 px-4 border-b border-gray-200">
            <h2 class="text-gray-800 font-semibold">Product Image</h2>
          </div>

          <div class="px-4 py-5 text-gray-800">

            <div class="flex gap-4">
              <div class="w-1/4">
                <p class="font-light text-sm">Thumbnail Image</p>
                <p class="font-light text-xs text-gray-700">(400x300)</p>
              </div>

              <div class="w-3/4" x-data="imagePreview(null)">
                <label class="flex rounded border border-gray-300 cursor-pointer">
                  <div class="py-2 px-3 text-gray-600 font-semibold bg-gray-200 text-sm border-r border-gray-300">Browse</div>
                  <div class="py-2 px-3 text-gray-600 text-sm font-semibold w-full">
                    <span x-show="source === null">Choose a file</span>
                    <span x-show="source !== null" x-cloak>1 image selected</span>
                  </div>
                  <input x-ref="input" type="file" name="image" class="opacity-0" @@change="imageChanged" accept="image/*">
                </label>

                <div class="w-1/3 mt-4" x-show="source !== null" x-cloak>
                  <div class="border border-gray-200 relative">

                    <div class="w-full relative" style="padding-top: 75%;">
                      <img 
                        :src="source" 
                        class="object-cover absolute top-0 left-0 h-full w-full"
                      />
                    </div>

                    <div class="p-3 border-t border-gray-100">
                      <p class="text-sm font-semibold" x-text="name"></p>
                      <p class="text-xs text-gray-500 font-semibold" x-text="sizeHumanReadable" ></p>
                    </div>

                    <button type="button" @@click="clearImage" class="absolute -right-3 -top-3 bg-gray-200 p-2 rounded-full text-red-500 shadow">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>

                  </div>
                </div>


                <p class="mt-1 font-light text-xs text-gray-700">This image is visible in all product box. Use 400x300 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive. </p>

              </div>

            </div>

          </div>
        </div>

        <div class="bg-white shadow-lg rounded">
          <div class="py-3 px-4 border-b border-gray-200">
            <h2 class="text-gray-800 font-semibold">Product Description</h2>
          </div>

          <div class="px-4 py-5 text-gray-800" x-data="tinymce('#productDescription')">
            <label class="font-light text-sm block mb-2">Description: </label>
            <textarea name="description" id="productDescription" x-cloak>{{ old('description') }}</textarea>
          </div>
        </div>
      </div>

      <div class="flex flex-col gap-4">
        <div class="bg-white rounded shadow-lg">

          <div class="py-3 px-4 border-b border-gray-200">
            <h2 class="text-gray-800 font-semibold">Featured</h2>
          </div>

          <div class="px-4 py-5 grid grid-cols-2">

            <label class="font-light text-sm">Status: </label>

            <x-input.switch name="is_featured" :checked="old('is_featured')"/>

          </div>

        </div>

        <div class="bg-white rounded shadow-lg">
          <div class="py-3 px-4 border-b border-gray-200">
            <h2 class="text-gray-800 font-semibold">Product Price +  Stock</h2>
          </div>
          <div class="px-4 py-5 text-gray-800">

            <x-input.text
              input-class="simple-input-1"
              error-class="error"
              label-class="font-light text-sm"
              name="price"
              label="Unit Price"
              type="number"
              min="0"
              step="0.01"
              required
            />

            <x-input.text
              class="mt-4"
              input-class="simple-input-1"
              label-class="font-light text-sm"
              error-class="error"
              name="quantity"
              label="Quantity"
              min="0"
              required
              type="number"
            />

          </div>
        </div>
      </div>

    </div>

    <div class="flex mt-4 gap-2">

      <button name="is_published" value="true" type="submit" class="btn btn-primary">Save and Published</button>
      <button type="submit" class="btn btn-yellow">Save and Unpublished</button>

    </div>

  </form>

  @push('scripts')
  <script src="https://cdn.tiny.cloud/1/orquwf4cjw6axvonhne86ri8ndnic5g0cx4bytrfxmz8dm1h/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  @endpush

</x-layouts.admin>