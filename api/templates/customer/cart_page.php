<div class="py-5">

  <div class="container mx-auto sm:px-5">
    <h1 class="text-2xl  text-center mb-8">Shopping Cart</h1>

    <?php if (count($carts) <= 0) : ?>

      <div class="bg-white py-6 px-5 text-gray-600">
        <div class="text-center sm:text-left text-xl border-b border-gray-200 pb-5 mb-3">No Items in cart</div>
        <div class="text-sm">
          <a href="#">Shop Now</a>
        </div>
      </div>

    <?php else : ?>

      <div class="grid lg:grid-cols-12 gap-4 text-gray-500">

        <div class="lg:col-span-9">
          <div class="card overflow-hidden">
            
            <!-- Header -->
            <div class="hidden lg:grid grid-cols-2 text-center text-sm py-4 border-b border-gray-300">
              <div>PRODUCT</div>
              <div class="grid grid-cols-3">
                <div>PRICE</div>
                <div>QUANTITY</div>
                <div>SUM</div>
              </div>
            </div>

            <?php foreach($carts as $cart) : ?>
              <?= (new App\Components\CartCardComponent($cart))->render() ?>
            <?php endforeach; ?>

            <div class="flex justify-end p-5">
              <form action="<?= url('?page=cart') ?>" method="POST">
                <?= __method("DELETE") ?>
                <button type="submit" class="border border-gray-400 text-gray-400 px-5 py-2 rounded hover:shadow">
                  Clear Cart
                </button>
              </form>
            </div>

          </div>
        </div>

        <div class="lg:col-span-3">
          <div class="card px-5 py-6">
            <div class="flex justify-between mb-4">
              <span>Subtotal</span>
              <span class="text-gray-600"><?= money($subtotal) ?></span>
            </div>

            <div class="flex justify-between border-b border-gray-200 pb-4 mb-4">
              <span>Shipping Fee</span>
              <span class="text-gray-600"><?= money(config('app.shipping_fee')) ?></span>
            </div>

            <div class="flex justify-between mb-6">
              <span>Total</span>
              <span class="text-gray-800 font-semibold"><?= money($total) ?></span>
            </div>

            <a href="<?= url('?page=checkout') ?>" class="block w-full text-center py-2 rounded bg-blue-500 text-white hover:bg-blue-800 focus:outline-none my-1">Check out</a>

          </div>
        </div>
      </div>

    <?php endif; ?>

  </div>

</div>