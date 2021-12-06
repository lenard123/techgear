<x-layouts.customer title="Sign Up">



  <div class="flex flex-col gap-8 max-w-md mx-auto my-8 shadow-lg rounded-md py-6 px-8 | bg-white">

    <h1 class="font-semibold text-2xl text-center text-gray-700">Create an account.</h1>

    <form 
      class="flex flex-col gap-4  | text-sm text-gray-700"
      action="{{ route('signup') }}"
      method="POST" 
      >

      @csrf

      <x-input.text
        class="text-gray-800"
        input-class="simple-input-1"
        error-class="error"
        label="Firstname"
        name="firstname"
        type="text"
        placeholder="Enter your firstname here"
        required
      />

      <x-input.text
        class="text-gray-800"
        input-class="simple-input-1"
        error-class="error"
        label="Lastname"
        name="lastname"
        type="text"
        placeholder="Enter your lastname here"
        required
      />

      <x-input.text
        class="text-gray-800"
        input-class="simple-input-1"
        error-class="error"
        label="Email"
        name="email"
        type="email"
        placeholder="Enter your email here"
        required
      />

      <x-input.text
        class="text-gray-800"
        input-class="simple-input-1"
        error-class="error"
        label="Password"
        name="password"
        type="password"
        placeholder="Enter your password here"
        required
      />

      <x-input.text
        class="text-gray-800"
        input-class="simple-input-1"
        error-class="error"
        label="Confirm Password"
        name="confirm_password"
        type="password"
        placeholder="Re-enter your password here."
        required
      />

      <label class="text-gray-500">
        <input type="checkbox" name="" required />
        <span>By signing up you agree to our terms and conditions</span>
      </label>

      <button type="submit" class="btn btn-primary w-full rounded">Create Account</button>

    </form>

    <div class="text-center text-sm">
      <p class="text-gray-500">Already have an account?</p>
      <a class="text-primary" href="{{ route('login') }}">Log in</a>
    </div>

  </div>

</x-layouts.customer>