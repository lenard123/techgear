<div class="py-5">
  <div class="container mx-auto sm:px-5">
    <div class="flex justify-center text-lg">
      <span class="text-gray-500 mr-2">Search Results for:</span>
      <span><?= __($query) ?></span>
    </div>
    <span class="block text-center mb-8 text-gray-500"><?= count($result) ?> result</span>

    <?php if (count($result) <= 0) : ?>
      <div class="text-4xl text-center sm:text-left">No Products found</div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4">
      <?php foreach ($result as $product) : ?>
        <?php (new App\Components\ProductCardComponent($product))->render() ?>
      <?php endforeach; ?>
    </div>

  </div>
</div>