<?php

//url || path
define('BASE_FOLDER', 'online-store/public');
define('ROOT_PATH', dirname(__DIR__));
define('API_PATH', __DIR__ . '/');

//database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_DATABASE', 'online-store');

/**
 * LOCAL | PRODUCTION
 * 
 * LOCAL
 *  - Will use Js library in assets folder
 * 
 * PRODUCTION
 *  - Will use Js library in cdn
 * 
 * */
define('SITE_ENV', 'LOCAL');
define('SITE_NAME', 'TechGear');
define('SITE_SHIPPING_FEE', 38);

define('CACHE_ENABLED', false);
define('CACHE_PROVIDER', 'file');
define('CACHE_EXPIRATION', 60); //In minutes
define('CACHE_FILE_DIR', ROOT_PATH . '/caches');

