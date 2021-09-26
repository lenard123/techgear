<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Utils\AlertMessage;
use App\Models\User;

class SignoutController extends BaseController
{
  public function __invoke()
  {
    User::getCurrentUser()->logout();
    AlertMessage::success("Logout Successfully");
    redirect("?page=signin");
  }
}