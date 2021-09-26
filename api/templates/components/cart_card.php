
<div class="grid lg:grid-cols-2 border-b border-gray-200">

  <div class="flex">
    <div class="flex-shrink-0 w-1/3 p-1">
      <div class="w-full relative overflow-hidden" style="padding-top: 75%;">
        <img class="mx-auto h-full absolute top-0 left-0 right-0 botttom-0" src="<?= $cart->getProduct()->getImage() ?>" />
      </div>
    </div>
    <div class="flex-grow px-2 py-4">
      <div class="text-sm text-gray-500"><?= __($cart->getProduct()->getCategory()->name) ?></div>
      <a href="<?= url("?page=product&id={$cart->product_id}") ?>" class="text-md text-gray-600 hover:text-blue-500 leading-6 font-semibold"><?= __($cart->getProduct()->name) ?></a>
    </div>
  </div>

  <div class="flex py-4">
    <div class="flex-shrink-0 w-1/3 self-center text-center">
      <div class="lg:hidden text-gray-500 text-md">PRICE</div>
      <div class="text-center text-gray-600 text-lg leading-6"><?= money($cart->getProduct()->price) ?></div>
    </div>
    
    <div class="flex-shrink-0 w-1/3 self-center">
      
      <div class="flex justify-center">

        <!-- Minus -->
        <form action="<?= url('?page=cart') ?>" method="POST">
          <?= __method("PATCH") ?>
          <input type="hidden" name="id" value="<?= $cart->id ?>" />
          <input type="hidden" name="action" value="SUBTRACT" />
          <button type="submit" class="p-2 border-t border-l border-b border-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
            </svg>
          </button>
        </form>

        <div class="p-2 border-t border-b border-gray-200"><?= $cart->quantity ?></div>

        <!-- Plus -->
        <form action="<?= url('?page=cart') ?>" method="POST">
          <?= __method("PATCH") ?>
          <input type="hidden" name="id" value="<?= $cart->id ?>" />
          <input type="hidden" name="action" value="ADD" />
          <button type="submit" href="#" class="p-2 border-t border-r border-b border-gray-200 <?= !$cart->canStillAdd() ? 'bg-gray-50' : '' ?>" <?= !$cart->canStillAdd() ? 'disabled' : '' ?>>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
          </button>
        </form>
      </div>

    </div>
    <div class="self-center flex-shrink-0 w-1/3 text-center">
      <div class="lg:hidden text0gray-500 text-md">SUM</div>
      <div class="text-gray-600 text-lg leading-6"><?= money($cart->getSubtotal()) ?></div>
    </div>
  </div>
</div>
