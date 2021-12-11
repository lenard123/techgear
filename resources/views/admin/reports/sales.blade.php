<x-layouts.admin title="Sales Report">
  <div class="p-4">
    <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded mt-8">
      <div class="p-4 border-b border-gray-200">
        <span class="font-semibold text-lg text-gray-800">Sales Report</span>
      </div>

      <div class="p-4">
        <table class="border border-gray-200 w-full text-sm text-gray-800">
          <thead>
            <tr>
              <th class="text-left p-2 border" width="10%">#</th>
              <th class="text-left p-2 border">Product Name</th>
              <th class="p-2 border" width="10%">No. of Sales</th>
              <th class="p-2 border" width="20%">Total Sales</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
            <tr>
              <td class="border p-2">{{ $loop->index + 1 }}</td>
              <td class="border p-2">
                <a 
                  href="{{ route('products.show', $product) }}" 
                  class="hover:text-primary"
                  target="_blank"
                >{{ $product->name }}</a>
              </td>
              <td class="border p-2 text-center">{{ $product->sales }}</td>
              <td class="border p-2 text-right">@currency($product->sales * $product->price)</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>


    </div>
  </div>
</x-layouts.admin>