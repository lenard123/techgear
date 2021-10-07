<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="description" content="Page not found">
  <title>Sign Up | TechGear Admin</title>
  <link rel="icon" type="image/jpeg" href="<?= url('assets/img/favicon.ico') ?>" />
  
  <link rel="stylesheet" type="text/css" href="<?= url('assets/css/tailwind.min.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= asset('css/tailwind.full.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= asset('css/all.css') ?>">
  <link rel="stylesheet" type="text/css" href="<?= asset('css/admin.css') ?>">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Iceland&display=swap" rel="stylesheet"> 
</head>
<body class="bg-white">

<div class="bg-white w-full lg:w-1/3 mx-auto rounded-lg lg:my-20 px-4 py-10 shadow-lg sm:w-2/3">
  <div class="max-w-md w-full space-y-8">
    
    <div>
      
        <img class="mx-auto h-12 w-auto" src="<?= url('assets/img/favicon.ico') ?>" alt="Workflow">
      
      <h2 class="mb-8 text-center text-3xl text-gray-700">
        Sign in to your account
      </h2>

    </div>

    <form class="mt-8 space-y-6" action="#" method="POST">
      <input type="hidden" name="remember" value="true">
      
      <div class="rounded-md shadow-sm -space-y-px">
        <div >
          <label for="email-address" class="sr-only">Email address</label>
          <input id="email-address" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
        </div>

        <div>
          <label for="password" class="sr-only">Password</label>
          <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
        </div>

      </div>

      <div class="flex items-center justify-between">

        <div class="flex items-center">
          <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
          <label for="remember-me" class="ml-2 block text-sm text-gray-900">
            Remember me
          </label>
        </div>

      </div>

      <div>
        <button type="submit" class="w-full text-center py-3 rounded bg-blue-500 text-white hover:bg-blue-800 focus:outline-none">
          <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            <!-- Heroicon name: solid/lock-closed -->
          </span>
          Sign in
        </button>
      </div>
      
    </form>

  </div>
</div>

</body>
</html>