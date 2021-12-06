<x-profile-page title="Settings">
  <div class="bg-white rounded shadow">

    <div class="p-5 border-b border-gray-200">
      <h1 class="text-4xl text-gray-800 font-semibold">Settings</h1>
    </div>

    <div class="p-5 border-b border-gray-200">
      <div class="text-xl mb-4 font-semibold">Email</div>
      <form method="POST" action="{{ route('settings.updateEmail') }}">
        @csrf
        @method('PATCH')

        <x-input.text
          class="text-gray-800 lg:w-3/5"
          input-class="simple-input-1"
          error-class="error"
          label="Current Email"
          name="current_email"
          type="email"
          :value="auth()->user()->email"
          disabled
        />

        <x-input.text
          class="text-gray-800 lg:w-3/5 mt-5"
          input-class="simple-input-1"
          error-class="error"
          label="New Email"
          name="email"
          type="email"
          required
        />

        <button type="submit" class="btn btn-primary rounded mt-5">Update Email</button>

      </form>
    </div>

    <div class="p-5 border-b border-gray-200">
      <div class="text-xl mb-4 font-semibold">Password</div>

      <form action="{{ route('settings.updatePassword') }}" method="POST">
        @csrf
        @method('PATCH')

        <x-input.text
          class="text-gray-800 lg:w-3/5"
          input-class="simple-input-1"
          error-class="error"
          label="Current Password"
          name="current_password"
          type="password"
          required
        />

        <x-input.text
          class="text-gray-800 lg:w-3/5 mt-5"
          input-class="simple-input-1"
          error-class="error"
          label="New Password"
          name="password"
          type="password"
          required
        />

        <x-input.text
          class="text-gray-800 lg:w-3/5 mt-5"
          input-class="simple-input-1"
          error-class="error"
          label="Confirm Password"
          name="confirm_password"
          type="password"
          required
        />

        <button type="submit" class="btn btn-primary rounded mt-5">Update Password</button>

      </form>

    </div>

  </div>
</x-profile-page>