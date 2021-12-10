<aside 
  x-data="{isOpen: false}"
  @@toggle-sidebar.window="isOpen = !isOpen"
  :class="{'-left-64': !isOpen}"
  class="bg-gray-800 z-30 fixed -left-64 lg:left-0 w-64 h-screen overflow-y-auto">
  
  <div class="flex justify-between items-center px-5 bg-gray-900 h-16">
    <a 
      href="{{ route('admin.home') }}" 
      class="flex items-center mr-5 text-2xl text-white font-black font-iceland"
    >
      <img
        src="{{ asset('img/logo.png') }}" 
        class="mr-2 h-8 inline-block" 
      />
      <span>{{ config('app.name') }}</span>
    </a>

    <!-- Close Sidebar -->
    <a class="lg:hidden text-gray-500 cursor-pointer" @@click="isOpen = false">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </a>

  </div>

  <nav>
    <p class="p-3 text-xs uppercase text-gray-400">Home</p>
    <ul>
      <li>
        <a 
          href="{{ route('admin.home') }}" 
          class="flex hover:bg-gray-700 text-gray-300 py-2 @routeIs('admin.home') bg-gray-700 @endrouteIs"
          >
          <span class="inline-flex justify-center items-center w-12 h-6 flex-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
          </span>
          <span class="flex-grow">Dashboard</span>
        </a>
      </li>
    </ul>

    <p class="p-3 text-xs uppercase text-gray-400">General</p>
    <ul>
      <li>
        <a 
          href="{{ route('admin.categories.index') }}" 
          class="flex hover:bg-gray-700 text-gray-300 py-2 @routeIs('admin.categories*') bg-gray-700 @endrouteIs"
          >
          <span class="inline-flex justify-center items-center w-12 h-6 flex-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block" height="16" width="16" viewBox="0 0 512 512" fill="currentColor">
              <path d="M296 32h192c13.255 0 24 10.745 24 24v160c0 13.255-10.745 24-24 24H296c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24zm-80 0H24C10.745 32 0 42.745 0 56v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zM0 296v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm296 184h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H296c-13.255 0-24 10.745-24 24v160c0 13.255 10.745 24 24 24z"/>
            </svg>
          </span>
          <span class="flex-grow">Categories</span>
        </a>
      </li>

      <li>
        <a 
          href="{{ route('admin.products.index') }}" 
          class="flex justify-between hover:bg-gray-700 text-gray-300 py-2 @routeIs('admin.products*') bg-gray-700 @endrouteIs"
          >
          <div class="flex items-center">
            <span class="inline-flex justify-center items-center w-12 h-6 flex-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
              </svg>
            </span>
            <span class="flex-grow">Products</span>
          </div>
        </a>
      </li>

      <li>
        <a 
          href="{{ route('admin.orders.index') }}" 
          class="flex justify-between hover:bg-gray-700 text-gray-300 py-2 @routeIs('admin.orders*') bg-gray-700 @endrouteIs"
          >
          <div class="flex items-center">
            <span class="inline-flex justify-center items-center w-12 h-6 flex-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </span>
            <span class="flex-grow">Orders</span>
          </div>
        </a>
      </li>

      <li>
        <a 
          href="{{ route('admin.customers.index') }}" 
          class="flex justify-between hover:bg-gray-700 text-gray-300 py-2 @routeIs('admin.customers*') bg-gray-700 @endrouteIs"
          >
          <div class="flex items-center">
            <span class="inline-flex justify-center items-center w-12 h-6 flex-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </span>
            <span class="flex-grow">Customers</span>
          </div>
        </a>
      </li>

    </ul>
  </nav>

</aside>