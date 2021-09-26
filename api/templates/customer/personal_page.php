<div class="bg-white rounded shadow-lg">

  <div class="p-5 border-b border-gray-200">
    <h1 class="text-4xl text-gray-800 font-semibold">Personal Info</h1>
  </div>

  <div class="p-5 border-b border-gray-200">
    <div class="text-xl mb-4 font-semibold">Contact</div>
    <form action="<?= url('?page=personal') ?>" method="POST">
      <?= __method('PATCH') ?>
      <input type="hidden" name="type" value="contact"/>
      <div class="grid lg:grid-cols-2 gap-5 mb-5">
        <div class="text-gray-800">
          <label>Firstname: </label>
          <input 
            type="text" 
            name="firstname" 
            class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none"
            value="<?= $user->firstname ?>" 
            required 
          />
          <?php if($validator->isNotValid('firstname')) : ?>
            <span class="text-red-500 text-sm">
              <?= $validator->getMessage('firstname') ?>
            </span>
          <?php endif; ?> 
        </div>
        <div class="text-gray-800">
          <label>Lastname: </label>
          <input
            type="text" 
            name="lastname" 
            class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none"
            value="<?= $user->lastname ?>" 
            required 
          />
          <?php if($validator->isNotValid('lastname')) : ?>
            <span class="text-red-500 text-sm">
              <?= $validator->getMessage('lastname') ?>
            </span>
          <?php endif; ?> 
        </div>
      </div>
      <div class="text-gray-800 mb-5">
        <label>Phone: </label>
        <input 
          type="text" 
          name="phone" 
          class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none"
          value="<?= $user_info->phone ?>"
        />
      </div>
      <button 
        type="submit" 
        class="block text-center py-2 px-5 ml-auto rounded bg-blue-500 text-white hover:bg-blue-800 focus:outline-none my-1"
        >
        Save
      </button>
    </form>
  </div>

  <div class="p-5">
    <div class="text-xl mb-4 font-semibold">Address</div>
    <form action="<?= url('?page=personal') ?>" method="POST">
      <?= __method('PATCH') ?>
      <input type="hidden" name="type" value="address" />
      <div class="text-gray-800 mb-5">
        <label class="text-sm block mb-1">Region: </label>
        <select 
          class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none" 
          id="checkout_input_region"
          name="region"
        >
          <option value="">-- Select Region --</option>
          <?php foreach ($regions as $key => $value) : ?>
            <option value="<?= __($key) ?>"><?= __($value) ?></option>
          <?php endforeach ?>
        </select>
      </div>

      <div class="grid lg:grid-cols-3 gap-5 mb-5">

        <div class="text-gray-800">
          <label class="text-sm block mb-1">Province: </label>
          <select 
            class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none" 
            id="checkout_input_province" 
            disabled="" 
            name="province"
          >
          </select>
        </div>

        <div class="text-gray-800">
          <label class="text-sm block mb-1">City: </label>
          <select 
            class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none" 
            id="checkout_input_municipality" 
            disabled="" 
            name="municipality"
          >
          </select>
        </div>

        <div class="text-gray-800">
          <label class="text-sm block mb-1">Barangay: </label>
          <select 
            class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none" 
            id="checkout_input_barangay" 
            disabled="" 
            name="barangay" 
          >
          </select>
        </div>
      </div>

      <div class="grid lg:grid-cols-12 gap-5 mb-5">

        <div class="lg:col-span-7 text-gray-800">
          <label class="text-sm block mb-1">Street/Building Name: </label>
          <input 
            type="text" 
            name="street" 
            class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none"
            value="<?= $user_info->street ?>" 
          />
        </div>

        <div class="lg:col-span-5 text-gray-800">
          <label class="text-sm block mb-1">House#/Unit/Floor: </label>
          <input 
            type="text" 
            name="unit" 
            class="font-light block border border-gray-300 w-full p-2 rounded focus:border-blue-500 outline-none"
            value="<?= $user_info->unit ?>" 
          />
        </div>
      </div>

      <button 
        type="submit" 
        class="block text-center py-2 px-5 ml-auto rounded bg-blue-500 text-white hover:bg-blue-800 focus:outline-none my-1"
        >
        Save
      </button>
    </form>
  </div>

</div>