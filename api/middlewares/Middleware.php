<?php

namespace App\Middlewares;

class Middleware {
  
  protected function handle()
  {
  }

  protected function fallback()
  {
    return false;
  }

  public function test ()
  {
    if (!$this->handle()) {
      $this->fallback();
      exit();
    }
  }
}