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

      <a 
        class="hidden lg:block bg-gray-200 p-3 rounded-full ml-4 text-gray-700 hover:bg-gray-300 transition"
        href="{{ route('home') }}"
        target="_blank" 
        >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </a>

    </div>


    <div 
      x-data="{isOpen: false}" 
      @@click.outside="isOpen = false"
      class="relative text-gray-900 cursor-pointer"
      >

      <a class="flex items-center py-2 px-3 hover:text-blue-500" @@click="isOpen = true">
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

      <div 
        class="w-auto py-2 rounded border border-gray-300 bg-white absolute z-20 right-0 text-gray-700"
        x-show="isOpen"
        x-cloak
        >

        <a href="#" class="px-5 py-1 whitespace-nowrap inline-block hover:bg-primary w-full hover:text-white">
          Profile
        </a>

        <a href="{{ route('admin.logout') }}" class="px-5 py-1 whitespace-nowrap inline-block hover:bg-primary w-full hover:text-white">
          Logout
        </a>

      </div>

    </div>

  </div>

</header>  