<div class="flex flex-col gap-4">

  <p class="text-center sm:text-left text-xl sm:text-2xl font-semibold">
    <span class="text-gray-400">{{ $number }}. </span>
    <span class="text-gray-700">{{ $title }}</span>
  </p>

  <div class="bg-white shadow-lg p-5 rounded">
    {{ $slot }}
  </div>

</div>