<?php

namespace App\Utils;

class NotFoundException extends \Exception
{
  public function render404()
  {
    view("404_template");
  }

  public function render404JSON()
  {
    json([
      "status" => "failed",
      "message" => "Page not found"
    ]);
  }
}