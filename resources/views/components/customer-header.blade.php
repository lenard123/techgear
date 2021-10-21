<header>

  <!-- Top Header -->
  <div class="hidden lg:flex lg:items-center | lg:h-8 | lg:bg-gray-900 | lg:text-gray-400 lg:text-sm">
    <div class="flex justify-between | container mx-auto px-4">

      <div class="flex gap-5">
        <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
          </svg>
          <span>(0939) 771 4101</span>
        </a>

        <a href="mailto:support@techgear.studio">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
          <span>support@techgear.studio</span>
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
      class="fixed top-0 left-0 z-30 lg:relative | flex items-center | w-full h-16 | bg-white | text-gray-500 | shadow"
      >

      <div class="flex justify-between | container mx-auto px-4">

        <!-- Left -->
        <div class="flex gap-2">

          <!-- Brand Name -->
          <a href="#" class="flex items-center gap-2 | text-2xl text-gray-800 font-black font-iceland">
            <img src="{{ asset('img/logo.png') }}" class="hidden sm:block h-8 w-8" alt="TechGear Logo"/>
            <span>TechGear</span>
          </a>

          <!-- Categories -->
          <ul class="hidden lg:flex lg:items-center lg:gap-6 | ml-5 | font-semibold whitespace-nowrap">
            @foreach($categories as $category)
            <li>
              <a href="#" class="hover:text-gray-700 | transition">{{ $category->name }}</a>
            </li>
            @endforeach
          </ul><!-- End of Categories -->

        </div><!-- End of Left -->

        <!-- Right -->
        <div class="flex items-center">

          <div class="flex items-center gap-4">
            <a href="#" class="hover:text-primary | transition">Create Account</a>
            <a href="#" class="btn btn-primary rounded-full">Login</a>
          </div>

        </div><!-- End of Right -->

      </div>

    </nav>
  </div><!-- End of Navbar Wrapper -->

</header>