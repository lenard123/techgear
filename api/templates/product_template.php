<div class="py-5">
  <div class="container mx-auto sm:px-5">
    <h1 class="text-center mb-8"> 
      <span class="text-lg text-gray-500 my-auto mr-2">
        <a href="<?= url() ?>">Home</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </span>
      <span class="text-lg text-gray-500 my-auto mr-2">
        <a href="<?= url("?page=category&id={$product->category_id}") ?>"><?= __($product->getCategory()->name) ?></a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </span>
      <span class="block text-2xl">
        <?= __($product->name) ?>
      </span>
    </h1>

    <div class="flex flex-col lg:flex-row bg-white rounded shadow-lg">
      <div class="w-full lg:w-1/2 p-5">
        <div class="rounded border border-gray-200 w-full relative" style="padding-top:75%">
          <img 
            class="absolute top-0 h-full mx-auto left-0 right-0" 
            src="<?= $product->getImage() ?>" />
        </div>
      </div>
      <div class="w-full lg:w-1/2 p-5">
        <span class="block text-gray-600 mt-2 mb-5 text-4xl leading-6 font-semibold">
          <?= money($product->price) ?>
        </span>

        <div>
          <span class="text-gray-600">Category: </span>
          <span class="text-gray-800 font-semibold"><?= __($product->getCategory()->name) ?></span>
        </div>

        <div class="border-b pb-2 border-gray-200">
          <span class="text-gray-600">In Stock: </span>
          <span class="text-gray-800 font-semibold">
            <?= $product->quantity >= 1 ? $product->quantity : "Out of stock" ?>
          </span>
        </div>

        <p class="py-2 mb-5 border-b border-gray-200 text-gray-800 text-md">
          <?= __($product->getDescription()) ?>
        </p>

        <div>
          <?php if (!App\Models\User::isUserCustomer()) : ?>
            <a href="javascript:alert('You need to login first')" class="inline-block bg-blue-500 mb-2 text-white px-5 py-2 rounded hover:bg-blue-700">
              <span>Add To Cart</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </a>

            <a href="javascript:alert('You need to login first')" class="block text-red-400 text-sm">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
              </svg>
              <span>Add to favorites</span>
            </a>
          <?php else : ?>
            <form action="<?= url("?page=cart") ?>" method="POST">
              <?= __method("PUT") ?>
              <input type="hidden" name="product_id" value="<?= $product->id ?>"/>
              <button type="submit" class="inline-block bg-blue-500 mb-2 text-white px-5 py-2 rounded hover:bg-blue-700">
                <span>Add To Cart</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
              </button>
            </form>

            <?php if ($product->isFavorite()) : ?>
              <form action="<?= url("?page=favorites") ?>" method="POST">
                <?= __method("DELETE") ?>
                <input type="hidden" name="product_id" value="<?= $product->id ?>">
                <button type="submit" class="block text-red-400 text-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                  </svg>
                  <span>Remove from favorites</span>
                </button>
              </form>
            <?php else : ?>
              <form action="<?= url("?page=favorites") ?>" method="POST">
                <input type="hidden" name="product_id" value="<?= $product->id ?>">
                <button type="submit" class="block text-red-400 text-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                  </svg>
                  <span>Add to favorites</span>
                </button>
              </form>
            <?php endif; ?>

          <?php endif; ?>

        </div>

      </div>
    </div>

    <?php if (count($product->getRelatedProducts()) >= 3) : ?>
      <h1 class="text-2xl text-center my-8">Related Products</h1>

      <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4">
        <?php foreach($product->getRelatedProducts() as $rProduct) : ?>
          <?php (new ProductCardComponent($rProduct))->render() ?>
        <?php endforeach; ?>
      </div>

    <?php endif; ?>

  </div>
</div>
