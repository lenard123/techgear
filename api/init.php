<?php

define('ROOT_PATH', dirname(__DIR__));
define('API_PATH', __DIR__ . '/');

//Intialize Composer Autoloader
require_once ROOT_PATH . '/vendor/autoload.php';

//Load Environment Variables
$dotenv = Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->safeLoad();

//require_once "config.php";
require_once "helpers/util.php";

date_default_timezone_set("Asia/Manila");