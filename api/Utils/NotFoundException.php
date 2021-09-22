<?php

namespace App\Utils;

class NotFoundException extends \Exception
{
  public function render404()
  {
    echo "Page not found";
  }

  public function render404JSON()
  {
    json([
      "status" => "failed",
      "message" => "Page not found"
    ]);
  }
}