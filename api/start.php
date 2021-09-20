<?php

require_once "init.php";
require_once "routing/api.php";
require_once "routing/web.php";
require_once "routing/admin.php";

import("NotFoundException");

function load($page)
{
  global $web_routes;

  try{
    $route = $web_routes[$page] ?? $web_routes["home"];
    $route->testMiddleware();
    $route->proceed();
  } catch (NotFoundException $ex) {
    $ex->render404();
  }
}

function loadAdmin($page)
{
  global $admin_routes;
  try{
    if (!isset($admin_routes[$page])) throw new NotFoundException();
    $route = $admin_routes[$page];
    $route->testMiddleware();
    $route->proceed();
  } catch (NotFoundException $ex) {
    $ex->render404();
  } 
}

function loadApi($page)
{
  global $api_routes;
  try {
    if (!isset($api_routes[$page])) throw new NotFoundException();
    $route = $api_routes[$page];
    $route->testMiddleware();
    $route->proceed();

  } catch (NotFoundException $ex) {
    $ex->render404JSON();
  }
}
