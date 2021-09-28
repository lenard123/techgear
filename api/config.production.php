<?php

//url || path
define('BASE_FOLDER', '');
define('ROOT_PATH', dirname(__DIR__));
define('API_PATH', __DIR__ . '/');

//database
define('DB_HOST', 'us-cdbr-east-04.cleardb.com');
define('DB_USER', 'ba88f006ccc135');
define('DB_PASS', '4c6e529c');
define('DB_DATABASE', 'heroku_670757a0b92e8ee');

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
define('SITE_ENV', 'PRODUCTION');
define('SITE_NAME', 'TechGear');
define('SITE_SHIPPING_FEE', 38);

define('CACHE_ENABLED', true);
define('CACHE_PROVIDER', 'redis');
define('CACHE_EXPIRATION', 60); //In minutes
define('CACHE_FILE_DIR', ROOT_PATH . '/caches');
define('CACHE_REDIS_URL', 'redis://:pf5c0c0d8dd1eaa1b2f5b6c03a0f2fa1e2e2126ff471e1a474794d73fd6e64e11@ec2-18-205-48-13.compute-1.amazonaws.com:27819');

