<?php

return [
  'enabled' => env('CACHE_ENABLED', false),
  'provider' => env('CACHE_PROVIDER', 'file'),
  'expiration' => env('CACHE_EXPIRATION', 60), //Minutes
  'file_dir' => ROOT_PATH . env('CACHE_FILE_DIR', '/caches'),
  'redis_url' => env('CACHE_REDIS_URL'), 
];