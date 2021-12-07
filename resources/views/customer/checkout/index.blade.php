<x-layouts.customer title="Checkout">

  <div class="container mx-auto py-5 sm:px-5">

    {{-- Breadcrumbs --}}
    <h1 class="flex justify-center mb-8 font-semibold">
      <a 
        href="{{ route('carts.index') }}" 
        class="text-lg text-gray-500 my-auto mr-2"
        >
        <span>Shopping Cart</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </a>
      <span class="text-2xl">Check Out</span>
    </h1>

    <form
      action="{{ route('checkout') }}"
      method="POST"
      class="grid lg:grid-cols-12 gap-4 text-gray-500"
      >
      @csrf

      {{-- Inputs --}}
      <div class="lg:col-span-9 flex flex-col gap-8">

        <x-checkout-form number="1" title="Contact Information">

          <div class="grid lg:grid-cols-2 gap-5">

            <x-input.text
              class="text-gray-800"
              label-class="font-bold text-gray-500 block"
              input-class="simple-input-1"
              error-class="error"
              label="Recipient Firstname"
              name="firstname"
              :value="$user->firstname"
              type="text"
              required
            />

            <x-input.text
              class="text-gray-800"
              label-class="font-bold text-gray-500 block"
              input-class="simple-input-1"
              error-class="error"
              label="Recipient Lastname"
              name="lastname"
              :value="$user->lastname"
              type="text"
              required
            />

            <x-input.text
              class="text-gray-800"
              label-class="font-bold text-gray-500 block"
              input-class="simple-input-1"
              error-class="error"
              label="Phone"
              name="phone"
              :value="$user_info->phone"
              type="text"
              required
            />

            <x-input.text
              class="text-gray-800"
              label-class="font-bold text-gray-500 block"
              input-class="simple-input-1"
              error-class="error"
              label="Email"
              name="email"
              :value="$user->email"
              type="email"
              required
            />

          </div>

        </x-checkout-form>

        <x-checkout-form number="2" title="Address">
          <div 
            class="grid lg:grid-cols-3 gap-5"
            x-data='address(@json($address->cache), @json($address->selected))'>


            {{-- Regions Input --}}
            <div class="lg:col-span-3" x-data="resetErrorValidation">
              <label class="font-bold text-gray-500 block">Region</label>
              <select 
                class="simple-input-1"
                required="" 
                x-model="selected.region"
                :disabled="cache.regions.length === 0"
                name="region_id"
                >
                <option value="">-- Select Region --</option>
                <template x-for="region in cache.regions" :key="region.id">
                  <option x-text="region.name" :selected="region.region_id === selected.region" :value="region.region_id"></option>
                </template>
              </select>
            </div>

            {{-- Provinces Input --}}
            <div x-data="resetErrorValidation">
              <label class="font-bold text-gray-500 block">Province</label>
              <select 
                class="simple-input-1" 
                required=""
                x-model="selected.province"
                :disabled="filteredProvinces.length === 0"
                name="province_id"
                >
                <option value="">-- Select Province --</option>
                <template x-for="province in filteredProvinces" :key="province.id">
                  <option x-text="province.name" :selected="province.province_id === selected.province" :value="province.province_id"></option>
                </template>
              </select>
            </div>

            {{-- Cities --}}
            <div x-data="resetErrorValidation">
              <label class="font-bold text-gray-500 block">City</label>
              <select 
                class="simple-input-1" 
                required=""
                x-model="selected.city"
                :disabled="filteredCities.length === 0"
                name="city_id"
                >
                <option value="">-- Select City --</option>
                <template x-for="city in filteredCities" :key="city.id">
                  <option x-text="city.name" :selected="city.city_id === selected.city" :value="city.city_id"></option>
                </template>
              </select>
            </div>

            {{-- Barangay --}}
            <div x-data="resetErrorValidation">
              <label class="font-bold text-gray-500 block">Barangay</label>
              <select 
                class="simple-input-1" 
                required=""
                x-model="selected.barangay"
                :disabled="filteredBarangays.length === 0"
                name="barangay_id"
                >
                <option value="">-- Select Barangay --</option>
                <template x-for="barangay in filteredBarangays" :key="barangay.id">
                  <option x-text="barangay.name" :selected="barangay.code === selected.barangay" :value="barangay.code"></option>
                </template>
              </select>
            </div>

            <x-input.text
              class="text-gray-800 lg:col-span-2"
              label-class="font-bold text-gray-500 block"
              input-class="simple-input-1"
              error-class="error"
              label="Street/Building Name: "
              name="street"
              :value="$user_info->street"
              type="text"
              required
            />

            <x-input.text
              class="text-gray-800"
              label-class="font-bold text-gray-500 block"
              input-class="simple-input-1"
              error-class="error"
              label="House#/Unit/Floor: "
              name="unit"
              :value="$user_info->unit"
              type="text"
              required
            />

          </div>
        </x-checkout-form>

        <x-checkout-form number="3" title="Payment">

          <div class="grid lg:grid-cols-3 gap-3">
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

        </x-checkout-form>

      </div>

      {{-- Summary --}}
      <div class="lg:col-span-3">

        <div class="lg:sticky lg:top-16 lg:pt-8">
          <div class="bg-white shadow-lg p-5 rounded">
            <div class="font-semibold text-lg mb-5">Items in Order</div>

            @foreach ($cartsData->items as $cart)
            <div class="flex mb-3 justify-between">
              <div class="font-light">
                <div class="leading-5 text-gray-600">{{ $cart->product->name }}</div>
                <div class="text-gray-400">
                  <span>{{ $cart->quantity }}</span>
                  <span> × </span>
                  <span>@currency($cart->product->price)</span>
                </div>
              </div>
              <div class="ml-2">@currency($cart->calculateSubtotal())</div>
            </div>
            @endforeach

            <div class="border-b border-gray-300 mb-5"></div>

            <div class="flex justify-between mb-5">
              <div class="text-gray-400 font-semibold">Payment</div>
              <div class="text-gray-500">Cash On Delivery</div>
            </div>

            <div class="border-b border-gray-300 mb-5"></div>

            <div class="flex justify-between mb-3">
              <div class="text-gray-400 font-semibold">Subtotal</div>
              <div class="text-gray-500">@currency($cartsData->subtotal)</div>
            </div>

            <div class="flex justify-between mb-5">
              <div class="text-gray-400 font-semibold">Shipping Fee</div>
              <div class="text-gray-500">@currency($cartsData->shippingFee)</div>
            </div>

            <div class="border-b border-gray-300 mb-5"></div>

            <div class="flex justify-between mb-5">
              <div class="text-gray-400 font-semibold self-center">Total</div>
              <div class="text-gray-900 font-light text-xl">@currency($cartsData->total)</div>
            </div>

            <button class="btn btn-primary w-full rounded" type="submit">Place Order</button>

          </div>
        </div>

      </div>

    </form>

  </div>

  @push('postScripts')
    <script src="{{ asset('js/checkout.js') }}"></script>
  @endpush

</x-layouts.customer>