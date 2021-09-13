
<div class="py-5">
  <div class="container mx-auto sm:px-5">
    <h1 class="flex justify-center"> 
      <span class="text-lg text-gray-500 my-auto mr-2">
        <?= __($subcategory->getCategory()->name) ?>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </span>
      <span class="text-2xl">
        <?= __($subcategory->name) ?>
      </span>
    </h1>
    <h2 class="text-center mb-8 text-gray-500"><?= count($products) ?> items</h2>

    <?php if (count($products) < 1) : ?>
      <div class="text-4xl text-center sm:text-left">No item available</div>
    <?php endif;?>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4">

      <?php foreach($products as $product) : ?>
        <?php (new ProductCardComponent($product))->render() ?>
      <?php endforeach ?>

    </div>

  </div>
</div>
