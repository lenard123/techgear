<?php

namespace App\Controllers;

use App\Utils\AlertMessage;
use App\Models\User;

class SignoutController extends BaseController
{
  public function post()
  {
    User::getCurrentUser()->logout();
    AlertMessage::success("Logout Successfully");
    redirect("?page=signin");
  }
}