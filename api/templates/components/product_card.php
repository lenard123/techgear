
<div class="bg-white hover:shadow-2xl border border-gray-200 flex flex-row md:flex-col">

  <!-- Image -->
  <a href="<?= url("?page=product&id={$product->id}") ?>" class="flex-shrink-0 block w-2/5 md:w-full">
    <div class="w-full relative overflow-hidden" style="padding-top: 75%;">
      <img class="mx-auto h-full absolute top-0 left-0 right-0 botttom-0" src="<?= $product->getImage() ?>" />
    </div>
  </a>

  <div class="flex flex-col flex-grow p-4">
    
    <!-- Desc -->
    <div class="flex-grow pb-5">
      <a href="<?= url("?page=category&id={$product->category_id}")?>" class="block text-gray-500 text-sm"><?= __($product->getCategory()->name) ?></a>
      <a 
        href="<?= url("?page=product&id={$product->id}") ?>" 
        class="block text-gray-600 text-md leading-6 font-semibold hover:text-blue-500"><?= __($product->name) ?></a>
    </div>

    <!-- Price -->
    <div class="flex justify-between">
      <div>
        <span class="block text-gray-600 text-lg leading-6 font-semibold"><?= money($product->price) ?></span>
      </div>

      <?php if(App\Models\User::isUserCustomer()) : ?>
      <div class="flex">

        <?php if ($product->isFavorite()) : ?>
          <!-- Remove from favorites -->
          <form action="<?= url('?page=favorites') ?>" method="POST">
            <?= __method('DELETE') ?>
            <input type="hidden" name="product_id" value="<?= $product->id ?>">
            <button type="submit" class="text-red-500 my-auto">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
              </svg>
            </button>
          </form>
        <?php else : ?>
          <!-- Add to favorite -->
          <form action="<?= url('?page=favorites') ?>" method="POST">
            <input type="hidden" name="product_id" value="<?= $product->id ?>">
            <button type="submit" class="text-red-500 my-auto">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
              </svg>
            </button>
          </form>
        <?php endif; ?>

        <!-- Add to Cart -->
        <form action="<?= url('?page=cart') ?>" method="post">
          <?= __method("PUT") ?>
          <input type="hidden" name="product_id" value="<?= $product->id ?>"/>
          <button type="submit" class="ml-2 p-1 bg-blue-500 text-white rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>            
          </button>
        </form>
      </div>
      <?php endif; ?>
    </div>

  </div>

</div>
