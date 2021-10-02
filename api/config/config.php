<?php

function env($var, $default = null)
{
  return $_ENV[$var] ?? $default;
}

return [
  'app' => require('app.php'),
  'cache' => require('cache.php'),
  'db' => require('database.php'),
  'storage' => require('storage.php'),
];