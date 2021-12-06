<x-layouts.customer :title="$category->name">

  <x-product-card.container 
    :products="$category->products" 
    :title="$category->name"
  />

</x-layouts.customer>