<section class="p-6">
  <div class="flex justify-center lg:block items-center">
    <ul class="breadcrumbs flex text-lg sm:text-2xl text-gray-500">
      <li>Admin</li>
      <li>Product</li>
      <li>Manage Products</li>
    </ul>
  </div>
</section>

<header class="bg-white dark:bg-gray-900 p-6">
  <h1 class="text-3xl font-semibold leading-tight">Manage Products</h1>
</header>

<main class="md:px-6 py-6">

  <div class="bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-700">

    <header class="flex items-center font-bold py-3 px-4">
      <span class="inline-flex justify-center items-center w-6 h-6 mr-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block" height="16" width="16" viewBox="0 0 512 512" fill="currentColor">
          <path d="M296 32h192c13.255 0 24 10.745 24 24v160c0 13.255-10.745 24-24 24H296c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24zm-80 0H24C10.745 32 0 42.745 0 56v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zM0 296v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm296 184h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H296c-13.255 0-24 10.745-24 24v160c0 13.255 10.745 24 24 24z"/>
        </svg>
      </span>
      <span>All Products</span>
    </header>

    <div class="hidden md:grid text-sm py-2 px-5 font-bold grid-cols-12 border-b border-gray-200 dark:border-gray-700">
      <p class="col-span-5">Name</p>
      <p class="col-span-3">Info</p>
      <p class="col-span-2">Stocks</p>
      <p class="col-span-2 text-right px-1">Actions</p>
    </div>

    <div class="table-rows dark:text-gray-300">
      <?php foreach($products as $product) : ?>
        <div class="py-4 px-5 text-sm grid grid-cols-12 border-b border-gray-200 hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800">
          <div class="col-span-5">
            <div class="flex">
              <img 
                class="w-1/4 h-auto border border-gray-200 rounded"
                src="<?= $product->getImage() ?>"/>
              <span class="w-full px-4"><?= __($product->name) ?></span>
            </div>
          </div>

          <div class="flex flex-col col-span-3">
            <p>
              <span class="font-bold">Num. of Sale: </span>
              <span>No data</span>
            </p>
            <p>
              <span class="font-bold">Price: </span>
              <span><?= money($product->price) ?></span>
            </p>
            <p>
              <span class="font-bold">Category: </span>
              <span><?= __($product->getCategory()->name) ?></span>
            </p>
          </div>

          <div class="col-span-2">
            <?php if($product->quantity == 0) : ?>
              <span>Out of Stock</span>
            <?php elseif ($product->quantity == 1) : ?>
              <span>1 item left</span>
            <?php else : ?>
              <span><?= $product->quantity ?> items
            <?php endif; ?>
          </div>

          <div class="flex col-span-2 justify-end items-start">
            <button
              class="mx-1 bg-blue-200 text-blue-500 p-1 rounded-full hover:text-white hover:bg-blue-500">
              <span class="h-6 w-6 inline-flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block" height="16" width="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
              </span>
            </button>

            <a
              href="<?= url("?page=product&id={$product->id}") ?>" target="_blank"
              class="mx-1 bg-green-200 text-green-500 p-1 rounded-full hover:text-white hover:bg-green-500">
              <span class="h-6 w-6 inline-flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block" height="16" width="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
              </span>
            </a>

          </div>

        </div>
      <?php endforeach; ?>
    </div>

  </div>

</main>
