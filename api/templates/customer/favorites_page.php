<div class="bg-white rounded shadow-lg">

  <div class="p-5 border-b border-gray-200">
    <h1 class="text-4xl text-gray-800 font-semibold">Favorites</h1>
  </div>

  <?php if (count($favorites) <= 0) : ?>
    <div class="py-10 text-center">You don't have any product added to favorites</div>
  <?php endif; ?>

  <?php foreach($favorites as $favorite) : ?>
  <div class="border-b border-gray-200 flex">

    <div class="flex-shrink-0 w-1/3 lg:w-1/4 py-2">
      <div class="ratio-4/3">
        <img src="<?= $favorite->getProduct()->getImage() ?>"/>
      </div>
    </div>

    <div class="flex flex-col justify-between p-5 w-full lg:w-6/12">
      <div class="pb-5">
        <div class="text-gray-500 text-sm"><?= __($favorite->getProduct()->getCategory()->name) ?></div>
        <a href="<?= url("?page=product&id={$favorite->product_id}") ?>" class="text-gray-600 hover:text-blue-500 text-md leading-6 font-semibold">
          <?= __($favorite->getProduct()->name) ?>
        </a>
      </div>
      <div class="flex justify-between lg:hidden">
        <div class="text-gray-500 text-xl leading-6">
          <?= money($favorite->getProduct()->price) ?>
        </div>
        <div class="flex">
          <!-- Remove from favorites -->
          <form action="<?= url('?page=favorites') ?>" class="my-auto" method="POST">
            <?= __method('DELETE') ?>
            <input type="hidden" name="product_id" value="<?= $favorite->product_id ?>">
            <button type="submit" class="text-red-500 my-auto">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
              </svg>
            </button>
          </form>

          <!-- Add to Cart -->
          <form action="<?= url('?page=cart') ?>" class="my-auto" method="post">
            <?= __method("PUT") ?>
            <input type="hidden" name="product_id" value="<?= $favorite->product_id ?>"/>
            <button type="submit" class="ml-2 p-1 bg-blue-500 text-white rounded-full">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>            
            </button>
          </form>
        </div>
      </div>
    </div>

    <div class="hidden lg:block px-5 my-5 w-1/4 border-l border-gray-200">
      <div class="text-gray-500 text-2xl leading-6 mb-3">
        <?= money($favorite->getProduct()->price) ?>
      </div>
            <!-- Add to Cart -->
      <form action="<?= url('?page=cart') ?>" method="post">
        <?= __method("PUT") ?>
        <input type="hidden" name="product_id" value="<?= $favorite->product_id ?>"/>
        <button type="submit" class="mb-2 bg-blue-500 text-white w-full py-2 rounded hover:bg-blue-700">
          ADD TO CART
        </button>
      </form>
      <form action="<?= url('?page=favorites') ?>" method="POST">
        <?= __method('DELETE') ?>
        <input type="hidden" name="product_id" value="<?= $favorite->product_id ?>">
        <button type="submit" class="text-red-400 text-sm">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
          </svg>
          <span>Remove from favorites</span>
        </button>
      </form>
    </div>
  </div>
  <?php endforeach; ?>

</div>