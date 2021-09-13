<?php

import("controllers/BaseController");
import("utils/AlertMessage");
import("models/User");

class SignoutController extends BaseController
{
  public function post()
  {
    User::getCurrentUser()->logout();
    AlertMessage::success("Logout Successfully");
    redirect("?page=signin");
  }
}