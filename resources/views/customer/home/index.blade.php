<x-layouts.customer title="Home">

  @include('customer.home.carousel')

  @include('customer.home.categories')

  <x-product-card.container 
    :products="$featuredProducts" 
    title="Featured Products"
  />

</x-layouts.customer>