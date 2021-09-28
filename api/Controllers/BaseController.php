<?php

namespace App\Controllers;

use App\Components\BaseComponent;

class BaseController
{
  public function render(BaseComponent $page)
  {
    echo $page->render();
  }
}