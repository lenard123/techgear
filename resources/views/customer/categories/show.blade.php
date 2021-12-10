<x-layouts.customer :title="$category->name">

  <x-product-card.container 
    :products="$category->products()->where('is_published', true)->get()" 
    :title="$category->name"
  />

</x-layouts.customer>