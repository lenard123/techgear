<aside x-cloak x-data="{isOpen: false}">

  <!-- Overlay -->
  <div 
    x-show="isOpen"
    @@click="isOpen = false"
    class="fixed top-0 left-0 z-40 | h-full w-full | bg-black opacity-10">
  </div>

  <!-- Burger / Sidebar Toggler -->
  <button 
    x-data
    @@click="isOpen = !isOpen"
    class="fixed bottom-4 right-4 z-40 lg:hidden | p-4 rounded-full | bg-gray-800 | text-white | transition">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
  </button><!-- End of Burger -->

  <div 
    class="fixed top-0 z-40 lg:hidden | px-1 h-screen w-72 | bg-white shadow-xl | font-medium text-base | overflow-y-auto transition-left"
    :class="isOpen ? 'left-0' : '-left-72'"
    >

    <div class="flex items-center | px-3 h-16 | text-gray-400 leading-1">
      <a href="#" class="flex items-center gap-2 | text-2xl text-gray-800 font-black font-iceland">
        <img src="<?= asset('img/logo.png') ?>" class="h-8 w-8" alt="TechGear Logo"/>
        <span>TechGear</span>
      </a>
    </div>

    <ul class="mt-4">

      <!-- Categories -->
      <li>
        <p class="px-3 mb-3 | uppercase font-semibold tracking-wide text-gray-900">Categories</p>

        <ul>
          @foreach($categories as $category) 
          <li>
            <a href="#" class="block | px-3 py-2 | text-gray-500 hover:text-gray-900 | transition-colors duration-200">{{ $category->name }}</a>
          </li>
          @endforeach
        </ul>

      </li><!-- End of Categories -->
    </ul>

  </div>
</aside>