<header class="fixed top-0 left-0 right-0 bg-white lg:pl-60 shadow z-20 h-16">

  <div class="flex items-center justify-between py-2 px-3 h-full">

    <div class="flex items-center">

      <!-- Burger to Toggle Sidebar -->
      <a 
        x-data
        @@click="$dispatch('toggle-sidebar')"
        class="lg:hidden cursor-pointer my-2 mr-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </a>

    </div>


    <div class="dropdown relative text-gray-900 hover:text-blue-500 cursor-pointer">

      <a class="flex items-center py-2 px-3">
        <div class="w-9 h-9 mr-3 inline-flex">
          <img 
            src="{{ $user->imageUrl }}" 
            class="h-full w-full rounded-full"
          />
        </div>
        <div class="hidden sm:block mr-3">
          <p class="font-semibold text-gray-700 whitespace-nowrap">{{ $user->firstname }}</p>
          <p class="-mt-2 font-light text-sm text-gray-600">Admin</p>
        </div>
      </a>

    </div>

  </div>

</header>  