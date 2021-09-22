<?php

namespace App\Utils;

use App\Controllers\BaseController;
use App\Models\BaseModel;

class Route2
{
  private $action;
  private $controllerClass;
  private $modelClass;
  private $middlewares = [];

  private static $routes = [];
  private static $global_middlewares = [
    \App\Middlewares\CleanRequestMiddleware::class,
  ];

  public function testMiddleware()
  {
    $middlewares = array_merge(self::$global_middlewares, $this->middlewares);
    foreach ($middlewares as $middleware) {
      (new $middleware)->test();
    }
  }

  public function setCallback(\Closure $cb) : Route2
  {
    $this->action = $cb;
    return $this;
  }

  public function addMiddleware($middlewareClass) : Route2
  {
    array_push($this->middlewares, $middlewareClass);
    return $this;
  }

  public function setModel($modelClass) : Route2
  {
    $this->modelClass = $modelClass;
    return $this;
  }

  public function getModelObject() : BaseModel
  {
    $id = get('id');
    $modelClass = $this->modelClass;
    $obj = $modelClass::find($id);
    if (is_null($obj)) throw new NotFoundException;
    return $obj;
  }

  public function getControllerObject() : BaseController
  {
    $controllerClass = $this->controllerClass;
    if (is_null($this->modelClass))
      return new $controllerClass;
    $model = $this->getModelObject();
    return new $controllerClass($model);
  }

  public function setController($controller, $method = null) : Route2
  {
    $this->controllerClass = $controller;

    $route = $this;

    if (is_null($method)) {
      $this->action = function () use ($route) {
        $obj = $route->getControllerObject();
        call_user_func($obj);
      };
    } else {
      $this->action = function () use ($route, $method) {
        $obj = $route->getControllerObject();
        call_user_func([$obj, $method]);
      };
    }

    return $route;
  }

  public static function get(string $page) : Route2
  {
    $route = new Route2;
    self::addRoute($page, "GET", $route);
    return $route;
  }

  public static function post(string $page) : Route2
  {
    $route = new Route2;
    self::addRoute($page, "POST", $route);
    return $route;
  }

  public static function load($page) : void
  {
    $method = getRequestMethod();
    if (!isset(self::$routes[$page])) throw new NotFoundException;
    if (!isset(self::$routes[$page][$method])) throw new NotFoundException;
    
    $route = self::$routes[$page][$method];
    $route->testMiddleware();
    ($route->action)();
  }

  private static function addRoute(string $page, string $method, Route2 $route) : void
  {
    if(!isset(self::$routes[$page])) self::$routes[$page] = [];
    self::$routes[$page][$method] = $route;
  }

}