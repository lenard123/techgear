<x-layouts.main class="bg-gray-100 px-4 sm:px-0" title="Admin Login">
  @push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
  @endpush

  <main class="bg-white w-full sm:w-3/5 lg:w-1/3 mx-auto rounded-lg my-20 px-4 py-10 shadow-lg">

    <div class="max-w-md w-full mx-auto space-y-8">

      <!-- Brand Name and Logo -->
      <div>      
        <img class="mx-auto h-12 w-auto" src="<?= asset('img/logo.png') ?>" alt="TechGear Logo">
        <h2 class="mb-8 text-center text-xl sm:text-2xl text-gray-700">
          Sign in to your admin account
        </h2>
      </div>

      <form class="mt-8 space-y-4 px-4 text-sm" method="POST" action="{{ route('admin.login') }}">

        @csrf

        @error('message')
        <div class="bg-red-200 px-5 py-2 rounded border border-red-300 text-red-500">
          {{ $message }}
        </div>
        @enderror

        <x-input.text
          class="text-gray-800"
          input-class="simple-input-1"
          error-class="error"
          label-class="font-light"
          label="Email"
          name="email"
          placeholder="Enter your email here"
          type="email"
          required
        />

        <x-input.text
          class="text-gray-800"
          input-class="simple-input-1"
          error-class="error"
          label-class="font-light"
          label="Password"
          name="password"
          placeholder="Enter your password here"
          type="password"
          required
        />

        <div class="flex justify-between text-gray-800">

          <label>
            <input type="checkbox" name="remember"/>
            <span>Remember me</span>
          </label>

          <a href="#">Forgot password?</a>

        </div>

        <button type="submit" class="btn btn-primary w-full">Submit</button>

      </form>

    </div>

  </main>

</x-layouts.main>