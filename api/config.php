<?php

//url || path
define('BASE_FOLDER', 'online-store');
define('ROOT_PATH', dirname(__DIR__));
define('API_PATH', __DIR__ . '/');

//database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_DATABASE', 'online-store');

define('SITE_NAME', 'TechGear');
define('SITE_SHIPPING_FEE', 38);

define('CACHE_ENABLED', false);
define('CACHE_PROVIDER', 'file');
define('CACHE_EXPIRATION', 60); //In minutes
define('CACHE_FILE_DIR', ROOT_PATH . '/caches');

define('ENV', 'DEBUG');

