<x-layouts.main title="Reset Password" class="bg-gray-100 px-4 sm:px-0">

  @push('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
  @endpush

  <main class="bg-white w-full sm:w-3/5 lg:w-1/3 mx-auto rounded-lg my-20 px-4 py-10 shadow-lg">

    <div class="max-w-md w-full mx-auto space-y-8">

      <!-- Brand Name and Logo -->
      <div>      
        <img class="mx-auto h-12 w-auto" src="<?= asset('img/logo.png') ?>" alt="TechGear Logo">
        <h2 class="mb-8 text-center text-xl sm:text-2xl text-gray-700">
          Reset Password
        </h2>
      </div>


      <form method="POST" action="{{ route('password.update') }}">
          @csrf

          <!-- Password Reset Token -->
          <input type="hidden" name="token" value="{{ $request->token }}">

          <!-- Email Address -->
          <div>
              <x-input.text
                name="email"
                type="email"
                input-class="simple-input-1"
                error-class="error"
                label="Email"
                :value="$request->email"
                required
                autofocus
              />

          </div>

          <!-- Password -->
          <div class="mt-4">
              <x-input.text
                name="password"
                type="password"
                label="Password"
                input-class="simple-input-1"
                error-class="error"
                required
              />
          </div>

          <!-- Confirm Password -->
          <div class="mt-4">
            <x-input.text
              name="password_confirmation"
              label="Confirm Password"
              required
              input-class="simple-input-1"
              error-class="error"
              type="password"
            />
          </div>

          <div class="flex items-center justify-end mt-4">
            <button type="submit" class="btn btn-primary rounded">Submit</button>
          </div>
      </form>
    </div>

  </main>

</x-layouts.main>