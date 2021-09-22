<?php
namespace App\utils;

import("NotFoundException");
import("models/User");

class Route
{
  public $controller;
  public $model = null;
  public $isModelPrivate = false;
  public $middlewares = [];
  public $isAdmin = false;

  static $global_middlewares = [
    'CleanRequestMiddleware'
  ];

  static $web_middlewares = [];
  static $api_middlewares = [];

  public function __construct($controller, $isAdmin = false)
  {
    $this->isAdmin = $isAdmin;
    $this->controller = $controller;
  }

  public function setModel($model, $isPrivate = false)
  {
    $this->model = $model;
    $this->isModelPrivate = $isPrivate;
    return $this;
  }

  public function addMiddleware($middleware)
  {
    array_push($this->middlewares, $middleware);
    return $this;
  }

  public function proceed()
  {
    $controller = $this->instantiateController();
    $method = $this->getRequestMethod();
    $controller->$method();
  }

  public function getRequestMethod()
  {
    return strtolower(getRequestMethod());
  }

  public function testMiddleware()
  {
    $middlewares = array_merge(self::$global_middlewares, $this->middlewares);
    foreach ($middlewares as $middleware) {
      import("middlewares/$middleware");
      (new $middleware)->test();
    }
  }

  private function instantiateModel()
  {
    $modelClass = $this->model;
    if (is_null($modelClass)) return null; 

    import("models/$modelClass");

    $id = $this->getId();
    $model = $modelClass::find($id);

    if (is_null($model)) throw new NotFoundException();

    if ($this->isModelPrivate && $model->user_id != User::getCurrentUser()->id) throw new NotFoundException;

    return $model;
  }

  private function getId()
  {
    $id = get('id');
    if (is_null($id)) throw new NotFoundException();
    return $id;
  }

  private function instantiateController()
  {
    $model = $this->instantiateModel();
    $controllerClass = $this->controller;

    if ($this->isAdmin)
      import("controllers/admin/$controllerClass");
    else
      import("controllers/$controllerClass");

    $controller = new $controllerClass($model);
    return $controller;
  }

  public static function init($controller)
  {
    return new Route($controller);
  }

  public static function admin($controller)
  {
    return new Route($controller, true);
  }
}