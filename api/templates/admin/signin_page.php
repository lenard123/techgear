<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Sign Up | TechGear Admin</title>
  <link rel="icon" type="image/jpeg" href="<?= asset('img/favicon.ico') ?>" />
  
  <link rel="stylesheet" type="text/css" href="<?= asset('css/tailwind.full.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= asset('css/all.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= asset('css/admin.css') ?>">

</head>

<body class="bg-gray-100 px-4 sm:px-0">

  <!-- Main Card -->
  <main class="bg-white w-full sm:w-3/5 lg:w-1/3 mx-auto rounded-lg my-20 px-4 py-10 shadow-lg">

    <div class="max-w-md w-full mx-auto space-y-8">

      <!-- Brand Name and Logo -->
      <div>      
        <img class="mx-auto h-12 w-auto" src="<?= asset('img/logo.png') ?>" alt="TechGear Logo">
        <h2 class="mb-8 text-center text-xl sm:text-2xl text-gray-700">
          Sign in to your account
        </h2>
      </div>


      <form class="mt-8 space-y-6" action="<?php echo admin('?page=signin')?>" method="POST">
      

        <div class="rounded-md shadow-sm -space-y-px">

          <!-- Email Input -->
          <div >
            <label for="email-address" class="sr-only">Email address</label>
            <input id="email-address" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
          </div>

          <!-- Password Input -->
          <div>
            <label for="password" class="sr-only">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
          </div>
        </div>


        <div class="flex items-center">
          <!-- Remember me Input -->
          <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
          <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
        </div>

        <div>

          <!-- Submit Button -->
          <button type="submit" class="w-full text-center py-3 rounded bg-blue-500 text-white hover:bg-blue-800 focus:outline-none">
            <span>Sign in</span>
          </button>
        </div>
        
      </form>

    </div>
  </main>

<?= \App\Utils\AlertMessage::render() ?>

<script src="<?= asset('lib/alpine.min.js') ?>" defer></script>
<script src="<?= asset('js/app.js') ?>"></script>

</body>
</html>