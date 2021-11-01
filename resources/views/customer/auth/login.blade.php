<x-layouts.customer title="Login">

  <div class="flex flex-col gap-8 max-w-md mx-auto my-8 shadow-lg rounded-md py-6 px-8 | bg-white">

    <h1 class="font-semibold text-2xl text-center text-gray-700">Login to your account.</h1>


    <form 
      action="{{ route('login') }}"
      method="POST" 
      class="flex flex-col gap-4  | text-sm text-gray-700"
      >

      @csrf

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

      <div class="flex justify-between">

        <label>
          <input type="checkbox" name=""/>
          <span>Remember me</span>
        </label>

        <a href="#">Forgot password?</a>

      </div>

      <button type="submit" class="btn btn-primary w-full rounded">Login</button>

    </form>

    <div class="text-center text-sm">
      <p class="text-gray-500">Don't have an account?</p>
      <a class="text-primary" href="{{ route('signup') }}">Register now</a>
    </div>

  </div>

</x-layouts.customer>