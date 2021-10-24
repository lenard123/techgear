<?php

namespace App\Utils;

use App\Controllers\BaseController;
use App\Models\BaseModel;
use App\Middlewares\CleanRequestMiddleware;
use App\Middlewares\CustomerOnlyMiddleware;
use App\Middlewares\GuestCustomerOnlyMiddleware;
use App\Middlewares\AdminMiddleware;

class Route
{
  private $action;
  private $controllerClass;
  private $modelClass;
  private $middlewares = [];

  private static $routes = [];
  private static $global_middlewares = [
    CleanRequestMiddleware::class,
  ];

  //Middlewares
  public function testMiddleware()
  {
    $middlewares = array_merge(self::$global_middlewares, $this->middlewares);
    foreach ($middlewares as $middleware) {
      (new $middleware)->test();
    }
  }

  public function guestCustomerOnly()
  {
    $this->addMiddleware(GuestCustomerOnlyMiddleware::class);
  }

  public function adminOnly()
  {
    $this->addMiddleware(AdminMiddleware::class);
  }

  public function customerOnly()
  {
    $this->addMiddleware(CustomerOnlyMiddleware::class);
  }

  public function setCallback(\Closure $cb) : Route
  {
    $this->action = $cb;
    return $this;
  }

  public function addMiddleware($middlewareClass) : Route
  {
    array_push($this->middlewares, $middlewareClass);
    return $this;
  }

  public function setModel($modelClass) : Route
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

  public function setController($controller, $method = null) : Route
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

  //Initilize Router
  private static function init(string $page, string $method) : Route
  {
    $route = new Route;
    self::addRoute($page, $method, $route);
    return $route;
  }

  public static function get(string $page) : Route
  {
    return self::init($page, "GET");
  }

  public static function post(string $page) : Route
  {
    return self::init($page, "POST");
  }

  public static function put(string $page) : Route
  {
    return self::init($page, "PUT");
  }

  public static function patch(string $page) : Route
  {
    return self::init($page, "PATCH");
  }

  public static function delete(string $page) : Route
  {
    return self::init($page, "DELETE");
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

  private static function addRoute(string $page, string $method, Route $route) : void
  {
    if(!isset(self::$routes[$page])) self::$routes[$page] = [];
    self::$routes[$page][$method] = $route;
  }

}