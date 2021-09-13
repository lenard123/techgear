<?php

import("middlewares/Middleware");

class CleanRequestMiddleware extends Middleware
{
  protected function handle()
  {
    foreach($_GET as $key => $value)
      $_GET[$key] = trim($value);


    foreach($_POST as $key => $value)
      $_POST[$key] = trim($value);
    
    return true;
  }
}