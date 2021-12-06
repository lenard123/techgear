<header>

  <!-- Top Header -->
  <div class="hidden lg:flex lg:items-center | lg:h-8 | lg:bg-gray-900 | lg:text-gray-400 lg:text-sm">
    <div class="flex justify-between | container mx-auto px-4">

      <div class="flex gap-5">
        <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
          </svg>
          <span>{{ config('site.phone') }}</span>
        </a>

        <a href="mailto:support@techgear.studio">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
          <span>{{ config('site.email') }}</span>
        </a>
      </div>

      <div class="flex gap-5">
        <a href="#">TOS</a>
        <a href="#">FAQs</a>
      </div>

    </div>
  </div><!-- End of Top Header -->

  <!-- Navbar Wrapper -->
  <div class="h-16">
    <nav 
      x-data
      x-sticky-top
      class="fixed top-0 z-30 lg:relative | w-full h-16 | bg-white shadow"
      >
      <div class="flex justify-between items-center gap-6 | container mx-auto px-4 h-full">

        <!-- Left -->
        <div class="flex items-center">

          <!-- Brand Name -->
          <a href="{{ route('home') }}" class="flex items-center gap-2 | text-2xl text-gray-800 font-black font-iceland">
            <img src="{{ asset('img/logo.png') }}" class="hidden sm:block h-8 w-8" alt="TechGear Logo"/>
            <span>TechGear</span>
          </a>

        </div>

        <form action="#" class="flex-grow gap-5 hidden lg:flex justify-center">

          <button type="button" class="text-gray-500">
<svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
</svg>
          </button>

          <div class="flex items-center w-1/2 relative transition-all">
            <input 
              type="search" 
              name="query"
              class="bg-gray-200 py-2 px-3 w-full focus:border-gray-300 border rounded-full outline-none font-semibold text-gray-700"
              placeholder="Search Product" 
            />
            <button name="page" value="search" type="submit" class="absolute right-5 text-gray-400">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
        </form>

        <div class="flex items-center text-gray-700">

          @auth

            {{-- User Menu Dropdown --}}
            <div 
              class="relative my-auto outline-none z-50"
              x-data="{isOpen: false}"
              @@click.outside="isOpen = false"
              >
              <button @@click="isOpen = true" class="p-2 block cursor-pointer hover:bg-gray-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              </button>

              <div 
                class="w-auto py-2 rounded border border-gray-300 bg-white absolute z-20 right-0"
                x-show="isOpen"
                x-cloak
                >
                <a href="{{ route('orders.index') }}" class="px-5 py-1 whitespace-nowrap inline-block hover:bg-gray-200 w-full">
                  Orders
                </a>
                <a href="{{ route('favorites.index') }}" class="px-5 py-1 whitespace-nowrap inline-block hover:bg-gray-200 w-full">
                  Favorites
                </a>
                <a href="{{ route('profile.index') }}" class="px-5 py-1 whitespace-nowrap inline-block hover:bg-gray-200 w-full">
                  Profile
                </a>
                <a href="{{ route('settings.index') }}" class="px-5 py-1 whitespace-nowrap inline-block hover:bg-gray-200 w-full">
                  Settings
                </a>

                {{-- Divider --}}
                <div class="border-b border-gray-300 my-1"></div>
                
                <a href="{{ route('logout') }}" class="px-5 py-1 whitespace-nowrap inline-block hover:bg-gray-200 w-full">
                  Logout
                </a>
              </div>
            </div>

            {{-- Cart --}}
            <div class="my-auto relative">
              <a href="{{ route('carts.index') }}" class="p-2 block cursor-pointer hover:bg-gray-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
              </a>
              <span 
                class="absolute inline-flex text-[.5rem] items-center justify-center px-2 py-1 top-0 -right-1 font-bold leading-none text-red-100 bg-red-600 rounded-full"
              >1</span>
            </div>
          @endauth

          @guest
          <a href="{{ route('signup') }}" class="hover:text-gray-800 | transition">Create Account</a>
          <a href="{{ route('login') }}" class="btn btn-primary ml-4 rounded-full">Sign In</a>
          @endguest
        </div>

      </div>

    </nav>
  </div>

</header>