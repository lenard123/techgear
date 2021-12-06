<x-profile-page title="Profile">
  <div class="bg-white rounded shadow">

    <div class="p-5 border-b border-gray-200">
      <h1 class="text-4xl text-gray-800 font-semibold">Personal Info</h1>
    </div>

    <div class="p-5 border-b border-gray-200">
      <div class="text-xl mb-4 font-semibold">Contact</div>

      <form method="POST" action="{{ route('profile.updateContact') }}">
        @method('PATCH')
        @csrf
        <div class="grid lg:grid-cols-2 gap-5 mb-5">

          <x-input.text
            class="text-gray-800"
            input-class="simple-input-1"
            error-class="error"
            label="Firstname"
            name="firstname"
            :value="$user->firstname"
            type="text"
            required
          />

          <x-input.text
            class="text-gray-800"
            input-class="simple-input-1"
            error-class="error"
            label="Lastname"
            name="lastname"
            :value="$user->lastname"
            type="text"
            required
          />

        </div>

        <x-input.text
          class="text-gray-800"
          input-class="simple-input-1"
          error-class="error"
          label="Phone"
          name="phone"
          :value="$user_info->phone"
          type="text"
        />

        <button type="submit" class="btn btn-primary mt-5 rounded">Submit</button>

      </form>
    </div>

    <div class="p-5">
      <div class="text-xl mb-4 font-semibold">Address</div>

      <form action="{{ route('profile.updateAddress') }}" method="POST">
        @csrf
        @method('PATCH')
        <div 
          class="grid lg:grid-cols-3 gap-5"
          x-data='address(@json($address->cache), @json($address->selected))'
          >

          {{-- Regions Input --}}
          <div class="lg:col-span-3" x-data="resetErrorValidation">
            <label class="text-gray-800">Region</label>
            <select 
              class="simple-input-1"
              x-model="selected.region"
              :disabled="cache.regions.length === 0"
              name="region_id"
              >
              <option value="">-- Select Region --</option>
              <template x-for="region in cache.regions" :key="region.region_id">
                <option x-text="region.name" :selected="region.region_id === selected.region" :value="region.region_id"></option>
              </template>
            </select>
          </div>

          {{-- Provinces Input --}}
          <div x-data="resetErrorValidation">
            <label class="text-gray-800">Province</label>
            <select 
              class="simple-input-1" 
              x-model="selected.province"
              :disabled="filteredProvinces.length === 0"
              name="province_id"
              >
              <option value="">-- Select Province --</option>
              <template x-for="province in filteredProvinces" :key="province.id">
                <option x-text="province.name" :selected="province.province_id === selected.province" :value="province.province_id"></option>
              </template>
            </select>
          </div>

          {{-- Cities --}}
          <div x-data="resetErrorValidation">
            <label class="text-gray-800">City</label>
            <select 
              class="simple-input-1" 
              x-model="selected.city"
              :disabled="filteredCities.length === 0"
              name="city_id"
              >
              <option value="">-- Select City --</option>
              <template x-for="city in filteredCities" :key="city.id">
                <option x-text="city.name" :selected="city.city_id === selected.city" :value="city.city_id"></option>
              </template>
            </select>
          </div>

          {{-- Barangay --}}
          <div x-data="resetErrorValidation">
            <label class="text-gray-800">Barangay</label>
            <select 
              class="simple-input-1" 
              x-model="selected.barangay"
              :disabled="filteredBarangays.length === 0"
              name="barangay_id"
              >
              <option value="">-- Select Barangay --</option>
              <template x-for="barangay in filteredBarangays" :key="barangay.id">
                <option x-text="barangay.name" :selected="barangay.code === selected.barangay" :value="barangay.code"></option>
              </template>
            </select>
          </div>

          <x-input.text
            class="text-gray-800 lg:col-span-2"
            input-class="simple-input-1"
            error-class="error"
            label="Street/Building Name: "
            name="street"
            :value="$user_info->street"
            type="text"
            required
          />

          <x-input.text
            class="text-gray-800"
            input-class="simple-input-1"
            error-class="error"
            label="House#/Unit/Floor: "
            name="unit"
            :value="$user_info->unit"
            type="text"
            required
          />

        </div>

        <button type="submit" class="btn btn-primary mt-5 rounded">Submit</button>
      </form>

    </div>

  </div>

  @push('postScripts')
    <script src="{{ asset('js/checkout.js') }}"></script>
  @endpush

</x-profile-page>