<header class="fixed top-0 left-0 right-0 bg-white lg:pl-60 shadow" style="height: 60px">

  <div class="flex items-center justify-between py-2 px-3 h-full">

    <form class="flex items-center">

      <a class="lg:hidden cursor-pointer my-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </a>

      <input 
        class="py-1 px-2 focus:outline-none"
        type="text" 
        name="" 
        placeholder="Search Everywhere">
    </form>

    <div class="dropdown relative text-gray-900 hover:text-blue-500 cursor-pointer">

      <a class="flex items-center py-2 px-3">
        <div class="w-8 h-8 mr-3 inline-flex">
          <img 
            src="<?= url('assets/img/avatar.jpg') ?>"
            class="h-full w-full rounded-full"
          >
        </div>
        <span class="hidden sm:inline mr-1 whitespace-nowrap">John Lenard</span>
        <span class="hidden sm:inline">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
        </span>
      </a>

    </div>

  </div>

</header>