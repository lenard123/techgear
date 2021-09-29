<section class="p-6">
  <div class="flex justify-center lg:block items-center">
    <ul class="breadcrumbs flex text-lg sm:text-2xl text-gray-500">
      <li>Admin</li>
      <li>Categories</li>
    </ul>
  </div>
</section>

<header class="bg-white dark:bg-gray-900 p-6">
  <h1 class="text-3xl font-semibold leading-tight">Manage Categories</h1>
</header>

<main class="md:px-6 py-6">
  <div class="bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-700">
    <header class="flex items-center font-bold py-3 px-4">
      <span class="inline-flex justify-center items-center w-6 h-6 mr-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block" height="16" width="16" viewBox="0 0 512 512" fill="currentColor">
          <path d="M296 32h192c13.255 0 24 10.745 24 24v160c0 13.255-10.745 24-24 24H296c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24zm-80 0H24C10.745 32 0 42.745 0 56v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zM0 296v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm296 184h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H296c-13.255 0-24 10.745-24 24v160c0 13.255 10.745 24 24 24z"/>
        </svg>
      </span>
      <span>Categories</span>
    </header>

    <div class="hidden md:grid py-2 px-5 font-bold grid-cols-6 border-b border-gray-200 dark:border-gray-700">
      <p class="col-span-3">Name</p>
      <p>Products</p>
      <p>Created</p>
      <p class="text-right">Action</p>
    </div>

    <div class="table-rows dark:text-gray-300">
      <?php foreach($categories as $category) : ?>
        <div x-data="category" class="category-item py-2 px-5 grid hover:bg-gray-50 grid-cols-6 border-b border-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
          <div class="col-span-5 md:col-span-3">
            <template x-if="!isActive">
              <span><?= __($category->name) ?></span>
            </template>
            <template x-if="isActive">
              <form 
                method="POST" 
                action="<?= admin("?page=category&id={$category->id}") ?>"
                x-ref="editForm"
              >
                <?= __method('PATCH') ?>
                <input
                  class="rounded py-1 px-2 border border-gray-200 dark:bg-gray-900 dark:border-gray-700" 
                  type="text"
                  name="name"
                  value="<?= __($category->name) ?>"
                  required
                />
              </form>
            </template>
          </div>
          <p class="hidden md:block">
            <?php if ($category->getProductCount() > 0) : ?>
              <span><?= $category->getProductCount() ?> item(s)</span>
            <?php else : ?>
              <span>No products</span>
            <?php endif; ?>
          </p>
          <p class="hidden md:block">
            <span><?= toDate($category->created_at) ?></span>
          </p>
          <div class="flex items-start justify-end">

            <!-- Default Action Buttons -->
            <template x-if="!isActive">

                <!-- Open Edit Form -->
                <button
                  @click="openEditForm" 
                  class="mx-1 bg-blue-200 text-blue-500 p-1 rounded-full hover:text-white hover:bg-blue-500">
                  <span class="h-6 w-6 inline-flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block" height="16" width="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                  </span>
                </button>

            </template>

            <!-- Edit Action Buttons -->
            <template x-if="isActive">
              <div class="flex">
                <!-- Submit Form Button -->
                <button 
                  @click="submit"
                  class="mx-1 bg-green-200 text-green-500 p-1 rounded-full hover:text-white hover:bg-green-500"
                >
                  <span class="h-6 w-6 inline-flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                  </span>
                </button>

                <!-- Discard Changes Button -->
                <button
                  @click="close"
                  class="mx-1 bg-gray-200 text-gray-500 p-1 rounded-full hover:text-white hover:bg-gray-500"
                >
                  <span class="h-6 w-6 inline-flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                  </span>
                </button>
              </div>
            </template>

          </div>
        </div>
      <?php endforeach; ?>
    </div>



  </div>

</main>