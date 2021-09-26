<div class="slideshow relative w-full overflow-hidden" style="height: min(75vw, 75vh);">

  <?php foreach($slides as $slide) : ?>
  <div class="slides absolute h-full w-full">
    <img 
      class="object-cover absolute top-0 left-0 right-0 bottom-0 mx-auto h-full w-full"
      src="<?= $slide ?>"
      >
  </div>
  <?php endforeach; ?>

  <!-- Left Button -->
  <div class="absolute left-5 h-full">
    <div class="flex flex-col justify-center h-full">
      <a class="btn-left cursor-pointer text-gray-200 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </a>
    </div>
  </div>

  <!-- Right Button -->
  <div class="absolute right-5 h-full">
    <div class="flex flex-col justify-center h-full">
      <a class="btn-right cursor-pointer text-gray-200 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </a>
    </div>
  </div>  

  <!-- Indicator -->
  <div class="absolute w-full bottom-5">
    <ul class="flex justify-center">
      <?php foreach ($slides as $i => $slide) : ?>
      <li class="indicator cursor-pointer mx-1 h-3 w-3 rounded-full border border-white"><a href="#"></a></li>
      <?php endforeach; ?>
    </ul>
  </div>

</div>

<div class="py-5">
  <div class="container mx-auto sm:px-5">
    <h1 class="text-2xl text-center mb-8">Featured Products</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4">

      <?php foreach($product_cards as $card) : ?>
        <?= $card->render() ?>
      <?php endforeach; ?>

    </div>

  </div>
</div>
