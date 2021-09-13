
<div class="my-5 mx-3 text-center text-gray-700">

  <div class="container max-w-md mx-auto px-2 bg-white px-6 py-8 rounded shadow-md">
    <h1 class="mb-8 text-3xl">Sign Up</h1>

    <form action="<?= url('?page=signup') ?>" method="POST">

      <div class="mb-4 text-left">
        <input 
          type="text" 
          name="firstname" 
          class="font-light block border border-gray-300 w-full p-3 rounded focus:border-blue-500 outline-none" 
          placeholder="First name" 
          value="<?= $validator->getValue('firstname') ?>"
          required
        />
        <?php if($validator->isNotValid('firstname')) : ?>
          <span class="text-red-500 text-sm">
            <?= $validator->getMessage('firstname') ?>
          </span>
        <?php endif; ?> 
      </div>

      <div class="mb-4 text-left">
        <input 
          type="text" 
          name="lastname" 
          class="font-light block border border-gray-300 w-full p-3 rounded focus:border-blue-500 outline-none" 
          placeholder="Last name" 
          value="<?= $validator->getValue('lastname') ?>" 
          required
        />
        <?php if($validator->isNotValid('lastname')) : ?>
          <span class="text-red-500 text-sm">
            <?= $validator->getMessage('lastname') ?>
          </span>
        <?php endif; ?>      
      </div>

      <div class="mb-4 text-left">
        <input 
          type="email" 
          name="email" 
          class="font-light block border border-gray-300 w-full p-3 rounded focus:border-blue-500 outline-none" 
          placeholder="Email"
          value="<?= $validator->getValue('email') ?>"
          required
        />
        <?php if($validator->isNotValid('email')) : ?>
          <span class="text-red-500 text-sm">
            <?= $validator->getMessage('email') ?>
          </span>
        <?php endif; ?>
      </div>

      <div class="mb-4 text-left">
        <input 
          type="password" 
          name="password" 
          class="font-light block border border-gray-300 w-full p-3 rounded focus:border-blue-500 outline-none" 
          placeholder="Password" 
          value="<?= $validator->getValue('password') ?>"
          required 
        />
        <?php if($validator->isNotValid('password')) : ?>
          <span class="text-red-500 text-sm">
            <?= $validator->getMessage('password') ?>
          </span>
        <?php endif; ?>
      </div>

      <div class="mb-4 text-left">
        <input 
          type="password" 
          name="c_password" 
          class="font-light block border border-gray-300 w-full p-3 rounded focus:border-blue-500 outline-none" 
          placeholder="Confirm Password" 
          value="<?= $validator->getValue('c_password') ?>"
          required 
        />
        <?php if($validator->isNotValid('c_password')) : ?>
          <span class="text-red-500 text-sm">
            <?= $validator->getMessage('c_password') ?>
          </span>
        <?php endif; ?>
      </div>

      <button type="submit" class="w-full text-center py-3 rounded bg-blue-500 text-white hover:bg-blue-800 focus:outline-none my-1">Create Account</button>
    </form>

    <div class="text-center text-sm text-grey-dark mt-4">
        By signing up, you agree to the 
        <a class="no-underline border-b border-grey-dark text-grey-dark" href="#">
            Terms of Service
        </a> and 
        <a class="no-underline border-b border-grey-dark text-grey-dark" href="#">
            Privacy Policy
        </a>
    </div>

  </div>

  <div class="text-grey-dark mt-6">
      Already have an account? 
      <a class="no-underline border-b border-blue text-blue" href="<?= url('?page=signin') ?>">
          Log in
      </a>.
  </div>

</div>
