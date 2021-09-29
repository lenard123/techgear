<?php

$dir = pathinfo(__DIR__)["basename"];
if ($dir == "public") {
  require_once dirname(__DIR__) . '/api/start.php';
} else {
  require_once __DIR__ . '/api/start.php';
}
