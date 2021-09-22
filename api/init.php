<?php

require_once "config.php";
require_once ROOT_PATH . '/vendor/autoload.php';
require_once "helpers/util.php";

$session_options = [];
$session_options["cookie_secure"] = isSecure();
$session_options["cookie_samesite"] = "Lax";
session_start();

date_default_timezone_set("Asia/Manila");
