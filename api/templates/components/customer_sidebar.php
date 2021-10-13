<aside 
  x-data 
  x-cloak
  class="lg:hidden" 
  >
  <!-- Overlay -->
  <div
    @click="$store.isSidebarOpen = false" 
    class="fixed bg-black top-0 left-0 right-0 bottom-0 z-30 opacity-10"
    :style="{display: $store.isSidebarOpen ? 'block': 'none'}"
  ></div>

  <!-- Sidebar Content -->
  <div
    class="fixed overflow-y-scroll top-0 left-0 bg-white h-screen z-40" 
    style="width: 300px;"
    :style="{left: $store.isSidebarOpen ? '0' : '-300px'}"
  >

    <a @click="$store.isSidebarOpen = false" class="cursor-pointer absolute top-3 right-3 text-gray-400">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </a>

    <div class="px-4 py-2 border-b border-gray-200 text-gray-400 leading-3">
      <p class="font-bold text-md mb-1">(0939) 771 4101</p>
      <p class="text-xs">lenard.mangayayam@gmail.com</p>
    </div>

    <div class="category-link px-4 border-b border-gray-200 text-gray-500">

      <?php foreach($categories as $category) : ?>
      <div class="flex items-center justify-between h-12">
        <a href="<?= url("?page=category&id={$category->id}") ?>"><?= __($category->name) ?></a>
      </div>
      <?php endforeach; ?>

    </div>

    <?php if (!App\Models\User::isUserCustomer()) : ?>
      <div class="px-4 border-b border-gray-200 text-gray-500">
        <a href="<?= url('?page=signin') ?>" class="flex items-center justify-between h-12">
          <span>Login</span>
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
            </svg>
          </span>
        </a>
      </div>

      <div class="px-4 border-b border-gray-200 text-gray-500">
        <a href="<?= url('?page=signup') ?>" class="flex items-center justify-between h-12">
          <span>Register</span>
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
          </span>
        </a>
      </div>
    <?php endif; ?>

  </div>
</aside>
