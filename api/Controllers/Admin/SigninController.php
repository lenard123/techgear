<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class SigninController extends BaseController
{

  public function __invoke()
  {
    view("admin/signin_template");
  }

}