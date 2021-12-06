<x-layouts.admin title="Confirm Password">

  <div class="p-4">
    <div class="w-full max-w-2xl mx-auto bg-white shadow-lg rounded">

      <div class="py-3 px-4 border-b border-gray-200">
        <h1 class="text-gray-800 font-semibold">Confirm Password</h1>
      </div>

      <div class="p-4">
        <form action="{{ route('password.confirm') }}" method="POST">
          @csrf

          <p class="text-gray-800 text-sm">This is a secured area of the application. Please enter your password to continue</p>

          <x-input.text
            class="mt-4"
            label-class="text-gray-800"
            input-class="simple-input-1"
            error-class="error"
            type="text"
            required
            label="Password"
            name="password"
          />

          <div class="flex justify-end mt-4">
            <button class="btn btn-primary rounded">Confirm</button>
          </div>

        </form>
      </div>
    </div>
  </div>

</x-layouts.admin>