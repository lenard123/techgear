<x-layouts.customer-profile :customer="$customer">

@if ($favorites->isEmpty())
  <div class="py-10 text-center text-gray-700">Empty favorites list.</div>
@else

  <table class="border border-gray-200 w-full text-sm text-gray-800">
    <thead>
      <tr>
        <th class="text-left p-2 border">Product Name</th>
      </tr>
    </thead>
    <tbody>
      @foreach($favorites as $favorite)
        <tr>
          <td class="border p-2">
            <a 
              href="{{ route('products.show', $favorite->product) }}" 
              class="hover:text-primary"
              target="_blank" 
            >{{ $favorite->product->name }}</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endif

</x-layouts.customer-profile>
