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
      method="POST"
      class="grid lg:grid-cols-12 gap-4 text-gray-500"
      >
      @csrf

      {{-- Inputs --}}
      <div class="lg:col-span-9 flex flex-col gap-8">

        <x-checkout-form number="1" title="Contact Information">

          <div class="grid lg:grid-cols-2 gap-5">

            <x-simple-input
              label="Recipient Firstname" 
              name="firstname" 
              class="bg-white"
            />

            <x-simple-input
              label="Recipient Firstname" 
              name="firstname"
            />

            <x-simple-input
              label="Phone"
              name="phone"
            />

            <x-simple-input
              label="E-mail"
              name="email"
            />

          </div>

        </x-checkout-form>

        <x-checkout-form number="2" title="Address">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </x-checkout-form>

        <x-checkout-form number="3" title="Payment">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
          proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </x-checkout-form>

      </div>

      {{-- Summary --}}
      <div class="lg:col-span-3">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>

    </form>

  </div>

</x-layouts.customer>