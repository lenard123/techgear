
<header>
  <div class="hidden lg:block bg-gray-900 py-2 text-gray-400 text-sm">
    <div class="container mx-auto px-5">
      <div class="flex justify-between">
        <div>
          <a href="#" class="mr-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            (0939) 771 4101
          </a>
          <a href="#">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            lenard.mangayayam@gmail.com
          </a>
        </div>
        <div>
          <a href="#" class="mr-5">TOS</a>
          <a href="#" class="mr-5">FAQs</a>
          <?php if (!App\Models\User::isUserCustomer()) : ?>
            <a href="<?= url('?page=signup') ?>" class="mr-5">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
              </svg>
              Register
            </a>
            <a href="<?= url('?page=signin') ?>">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
              </svg>
              Login
            </a>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
  <div style="height: 60px;">
    <nav 
      class="fixed lg:relative bg-white text-gray-500 top-0 left-0 right-0 z-20 shadow" 
      style="height: 60px;"
      x-data="{ isSearchBarOpen: false }"
      @click.outside="isSearchBarOpen = false"
      :style="{ position: $store.scroll.position <= 36 ? '' : 'fixed'}"
    >
      <div class="container mx-auto px-5 h-full flex justify-between">
        <div class="flex">

          <!-- Burger -->
          <a 
            class="cursor-pointer my-auto mr-2 lg:hidden"
            @click="$store.isSidebarOpen = true"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </a>
          <a 
            href="<?= url() ?>" 
            class="flex my-auto mr-5 text-2xl text-gray-800 font-black"
            style="font-family: 'Iceland', cursive;">
            <img
              src="<?= url('assets/img/logo.png') ?>" 
              class="mr-2 h-8 inline-block" 
            />
            <span>TechGear</span>
          </a>

          <div class="hidden lg:flex ">
            <?php foreach($categories as $i => $category) : ?>
              <?php if ($i < 5) : #Limit the displayed category to 5 items ?>
              <a 
                href="<?= url("?page=category&id={$category->id}") ?>" 
                class="text-md my-auto whitespace-nowrap py-2 px-3 hover:text-gray-900"
              >
                <span><?= __($category->name) ?></span>
              </a>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="flex">
          <a @click="isSearchBarOpen = true" class="cursor-pointer my-auto mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </a>

          <?php if(App\Models\User::isUserCustomer()) : ?>
              <div 
                class="relative my-auto outline-none z-50"
                x-data="{isOpen: false}"
                @click.outside="isOpen = false"
              >
                <button 
                  class="py-2 block cursor-pointer mr-4"
                  @click="isOpen = true"
                >
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                </button>

                <div 
                  class="hidden w-auto py-2 rounded border border-gray-300 bg-white absolute z-20 right-0 z-1"
                  :style="{display: isOpen ? 'block':null}"
                >
                  <a href="<?= url('?page=order') ?>" class="px-5 py-1 whitespace-nowrap inline-block hover:bg-gray-200 w-full">
                    Orders <?= $order_count > 0 ? "($order_count)": "" ?>
                  </a>
                  <a href="<?= url('?page=favorites') ?>" class="px-5 py-1 whitespace-nowrap inline-block hover:bg-gray-200 w-full">
                    Favorites <?= $favorite_count > 0 ? "($favorite_count)" : "" ?>
                  </a>
                  <a href="<?= url('?page=personal') ?>" class="px-5 py-1 whitespace-nowrap inline-block hover:bg-gray-200 w-full">
                    Profile
                  </a>
                  <a href="<?= url('?page=settings') ?>" class="px-5 py-1 whitespace-nowrap inline-block hover:bg-gray-200 w-full">
                    Settings
                  </a>
                  <div class="border-b border-gray-300 my-1"></div>
                  
                  <form action="<?= url('?page=signout') ?>" method="POST">
                    <button type="submit" class="text-left px-5 py-1 whitespace-nowrap inline-block hover:bg-gray-200 w-full">
                      Logout
                    </button>
                  </form>

                </div>
              </div>

              <div class="my-auto relative">
                <a href="<?= url('?page=cart') ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                  </svg>
                </a>
                <?php if ($cart_count >= 1) : ?>
                  <span 
                    class="absolute inline-flex items-center justify-center px-2 py-1 top-0 -mt-2 ml-4 font-bold leading-none text-red-100 bg-red-600 rounded-full"
                    style="font-size: .6rem;"
                  ><?= $cart_count ?></span>
                <?php endif; ?>
              </div>
            
          <?php endif ?>


        </div>
      </div>
      <!-- Search Bar -->
      <div
        class="search-bar absolute left-0 right-0 bg-white z-20 shadow z-0"
        :class="{active: isSearchBarOpen}"
      >
        <div class="container mx-auto px-5 h-full text-lg flex">
          <form class="w-full" action="<?= url() ?>">
            <input type="hidden" name="page" value="search">
            <input
              class="h-full w-full focus:outline-none"
              type="text" 
              name="query"
              placeholder="Search Product">
          </form>

          <button @click="isSearchBarOpen = false">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>

        </div>
      </div>
    </nav>
  </div>
</header>