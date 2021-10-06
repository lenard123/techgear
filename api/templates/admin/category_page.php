<section class="p-6">
  <div class="flex justify-center lg:block items-center">
    <ul class="breadcrumbs flex text-lg sm:text-2xl text-gray-500">
      <li>Admin</li>
      <li>Categories</li>
    </ul>
  </div>
</section>

<header class="admin-page-header">
  <h1 class="text-3xl font-semibold leading-tight">Manage Categories</h1>
</header>

<main class="md:px-6 py-6">
  <div class="admin-table">
    <header class="admin-table-header">
      <span class="inline-flex justify-center items-center w-6 h-6 mr-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block" height="16" width="16" viewBox="0 0 512 512" fill="currentColor">
          <path d="M296 32h192c13.255 0 24 10.745 24 24v160c0 13.255-10.745 24-24 24H296c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24zm-80 0H24C10.745 32 0 42.745 0 56v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zM0 296v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm296 184h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H296c-13.255 0-24 10.745-24 24v160c0 13.255 10.745 24 24 24z"/>
        </svg>
      </span>
      <span>Categories</span>
    </header>

    <div class="admin-table-column">
      <p class="col-span-6">Name</p>
      <p class="col-span-2">Products</p>
      <p class="col-span-2">Created</p>
      <p class="col-span-2 text-right">Action</p>
    </div>

    <div class="admin-table-body">
      <?php foreach($categories as $category) : ?>
        <div x-data="category" class="admin-table-row">
          <div class="flex items-center col-span-10 md:col-span-6">
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
          <p class="col-span-2 hidden md:flex items-center ">
            <?php if ($category->getProductCount() > 0) : ?>
              <span><?= $category->getProductCount() ?> item(s)</span>
            <?php else : ?>
              <span>No products</span>
            <?php endif; ?>
          </p>
          <p class="col-span-2 hidden md:flex items-center">
            <span><?= toDate($category->created_at) ?></span>
          </p>
          <div class="col-span-2 flex items-start justify-end">

            <!-- Default Action Buttons -->
            <template x-if="!isActive">

                <!-- Open Edit Form -->
                <button @click="openEditForm" class="btn-action-blue">
                  <?= icon('edit')->r() ?>
                </button>

            </template>

            <!-- Edit Action Buttons -->
            <template x-if="isActive">
              <div class="flex">
                <!-- Submit Form Button -->
                <button @click="submit" class="btn-action-green">
                  <?= icon('check')->r() ?>
                </button>

                <!-- Discard Changes Button -->
                <button @click="close" class="btn-action-default">
                  <?= icon('cancel')->r() ?>
                </button>
              </div>
            </template>

          </div>
        </div>
      <?php endforeach; ?>
    </div>



  </div>

</main>