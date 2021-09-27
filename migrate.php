<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/api/start.php';

use App\Utils\AlertMessage;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (post('password') == 'reset_database') {
    $user = DB_USER;
    $pass = empty(DB_PASS) ? '' : ':' . DB_PASS;
    $host = DB_HOST;
    $db = DB_DATABASE;

    $uri = new \ByJG\Util\Uri("mysql://{$user}{$pass}@{$host}/{$db}");

    $migration = new \ByJG\DbMigration\Migration($uri, __DIR__);
    $migration->registerDatabase('mysql', \ByJG\DbMigration\Database\MySqlDatabase::class);

    $migration->addCallbackProgress(function ($action, $currentVersion, $fileInfo) {
        AlertMessage::success('Database Reset Successfully');
    });

    $migration->prepareEnvironment();

    $migration->reset();
  } else {
    AlertMessage::failed('Wrong Password!');
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Reset Database</title>
  <link rel="stylesheet" type="text/css" href="<?= url('assets/css/tailwind.min.css') ?>">
</head>
<body class="bg-gray-50 px-3">

  <div class="bg-white mx-auto w-full md:w-2/3 lg:w-1/2 rounded border border-gray-200 my-10">
    <div class="text-gray-700 py-2 px-3 flex items-center border-b border-gray-200">
      <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" class="mt-1 mr-2 inline-block" viewBox="0 0 20 20" fill="currentColor">
        <path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z" />
        <path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z" />
        <path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z" />
      </svg>
      <span class="inline-block">Reset Database</span>
    </div>

    <div class="p-5">
      <form action="" method="POST">
        <div class="mb-5">
          <label class="text-gray-500">Password: </label>
          <input 
            class="focus:outline-none border border-gray-100 focus:border-blue-500 py-2 px-3 rounded w-full" 
            type="password" 
            name="password"
            placeholder="Enter password here" 
            required="" 
          />
        </div>

        <button 
          type="submit" 
          class="bg-blue-500 border border-blue-500 hover:bg-blue-600 rounded px-5 py-2 w-full md:w-auto text-white"
        >Submit</button>

      </form>
    </div>

  </div>

<?= AlertMessage::render(); ?>

<script src="<?= url('assets/js/babel-polyfill.min.js') ?>"></script>
<script src="<?= url('assets/js/alpine.min.js') ?>" defer></script>
<script src="<?= url('assets/js/app.js') ?>"></script>

</body>
</html>