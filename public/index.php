<?php

require_once __DIR__ . "/loader.php";

$page = get("page") ?? "home";

load($page);