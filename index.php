<?php

require_once "api/start.php";

$page = get("page") ?? "home";

load($page);