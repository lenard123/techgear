<div class="card pb-2">

  <div class="p-5 border-b border-gray-200">
    <h1 class="text-4xl text-gray-800 font-semibold">Orders</h1>
  </div>

  <?php if (count($orders) <= 0) : ?>
    <div class="py-10 text-center">You don't have any orders</div>
  <?php endif; ?>

  <?php foreach($orders as $order) : ?>
  <div class="p-5 border-b border-gray-200">
    <div class="mb-3">
      <a href="<?= url("?page=order-details&id={$order->id}") ?>">
        <h2 class="text-xl inline hover:text-blue-500">#<?= str_pad($order->id, 7, "0", STR_PAD_LEFT) ?> </h2>
        <h4 class="text-sm text-gray-500 inline">from <?= toDate($order->created_at) ?></h4>
      </a>
    </div>

    <div class="grid grid-cols-12 border-b border-gray-200 py-3">
      <div class="col-span-4 text-gray-500">
        Items
      </div>
      <div class="col-span-8 text-gray-700">
        <?= $order->getTotalItemCount() ?>
      </div>
    </div>

    <div class="grid grid-cols-12 border-b border-gray-200 py-3">
      <div class="col-span-4 text-gray-500">
        Payment
      </div>
      <div class="col-span-8 text-gray-700">
        Cash on Delivery
      </div>
    </div>

    <div class="grid grid-cols-12 border-b border-gray-200 py-3">
      <div class="col-span-4 text-gray-500">
        Total
      </div>
      <div class="col-span-8 text-gray-700">
        <?= money($order->getTotalPrice()) ?>
      </div>
    </div>

    <div class="grid grid-cols-12 py-3">
      <div class="col-span-4 text-gray-500">
        Status
      </div>
      <div class="col-span-8 text-gray-700" x-data>

        <?php if ($order->status === App\Models\Order::STATUS_PREPARING) : ?>
        <span class="inline-block px-2 py-1 bg-blue-500 text-white text-sm" x-tooltip="We are still processing your order">PREPARING</span>

        <?php elseif($order->status === App\Models\Order::STATUS_SHIPPED) : ?>
        <span class="inline-block px-2 py-1 bg-purple-500 text-white text-sm" x-tooltip="Your order has been shipped">SHIPPED</span>  

        <?php elseif($order->status === App\Models\Order::STATUS_DELIVERY) : ?>
        <span class="inline-block px-2 py-1 bg-yellow-500 text-white text-sm" x-tooltip="Your is order is out for delivery. Please prepare the exact amount, thank you.">DELIVERY</span>

        <?php elseif($order->status === App\Models\Order::STATUS_DELIVERED) : ?>
        <span class="inline-block px-2 py-1 bg-green-500 text-white text-sm" x-tooltip="Your order has been delivered.">DELIVERED</span>

        <?php endif; ?>

      </div>
    </div>
  </div>
  <?php endforeach ?>

</div>