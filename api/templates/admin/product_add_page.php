<section class="p-6">
  <div class="flex justify-center lg:block items-center">
    <ul class="breadcrumbs flex text-lg sm:text-2xl text-gray-500">
      <li>Admin</li>
      <li>Product</li>
      <li>Add Product</li>
    </ul>
  </div>
</section>

<header class="bg-white p-6 dark:bg-gray-900">
  <h1 class="text-3xl font-semibold leading-tight">Add New Product</h1>
</header>

<main class="sm:px-6 py-6">
  <form action="<?= admin('?page=products-add') ?>" method="POST" />
    <div class="grid mb-6 gap-6 grid-cols-1 xl:grid-cols-3">
      
      <div class="xl:col-span-2">

        <!-- Product Info -->
        <div class="bg-white mb-6 border border-gray-200 rounded dark:bg-gray-900 dark:border-gray-700">
          <header class="font-semibold py-3 px-4 border-b border-gray-200 dark:border-gray-700">
            <span>Product Information</span>
          </header>
          <div class="p-6">

            <!-- Product Name -->
            <div class="grid md:grid-cols-12 gap-y-2 gap-x-5 mb-6">
              <div class="md:col-span-3">
                <label class="text-sm">
                  <span>Product Name: </span>
                  <span class="text-red-500">*</span>
                </label>
              </div>
              <div class="md:col-span-8">
                <input 
                  class="focus:outline-none focus:border-blue-500 text-gray-600 border border-gray-300 py-2 px-3 w-full rounded font-semibold dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-700 dark:text-gray-200"
                  type="text"
                  placeholder="Product name" 
                  name="name"
                  required="" 
                  value="Product 1"/>
              </div>
            </div>

            <!-- Product Category -->
            <div class="grid md:grid-cols-12 gap-y-2 gap-x-5 mb-6">
              <div class="md:col-span-3">
                <label class="text-sm">
                  <span>Category: </span>
                  <span class="text-red-500">*</span>
                </label>
              </div>
              <div class="md:col-span-8">
                <select
                  class="focus:outline-none focus:border-blue-500 text-gray-600 border border-gray-300 py-2 px-3 w-full rounded font-semibold dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-700 dark:text-gray-200"
                  name="category_id"
                  required="">
                  <option value="">-- Select Category --</option>
                  <?php foreach($categories as $category) : ?>
                    <option value="<?= $category->id ?>" <?= $category->id===1?'selected':''?>><?= __($category->name) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <!-- Product Max Order -->
            <div class="grid md:grid-cols-12 gap-y-2 gap-x-5">
              <div class="md:col-span-3">
                <label class="text-sm">
                  <span>
                    Limit Purchases:<span class="text-red-500">*</span>
                  </span>
                </label>
              </div>
              <div class="md:col-span-8">

              <label class="flex items-center cursor-pointer">
                <!-- toggle -->
                <div class="relative">
                  <!-- input -->
                  <input type="checkbox" id="toggleB" class="sr-only">
                  <!-- line -->
                  <div class="block bg-gray-200 w-10 h-6 rounded-full dark:bg-gray-800"></div>
                  <!-- dot -->
                  <div class="dot absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition"></div>
                </div>
              </label>

              </div>
            </div>

          </div>
        </div>

        <!-- Product Image -->
        <div class="bg-white mb-6 border border-gray-200 rounded dark:bg-gray-900 dark:border-gray-700">
          <header class="font-semibold py-3 px-4 border-b border-gray-200 dark:border-gray-700">
            <span>Product Image</span>
          </header>

          <div class="p-6">
            <div class="flex items-center justify-center w-full">
                <label class="flex flex-col w-full h-32 border-4 border-dashed hover:bg-gray-100 hover:border-gray-300 dark:hover:bg-gray-800 dark:hover:border-gray-600">
                    <div class="flex flex-col items-center justify-center pt-7">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-12 h-12 text-gray-400 group-hover:text-gray-600" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">
                            Select a photo</p>
                    </div>
                    <input type="file" name="image" class="opacity-0" />
                </label>
            </div>
          </div>
        </div>

        <!-- Product Description -->
        <div class="bg-white border border-gray-200 rounded dark:bg-gray-900 dark:border-gray-700">
          <header class="font-semibold py-3 px-4 border-b border-gray-200 dark:border-gray-700">
            <span>Product Description</span>
          </header>

          <div class="p-6">

            <div class="grid grid-cols-1 md:grid-cols-12 gap-y-2 gap-x-5">
              <div class="md:col-span-3">
                <label class="text-sm">
                  <span>Description: </span>
                  <span class="text-red-500">*</span>
                </label>
              </div>
              <div class="md:col-span-9 text-gray-900">
                <textarea id="editor"></textarea>
              </div>
            </div>

          </div>

        </div>
      </div>

      <div>

        <!-- Product Price + Stock -->
        <div class="bg-white mb-6 border border-gray-200 rounded dark:bg-gray-900 dark:border-gray-700">
          <header class="font-semibold py-3 px-4 border-b border-gray-200 dark:border-gray-700">
            <span>Product Price + Stock</span>
          </header>

          <div class="p-6">

            <div class="grid gap-y-2 mb-6">
              <div class="md:col-span-3">
                <label class="text-sm">
                  <span>Unit Price: </span>
                  <span class="text-red-500">*</span>
                </label>
              </div>
              <div class="md:col-span-8">
                <input 
                  class="focus:outline-none focus:border-blue-500 text-gray-600 border border-gray-300 py-2 px-3 w-full rounded font-semibold dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-700 dark:text-gray-200"
                  type="number"
                  placeholder="price" 
                  name="price"
                  value="500" 
                  required="" />
              </div>
            </div>

            <div class="grid gap-y-2 mb-6">
              <div class="md:col-span-3">
                <label class="text-sm">
                  <span>Quantity: </span>
                  <span class="text-red-500">*</span>
                </label>
              </div>
              <div class="md:col-span-8">
                <input 
                  class="focus:outline-none focus:border-blue-500 text-gray-600 border border-gray-300 py-2 px-3 w-full rounded font-semibold dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-700 dark:text-gray-200"
                  type="number"
                  placeholder="Quantity" 
                  name="quantity"
                  value="46" 
                  required="" />
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

    <div>
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-5 rounded text-lg">
        Save Product
      </button>
    </div>
  </form>
</main>