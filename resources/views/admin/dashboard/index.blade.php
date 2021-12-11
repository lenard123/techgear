<x-layouts.admin title="Home">

  <div class="py-8 px-6">

    <div class="grid xl:grid-cols-2 gap-5">

      <div class="grid sm:grid-cols-2 gap-5 self-start">

        <div class="bg-grad-4 rounded text-white">
          <div class="px-3 pt-3">
            <p class="text-xs font-semibold opacity-50"><span class="block">Total</span>Sales</p>
            <p class="font-bold text-3xl">@currency($dashboard->getTotalSales())</p>
          </div>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
              <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
          </svg>
        </div>

        <div class="bg-grad-1 rounded text-white">
          <div class="px-3 pt-3">
            <p class="text-xs font-semibold opacity-50"><span class="block">Total</span>Customer</p>
            <p class="font-bold text-3xl">{{ $dashboard->getCustomersCount() }}</p>
          </div>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
              <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
          </svg>
        </div>

        <div class="bg-grad-2 rounded text-white">
          <div class="px-3 pt-3">
            <p class="text-xs font-semibold opacity-50"><span class="block">Total</span>Completed Orders</p>
            <p class="font-bold text-3xl">{{ $dashboard->getCompleteOrdersCount() }}</p>
          </div>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
              <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
          </svg>
        </div>

        <div class="bg-grad-3 rounded text-white">
          <div class="px-3 pt-3">
            <p class="text-xs font-semibold opacity-50"><span class="block">Total</span>Products</p>
            <p class="font-bold text-3xl">{{ $dashboard->getProductsCount() }}</p>
          </div>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
              <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
          </svg>
        </div>

      </div>

      <div class="grid sm:grid-cols-2 gap-5">

        <div class="bg-white rounded shadow-lg self-start min-h-full flex flex-col">
          <div class="p-4 border-b border-gray-200">
            <span class="font-semibold text-lg text-gray-800">Products</span>
          </div>
          <div class="p-1 flex-grow py-4">
            <canvas x-data='chart(@json($dashboard->getProductChartData()))'></canvas>
          </div>
        </div>

        <div class="bg-white rounded shadow-lg self-start min-h-full flex flex-col">
          <div class="p-4 border-b border-gray-200">
            <span class="font-semibold text-lg text-gray-800">Orders</span>
          </div>
          <div class="p-1 flex-grow py-4">
            <canvas x-data='chart(@json($dashboard->getOrderChartData()))'></canvas>
          </div>
        </div>

      </div>

    </div>

    <div class="grid xl:grid-cols-2 gap-5 mt-6">

        <div class="bg-white rounded shadow-lg self-start min-h-full flex flex-col">
          <div class="p-4 border-b border-gray-200">
            <span class="font-semibold text-lg text-gray-800">Category wise product sales</span>
          </div>
          <div class="p-1 flex-grow py-4">
            <canvas x-data='chart(@json($dashboard->getCategoriesSaleChartData()))'></canvas>
          </div>
        </div>

        <div class="bg-white rounded shadow-lg self-start min-h-full flex flex-col">
          <div class="p-4 border-b border-gray-200">
            <span class="font-semibold text-lg text-gray-800">Category wise product stocks</span>
          </div>
          <div class="p-1 flex-grow py-4">
            <canvas x-data='chart(@json($dashboard->getCategoriesStockChartData()))'></canvas>
          </div>
        </div>

    </div>

  </div>

  @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  @endpush

</x-layouts.admin>