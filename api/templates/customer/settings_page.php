<div class="card">

  <div class="p-5 border-b border-gray-200">
    <h1 class="text-4xl text-gray-800 font-semibold">Settings</h1>
  </div>

  <div class="p-5 border-b border-gray-200">
    <div class="text-xl mb-4 font-semibold">Email</div>
    <form action="<?= url('?page=settings') ?>" method="POST">
      <?= __method('PATCH') ?>
      <input type="hidden" name="type" value="email" />

      <div class="text-gray-800 mb-5">
        <label>Current Email: </label>
        <input 
          type="email" 
          class="font-light block border border-gray-300 w-full lg:w-3/5 p-2 rounded focus:border-blue-500 outline-none"
          value="<?= $user->email ?>" 
          disabled="" 
        />
      </div>

      <div class="text-gray-800 mb-5">
        <label>New Email: </label>
        <input 
          type="email" 
          name="new_email" 
          class="font-light block border border-gray-300 w-full lg:w-3/5 p-2 rounded focus:border-blue-500 outline-none"
          required
        />
        <?php if($validator->isNotValid('new_email')) : ?>
          <span class="text-red-500 text-sm">
            <?= $validator->getMessage('new_email') ?>
          </span>
        <?php endif; ?> 
      </div>

      <button 
        type="submit" 
        class="block text-center py-2 px-5 rounded bg-blue-500 text-white hover:bg-blue-800 focus:outline-none my-1"
        >
        Update Email
      </button>

    </form>
  </div>

  <div class="p-5 border-b border-gray-200">
    <div class="text-xl mb-4 font-semibold">Password</div>
    <form action="<?= url('?page=settings') ?>" method="POST">
      <?= __method('PATCH') ?>
      <input type="hidden" name="type" value="password" />

      <div class="text-gray-800 mb-5">
        <label>Current Password: </label>
        <input 
          type="password" 
          class="font-light block border border-gray-300 w-full lg:w-3/5 p-2 rounded focus:border-blue-500 outline-none"
          name="current_password"
          value="<?= $validator->getValue('current_password') ?>" 
          required="" 
        />
        <?php if($validator->isNotValid('current_password')) : ?>
          <span class="text-red-500 text-sm">
            <?= $validator->getMessage('current_password') ?>
          </span>
        <?php endif; ?> 
      </div>

      <div class="text-gray-800 mb-5">
        <label>New Password: </label>
        <input 
          type="password" 
          name="new_password" 
          class="font-light block border border-gray-300 w-full lg:w-3/5 p-2 rounded focus:border-blue-500 outline-none"
          required
          value="<?= $validator->getValue('new_password') ?>"
        />
        <?php if($validator->isNotValid('new_password')) : ?>
          <span class="text-red-500 text-sm">
            <?= $validator->getMessage('new_password') ?>
          </span>
        <?php endif; ?> 
      </div>

      <div class="text-gray-800 mb-5">
        <label>Confirm Password: </label>
        <input 
          type="password" 
          name="c_password" 
          class="font-light block border border-gray-300 w-full lg:w-3/5 p-2 rounded focus:border-blue-500 outline-none"
          required
          value="<?= $validator->getValue('c_password') ?>"
        />
        <?php if($validator->isNotValid('c_password')) : ?>
          <span class="text-red-500 text-sm">
            <?= $validator->getMessage('c_password') ?>
          </span>
        <?php endif; ?> 
      </div>

      <button 
        type="submit" 
        class="block text-center py-2 px-5 rounded bg-blue-500 text-white hover:bg-blue-800 focus:outline-none my-1"
        >
        Update Password
      </button>

    </form>
  </div>

</div>