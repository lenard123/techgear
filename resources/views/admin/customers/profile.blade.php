<x-layouts.customer-profile class="text-gray-800" :customer="$customer">

  <div class="mb-4">
    <div class="text-xl font-semibold">Contact</div>
  </div>

  <div class="grid grid-cols-3 border-b border-gray-100">
    <div class="text-gray-500">Email: </div>
    <div class="text-gray-700 col-span-2">{{ $customer->email }}</div>
  </div>

  <div class="grid grid-cols-3 border-b border-gray-100">
    <div class="text-gray-500">Phone: </div>
    <div class="text-gray-700 col-span-2">{{ $customer_info->phone }}</div>
  </div>

  <div class="mt-8 mb-4">
    <div class="text-xl font-semibold">Address</div>
  </div>

  <div class="grid grid-cols-3 border-b border-gray-100">
    <div class="text-gray-500">Region: </div>
    <div class="text-gray-700 col-span-2">{{ $customer_info->region->name }}</div>
  </div>

  <div class="grid grid-cols-3 border-b border-gray-100">
    <div class="text-gray-500">Province: </div>
    <div class="text-gray-700 col-span-2">{{ $customer_info->province->name }}</div>
  </div>

  <div class="grid grid-cols-3 border-b border-gray-100">
    <div class="text-gray-500">City: </div>
    <div class="text-gray-700 col-span-2">{{ $customer_info->city->name }}</div>
  </div>

  <div class="grid grid-cols-3 border-b border-gray-100">
    <div class="text-gray-500">Barangay: </div>
    <div class="text-gray-700 col-span-2">{{ $customer_info->barangay->name }}</div>
  </div>

  <div class="grid grid-cols-3 border-b border-gray-100">
    <div class="text-gray-500">Street: </div>
    <div class="text-gray-700 col-span-2">{{ $customer_info->street }}</div>
  </div>

  <div class="grid grid-cols-3 border-b border-gray-100">
    <div class="text-gray-500">Unit: </div>
    <div class="text-gray-700 col-span-2">{{ $customer_info->unit }}</div>
  </div>

</x-layouts.customer-profile>
