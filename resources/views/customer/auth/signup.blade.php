<x-layouts.customer title="Sign Up">



  <div class="flex flex-col gap-8 max-w-md mx-auto my-8 shadow-lg rounded-md py-6 px-8 | bg-white">

    <h1 class="font-semibold text-2xl text-center text-gray-700">Create an account.</h1>

    <form 
      class="flex flex-col gap-4  | text-sm text-gray-700"
      action="{{ route('signup') }}"
      method="POST" 
      >

      @csrf

      <x-simple-input
        label="Firstname"
        name="firstname"
        placeholder="Enter your firstname here"
        :isRequired="true"
      />

      <x-simple-input
        label="Lastname"
        name="lastname"
        placeholder="Enter your lastname here"
        :isRequired="true"
      />

      <x-simple-input
        label="Email"
        name="email"
        placeholder="Enter your email here"
        :isRequired="true"
        type="email"
      />

      <x-simple-input
        label="Password"
        name="password"
        placeholder="Enter your password here"
        :isRequired="true"
        type="password"
      />

      <x-simple-input
        label="Confirm Password"
        name="confirm_password"
        placeholder="Confirm your password here"
        :isRequired="true"
        type="password"
      />

      <label class="text-gray-500">
        <input type="checkbox" name=""/>
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