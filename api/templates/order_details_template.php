<div class="bg-white shadow-lg rounded border-t-2 border-b-2 border-blue-500">

  <div class="py-5 px-8">
    <p class="text-lg text-blue-500 font-semibold mb-8">Purchase Receipt</p>
    <div class="grid grid-cols-4">
      <div class="col-span-3">
        <span class="block text-gray-500">Date</span>
        <span class="block text-gray-700 font-semibold"><?= toDate($order->created_at) ?></span>
      </div>

      <div>
        <span class="block text-gray-500">Order Id</span>
        <span class="block text-gray-700 font-semibold">#<?= str_pad($order->id, 7, "0", STR_PAD_LEFT) ?></span>
      </div>

    </div>
  </div>

  <div class="py-5 px-8 bg-gray-100">

    <?php foreach($items as $item) : ?>
      <div class="grid grid-cols-4 mb-4">
        <div class="col-span-3">

        <a href="<?= url("?page=product&id={$item->getProduct()->id}") ?>">
          <span class="font-light text-lg text-gray-500 hover:text-gray-700"><?= __($item->getProduct()->name) ?></span>
        </a>  
          <span class="block text-sm text-gray-500"><?= $item->quantity ?> × <?= money($item->price) ?></span>
        </div>
        <div class="text-lg font-light"><?= money($item->getSubtotal()) ?></div>
      </div>
    <?php endforeach; ?>

    <div class="grid grid-cols-4">
      <div class="col-span-3">
        <span class="font-light">Shipping</span>
      </div>
      <div class="text-lg font-light"><?= money($order->shipping_fee) ?></div>
    </div>
  </div>

  <div class="grid grid-cols-4 px-8 py-4">
    <div class="col-span-3"></div>
    <div class="font-semibold text-lg text-blue-500"><?= money($order->getTotalPrice()) ?></div>
  </div>

  <div class="px-8 pb-5">
    <div class="text-lg text-blue-500 font-semibold mb-4">Tracking Order</div>

    <div class="h-1 bg-gray-200 rounded relative">
      <div id="order-progress" class="absolute top-0 left-0 h-full bg-blue-500"></div>
      <div class="absolute flex w-full justify-between">
        <div id="order-status-<?= App\Models\Order::STATUS_PREPARING ?>" class="h-3 w-3 rounded-full -mt-1"></div>
        <div id="order-status-<?= App\Models\Order::STATUS_SHIPPED ?>" class="h-3 w-3 rounded-full -mt-1"></div>
        <div id="order-status-<?= App\Models\Order::STATUS_DELIVERY ?>" class="h-3 w-3 rounded-full -mt-1"></div>
        <div id="order-status-<?= App\Models\Order::STATUS_DELIVERED ?>" class="h-3 w-3 rounded-full -mt-1"></div>
      </div>
    </div>
    <div class="flex justify-between text-xs sm:text-sm text-gray-700 mb-4">
      <span>Preparing</span>
      <span>Shipped</span>
      <span>Out for Delivery</span>
      <span>Delivered</span>
    </div>

    <?php if ($order->status === App\Models\Order::STATUS_PREPARING) : ?>
    <div class="flex justify-end">
      <button class="bg-red-500 py-2 px-5 rounded text-white mt-4">
        Cancel Order
      </button>
    </div>
    <?php endif; ?>

  </div>

</div>
<div class="text-sm text-gray-500">Note: You can't can cancel an order once it is already shipped</div>
