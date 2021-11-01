<div 
  x-data="carousel" 
  class="carousel">

  <div class="absolute h-full w-full" x-ref="container">
    @foreach($slides as $i => $image)
    <img
      x-show="active === {{ $i }}"
      class="object-cover absolute top-0 mx-auto h-full w-full"
      :class="move"
      src="{{ asset($image) }}"
      x-transition:enter="enter"
      x-transition:enter-start="enter-start"
      x-transition:enter-end="enter-end"
      x-transition:leave="leave"
      x-transition:leave-start="leave-start"
      x-transition:leave-end="leave-end"
    />
    @endforeach
  </div>

  <!-- Left Button -->
  <div class="absolute left-5 h-full">
    <div class="flex flex-col justify-center h-full">
      <a @@click="next(-1)" class="btn-left cursor-pointer text-gray-200 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
      </a>
    </div>
  </div>

  <!-- Right Button -->
  <div class="absolute right-5 h-full">
    <div class="flex flex-col justify-center h-full">
      <a @@click="next(1)" class="btn-right cursor-pointer text-gray-200 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </a>
    </div>
  </div>  

  <!-- Indicator -->
  <div class="absolute w-full bottom-5">
    <ul class="flex justify-center">
      <template x-for="h,i in Array(slidesCount)">
        <li @@click="activate(i)" :class="{'bg-white': i === active}" class="cursor-pointer mx-1 h-3 w-3 rounded-full border border-white">
          <a href="#"></a>
        </li>
      </template>
    </ul>
  </div>

</div>