<section class="p-6">
  <div class="flex justify-center lg:block items-center">
    <ul class="breadcrumbs flex text-lg sm:text-2xl text-gray-500">
      <li>Admin</li>
      <li>Product</li>
      <li>Manage Products</li>
    </ul>
  </div>
</section>

<header class="admin-page-header">
  <h1>Manage Products</h1>
</header>

<main class="md:px-6 py-6">

  <div class="admin-table">

    <header class="admin-table-header">
      <span class="inline-flex justify-center items-center w-6 h-6 mr-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block" height="16" width="16" viewBox="0 0 512 512" fill="currentColor">
          <path d="M296 32h192c13.255 0 24 10.745 24 24v160c0 13.255-10.745 24-24 24H296c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24zm-80 0H24C10.745 32 0 42.745 0 56v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zM0 296v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm296 184h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H296c-13.255 0-24 10.745-24 24v160c0 13.255 10.745 24 24 24z"/>
        </svg>
      </span>
      <span>All Products</span>
    </header>

    <div class="admin-table-column">
      <p class="col-span-5">Name</p>
      <p class="col-span-3">Info</p>
      <p class="col-span-2">Stocks</p>
      <p class="col-span-2 text-right px-1">Actions</p>
    </div>

    <div class="admin-table-body">
      <?php foreach($products as $product) : ?>
        <div class="admin-table-row text-sm">
          <div class="col-span-5">

            <!-- First Column -->
            <div class="grid grid-cols-4">

              <!-- Image -->
              <div class="ratio-4/3 bg-gray-200 rounded border border-gray-300">
                <img src="<?= $product->getImage() ?>" />
              </div>

              <!-- Product name -->
              <p class="col-span-3 px-4"><?= __($product->name) ?></p>
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
            <button class="btn-action-blue">
              <?= icon('edit')->r() ?>
            </button>

            <a 
              href="<?= url("?page=product&id={$product->id}") ?>" 
              target="_blank" 
              class="btn-action-green"
              ><?= icon('view')->r() ?>
            </a>

          </div>

        </div>
      <?php endforeach; ?>
    </div>

  </div>

</main>
