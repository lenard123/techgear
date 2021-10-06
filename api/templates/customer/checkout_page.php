
<div class="py-5">
  <div class="container mx-auto sm:px-5">
    <h1 class="flex justify-center mb-8">
      <a href="<?= url('?page=cart') ?>" class="text-lg text-gray-500 my-auto mr-2">
        Shopping Cart
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </a>
      <span class="text-2xl">Check Out</span>
    </h1>

    <form action="<?= url('?page=checkout') ?>" method="post">
      <div class="grid lg:grid-cols-12 gap-4 text-gray-500">

        <div class="lg:col-span-9">
          <!-- Contact Info -->
          <p class="text-center sm:text-left text-xl sm:text-2xl mb-4 font-semibold">
            <span class="text-gray-400">1. </span>
            <span class="text-gray-700">Contact Information</span>
          </p>

          <div class="checkout-form-group">

            <div class="grid lg:grid-cols-2 gap-5 mb-5">
              <div class="text-gray-800">
                <label class="text-sm block mb-1">Recipient Firstname: </label>
                <input 
                  type="text" 
                  name="recipient_firstname" 
                  class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none"
                  value="<?= $validator->getValue('recipient_firstname') ?? $user->firstname ?>"
                  required 
                />
                <?php if($validator->isNotValid('recipient_firstname')) : ?>
                  <span class="text-red-500 text-sm">
                    <?= $validator->getMessage('recipient_firstname') ?>
                  </span>
                <?php endif; ?>
              </div>

              <div class="text-gray-800">
                <label class="text-sm block mb-1">Recipient Lastname: </label>
                <input 
                  type="text" 
                  name="recipient_lastname" 
                  class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none"
                  value="<?= $validator->getValue('recipient_lastname') ?? $user->lastname ?>"
                  required 
                />
                <?php if($validator->isNotValid('recipient_lastname')) : ?>
                  <span class="text-red-500 text-sm">
                    <?= $validator->getMessage('recipient_lastname') ?>
                  </span>
                <?php endif; ?>
              </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-5">
              <div class="text-gray-800">
                <label class="text-sm block mb-1">Phone: </label>
                <input 
                  type="text" 
                  name="phone" 
                  class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none"
                  value="<?= $validator->getValue('phone') ?? $user_info->phone ?>"
                  required 
                />
                <?php if($validator->isNotValid('phone')) : ?>
                  <span class="text-red-500 text-sm">
                    <?= $validator->getMessage('phone') ?>
                  </span>
                <?php endif; ?>
              </div>

              <div class="text-gray-800">
                <label class="text-sm block mb-1">Email: </label>
                <input 
                  type="email" 
                  name="email" 
                  class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none"
                  value="<?= $validator->getValue('email') ?? $user->email ?>" 
                  required
                />
                <?php if($validator->isNotValid('email')) : ?>
                  <span class="text-red-500 text-sm">
                    <?= $validator->getMessage('email') ?>
                  </span>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <!-- Address -->
          <p class="text-center sm:text-left text-xl sm:text-2xl mb-4 font-semibold">
            <span class="text-gray-400">2. </span>
            <span class="text-gray-700">Address</span>
          </p>

          <div 
            class="checkout-form-group"
            x-data="address"
           >

            <div class="text-gray-800 mb-5">
              <label class="text-sm block mb-1">Region: </label>
              <select 
                class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none" 
                x-model="selected_region"
                name="region"
                required="" 
              >
                <option value="">-- Select Region --</option>
                <?php foreach ($regions as $key => $value) : ?>
                  <option value="<?= __($key) ?>"><?= __($value) ?></option>
                <?php endforeach ?>
              </select>
            </div>

            <div class="grid lg:grid-cols-3 gap-5 mb-5">

              <div class="text-gray-800">
                <label class="text-sm block mb-1">Province: </label>
                <select 
                  class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none" 
                  :disabled="provinces.length <= 0" 
                  x-model="selected_province"
                  required=""
                  name="province"
                >
                  <option value="">-- Select a province --</option>
                  <template 
                    x-for="province in provinces" 
                    :key="province">
                    <option x-text="province"></option>
                  </template>
                </select>
              </div>

              <div class="text-gray-800">
                <label class="text-sm block mb-1">City: </label>
                <select 
                  class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none" 
                  x-model="selected_municipality"
                  :disabled="municipalities.length <= 0" 
                  required=""
                  name="municipality"
                >
                  <option value="">-- Select a City --</option>
                  <template
                    x-for="city in municipalities"
                    :key="city"
                  >
                    <option x-text="city"></option>
                  </template>
                </select>
              </div>

              <div class="text-gray-800">
                <label class="text-sm block mb-1">Barangay: </label>
                <select 
                  class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none" 
                  :disabled="barangay_list.length <= 0" 
                  x-model="selected_barangay"
                  required=""
                  name="barangay" 
                >
                  <option value="">-- Select Barangay --</option>
                  <template
                    x-for="barangay in barangay_list"
                    :key="barangay"
                  >
                    <option x-text="barangay"></option>
                  </template>
                </select>
              </div>
            </div>

            <div class="grid lg:grid-cols-12 gap-5">

              <div class="lg:col-span-7 text-gray-800">
                <label class="text-sm block mb-1">Street/Building Name: </label>
                <input 
                  type="text" 
                  name="street" 
                  class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none"
                  required=""
                  value="<?= $validator->getValue('street') ?? $user_info->street ?>" 
                />
                <?php if($validator->isNotValid('street')) : ?>
                  <span class="text-red-500 text-sm">
                    <?= $validator->getMessage('street') ?>
                  </span>
                <?php endif; ?>
              </div>

              <div class="lg:col-span-5 text-gray-800">
                <label class="text-sm block mb-1">House#/Unit/Floor: </label>
                <input 
                  type="text" 
                  name="unit" 
                  class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none"
                  required="" 
                  value="<?= $validator->getValue('unit') ?? $user_info->unit ?>"
                />
                <?php if($validator->isNotValid('unit')) : ?>
                  <span class="text-red-500 text-sm">
                    <?= $validator->getMessage('unit') ?>
                  </span>
                <?php endif; ?>
              </div>
            </div>
          </div>    

          <!-- Payment Option -->
          <p class="text-center sm:text-left text-xl sm:text-2xl mb-4 font-semibold">
            <span class="text-gray-400">3. </span>
            <span class="text-gray-700">Payment Option</span>
          </p>

          <div class="checkout-form-group grid lg:grid-cols-3 gap-3">

            <a class="cursor-pointer p-5 border border-blue-500 rounded text-center">
              <div class="mx-auto mb-2 h-4 w-4 border-4 border-blue-500 rounded-full"></div>
              <span class="text-gray-800 text-sm">CASH ON DELIVERY</span>
            </a>

            <a class="cursor-pointer p-5 hover:bg-gray-200 border border-gray-400 rounded text-center">
              <div class="mx-auto mb-2 h-4 w-4 border-4 border-gray-400 rounded-full"></div>
              <span class="text-gray-500 text-sm">ONLINE BY CARD</span>
              <span class="block text-xs text-red-400">(Currently Not Supported)</span>
            </a>

            <a class="cursor-pointer p-5 hover:bg-gray-200 border border-gray-400 rounded text-center">
              <div class="mx-auto mb-2 h-4 w-4 border-4 border-gray-400 rounded-full"></div>
              <span class="text-gray-500 text-sm">ELECTRONIC PAYMENT</span>
              <span class="block text-xs text-red-400">(Currently Not Supported)</span>
            </a>

          </div>
        </div>

        <div class="lg:col-span-3">
          <div class="checkout-form-group lg:sticky" style="top: 68px">
            <div class="font-semibold text-lg mb-5">Items in Order</div>

            <?php foreach ($carts as $cart) : ?>
              <div class="flex mb-3 justify-between">
                <div class="font-light">
                  <div class="leading-5 text-gray-600"><?= __($cart->getProduct()->name) ?></div>
                  <div class="text-gray-400">
                    <?= $cart->quantity ?> × <?= money($cart->getProduct()->price) ?>
                  </div>
                </div>
                <div class="ml-2"><?= money($cart->getSubtotal()) ?></div>
              </div>
            <?php endforeach ?>

            <div class="border-b border-gray-300 mb-5"></div>

            <div class="flex justify-between mb-5">
              <div class="text-gray-400 font-semibold">Payment</div>
              <div class="text-gray-500">Cash On Delivery</div>
            </div>

            <div class="border-b border-gray-300 mb-5"></div>

            <div class="flex justify-between mb-3">
              <div class="text-gray-400 font-semibold">Subtotal</div>
              <div class="text-gray-500"><?= money($subtotal) ?></div>
            </div>

            <div class="flex justify-between mb-5">
              <div class="text-gray-400 font-semibold">Shipping Fee</div>
              <div class="text-gray-500"><?= money(config('app.shipping_fee')) ?></div>
            </div>

            <div class="border-b border-gray-300 mb-5"></div>

            <div class="flex justify-between mb-5">
              <div class="text-gray-400 font-semibold self-center">Total</div>
              <div class="text-gray-900 font-light text-xl"><?= money($total) ?></div>
            </div>

            <button 
              type="submit" 
              class="block w-full text-center py-2 rounded bg-blue-500 text-white hover:bg-blue-800 focus:outline-none my-1"
              >
              Check out
            </button>

          </div>
        </div>
      </div>
    </form>

  </div>
</div>