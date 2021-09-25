<section class="p-6">
  <div class="flex justify-center lg:block items-center">
    <ul class="breadcrumbs flex text-lg sm:text-2xl text-gray-500">
      <li>Admin</li>
      <li>Dashboard</li>
    </ul>
  </div>
</section>

<header class="bg-white p-6">
  <h1 class="text-3xl font-semibold leading-tight">Dashboard</h1>
</header>

<main class="md:px-6 py-6">

  <div class="grid gap-6 grid-cols-3">

    <div class="bg-white p-6 shadow">
      <div class="flex justify-between items-center">
        <div>
          <p class="text-lg text-gray-500">Customers</p>
          <p class="text-3xl font-semibold text-black">243</p>
        </div>
        <div>
          <span class="text-green-500">
            <svg viewBox="0 0 24 24" fill="currentColor" width="48" height="48" data-v-3ca1866b=""><path d="M16 17V19H2V17S2 13 9 13 16 17 16 17M12.5 7.5A3.5 3.5 0 1 0 9 11A3.5 3.5 0 0 0 12.5 7.5M15.94 13A5.32 5.32 0 0 1 18 17V19H22V17S22 13.37 15.94 13M15 4A3.39 3.39 0 0 0 13.07 4.59A5 5 0 0 1 13.07 10.41A3.39 3.39 0 0 0 15 11A3.5 3.5 0 0 0 15 4Z" data-v-3ca1866b=""></path></svg>
          </span>
        </div>
      </div>
    </div>

    <div class="bg-white p-6 shadow">
      <div class="flex justify-between items-center">
        <div>
          <p class="text-lg text-gray-500">Sales</p>
          <p class="text-3xl font-semibold text-black"><?= money(125599) ?></p>
        </div>
        <div>
          <span class="text-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 20 20" fill="currentColor">
              <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
              <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
            </svg>
          </span>
        </div>
      </div>
    </div>

    <div class="bg-white p-6 shadow">
      <div class="flex justify-between items-center">
        <div>
          <p class="text-lg text-gray-500">Orders</p>
          <p class="text-3xl font-semibold text-black">243</p>
        </div>
        <div>
          <span class="text-yellow-500">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </span>
        </div>
      </div>
    </div>

  </div>

</main>