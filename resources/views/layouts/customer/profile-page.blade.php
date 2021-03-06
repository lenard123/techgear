<x-layouts.customer :title="$title">
<div class="py-10">
  <div class="container mx-auto sm:px-5">
    <div class="grid lg:grid-cols-12 gap-5">
      <div class="lg:col-span-3">
        <div class="bg-white rounded shadow">
          <div class="p-5 border-b border-gray-300">
            <div class="mb-4 relative w-1/3 sm:w-1/4 lg:w-2/4 mx-auto rounded-full overflow-hidden">
              <img src="{{ auth()->user()->imageUrl }}" class="h-auto w-full" />
            </div>
            <p class="text-center text-lg font-bold text-gray-700">{{ auth()->user()->fullname }}</p>
            <p class="text-center text-sm text-gray-500 mb-4">Joined {{ auth()->user()->created_at->diffForHumans() }}</p>

            <div class="flex justify-center">
              <a href="{{ route('settings.index') }}" class="font-light border border-gray-400 py-1 text-sm px-4 rounded flex gap-1 items-center text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="text-gray-500">SETTINGS</span>
              </a>
              <button class="font-light border border-gray-400 py-1 text-sm px-4 rounded ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
              </button>
            </div>

          </div>
          <div class="flex flex-col" x-data='{ currentRoute:@json(url()->current()) }'>
            <a
              href="{{ route('orders.index') }}" 
              class="border-l-2 px-5 py-2 text-gray-600"
              :class='{"border-primary": currentRoute === @json(route('orders.index')) }'
            >Orders</a>

            <a
              href="{{ route('favorites.index') }}" 
              class="border-l-2 px-5 py-2 text-gray-600"
              :class='{"border-primary": currentRoute === @json(route('favorites.index')) }'
            >Favorites</a>

            <a
              href="{{ route('profile.index') }}" 
              class="border-l-2 px-5 py-2 text-gray-600"
              :class='{"border-primary": currentRoute === @json(route('profile.index')) }'
            >Personal Info</a>
          </div>
        </div>
      </div>
      <div class="lg:col-span-9">
        {{ $slot }}
      </div>
    </div>
  </div>
</div>
</x-layouts.customer>