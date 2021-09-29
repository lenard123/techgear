<?php

require_once "../loader.php";

$page = get("page") ?? "home";

loadAdmin($page);