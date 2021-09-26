
<div class="my-5 mx-3 text-center text-gray-700">

  <div class="container max-w-md mx-auto px-2 bg-white px-6 py-8 rounded shadow-md">
    <h1 class="mb-8 text-3xl">Login</h1>

    <form action="<?= url('?page=signin') ?>" method="POST">

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

      <div class="mb-2 text-left">
        <input 
          type="password" 
          name="password" 
          class="font-light block border border-gray-300 w-full p-3 rounded focus:border-blue-500 outline-none" 
          placeholder="Password" 
          required 
        />
        <?php if($validator->isNotValid('password')) : ?>
          <span class="text-red-500 text-sm">
            <?= $validator->getMessage('password') ?>
          </span>
        <?php endif; ?>
      </div>

      <div class="mb-4 text-left">
        <label>
          <input type="checkbox" name="remember" checked="" />
          Remember me</label>
      </div>

      <button type="submit" class="w-full text-center py-3 rounded bg-blue-500 text-white hover:bg-blue-800 focus:outline-none my-1">Sign in</button>
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
      Don't have an account? 
      <a class="no-underline border-b border-blue text-blue" href="<?= url('?page=signup') ?>">
          Sign up here.
      </a>.
  </div>

</div>
