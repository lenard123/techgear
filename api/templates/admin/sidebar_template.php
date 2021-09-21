<aside id="sidebar" class="bg-gray-800 fixed -left-60 lg:left-0 w-60 h-screen overflow-y-scroll">
  <div class="flex justify-between items-center px-5 bg-gray-900" style="height: 60px">
    <a 
      href="<?= url() ?>" 
      class="flex items-center mr-5 text-2xl text-white font-black"
      style="font-family: 'Iceland', cursive;">
      <img
        src="<?= url('assets/img/logo.png') ?>" 
        class="mr-2 h-8 inline-block" 
      />
      <span>TechGear</span>
    </a>

    <a class="lg:hidden text-gray-500 cursor-pointer" data-action="close-sidebar">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </a>

  </div>

  <nav>
    <p class="p-3 text-xs uppercase text-gray-400">Home</p>
    <ul>
      <li>
        <a href="#" class="flex hover:bg-gray-700 text-gray-300 py-2">
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
        <a href="<?= admin('?page=category') ?>" class="flex hover:bg-gray-700 text-gray-300 py-2">
          <span class="inline-flex justify-center items-center w-12 h-6 flex-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block" height="16" width="16" viewBox="0 0 512 512" fill="currentColor">
              <path d="M296 32h192c13.255 0 24 10.745 24 24v160c0 13.255-10.745 24-24 24H296c-13.255 0-24-10.745-24-24V56c0-13.255 10.745-24 24-24zm-80 0H24C10.745 32 0 42.745 0 56v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V56c0-13.255-10.745-24-24-24zM0 296v160c0 13.255 10.745 24 24 24h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H24c-13.255 0-24 10.745-24 24zm296 184h192c13.255 0 24-10.745 24-24V296c0-13.255-10.745-24-24-24H296c-13.255 0-24 10.745-24 24v160c0 13.255 10.745 24 24 24z"/>
            </svg>
          </span>
          <span class="flex-grow">Categories</span>
        </a>
      </li>

      <li>
        <a href="#" class="flex hover:bg-gray-700 text-gray-300 py-2">
          <span class="inline-flex justify-center items-center w-12 h-6 flex-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z" clip-rule="evenodd" />
            </svg>
          </span>
          <span class="flex-grow">Products</span>
        </a>
      </li>

      <li>
        <a href="#" class="flex hover:bg-gray-700 text-gray-300 py-2">
          <span class="inline-flex justify-center items-center w-12 h-6 flex-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
            </svg>
          </span>
          <span class="flex-grow">Orders</span>
        </a>
      </li>

      <li>
        <a href="#" class="flex hover:bg-gray-700 text-gray-300 py-2">
          <span class="inline-flex justify-center items-center w-12 h-6 flex-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
            </svg>
          </span>
          <span class="flex-grow">Customers</span>
        </a>
      </li>
    </ul>

    <p class="p-3 text-xs uppercase text-gray-400">Misc.</p>
    <ul>
      <li>
        <a href="#" class="flex hover:bg-gray-700 text-gray-300 py-2">
          <span class="inline-flex justify-center items-center w-12 h-6 flex-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
            </svg>
          </span>
          <span class="flex-grow">Settings</span>
        </a>
      </li>

    </ul>
  </nav>

</aside>
