<x-layouts.admin title="Customers">

  <div class="p-8">
    <div class="bg-white rounded shadow-lg">

      <div class="p-4 border-b border-gray-200">
        <span class="font-semibold text-lg text-gray-800">All Customers</span>
      </div>

      <div class="p-4">

        <div class="grid grid-cols-6 font-semibold text-sm border-b border-gray-200 p-4 gap-4">

          <span class="col-span-2 ml-9">Name</span>
          <span class="col-span-2">Email</span>
          <span>Joined Date</span>
          <span class="text-right">Options</span>


        </div>

        @foreach($customers as $customer)
          <div class="grid grid-cols-6 items-center border-b border-gray-200 p-4 text-sm gap-2 text-gray-800">
            <div class="col-span-2 flex items-center gap-3">
              <div class="h-8 w-8">
                <img src="{{ $customer->imageUrl }}" class="h-full w-full rounded-full"/>
              </div>
              <div>{{ $customer->fullname }}</div>
            </div>
            <div class="col-span-2">{{ $customer->email }}</div>
            <div>{{ $customer->created_at->diffForHumans() }}</div>
            <div>
              <div class="flex justify-end gap-2">
                <a href="{{ route('admin.customers.profile', $customer) }}" class="border border-green-200 bg-green-100 p-2 rounded-full text-green-400 hover:bg-green-400 hover:text-white hover:border-green-400 transition-all">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                </a>
              </div>
            </div>
          </div>
        @endforeach

      </div>

      <div class="py-4 px-8">
        {{ $customers->links() }}
      </div>

    </div>
  </div>

</x-layouts.admin>