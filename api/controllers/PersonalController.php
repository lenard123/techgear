<?php

import("controllers/BaseController");
import("controllers/LocationController");
import("components/ProfilePageComponent");
import("models/User");

class PersonalController extends BaseController
{
  public function get()
  {

    $regions = LocationController::$regions;
    $user = User::getCurrentUser();

    $view = new ProfilePageComponent("personal_template");
    $view->setActivePage("personal");
    $view->setTitle("Personal Info");
    $view->addData("user", $user);
    $view->addData("regions", $regions);
    $view->addScript(asset('js/promise-polyfill.min.js'));
    $view->addScript(asset('js/axios.min.js'));
    $view->addScript(asset('js/address.js'));
    $view->render();
  }
}