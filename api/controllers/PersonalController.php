<?php

import("components/ProfilePageComponent");
import("controllers/BaseController");
import("controllers/LocationController");
import("models/User");
import("utils/AlertMessage");
import("utils/ValidatorList");

class PersonalController extends BaseController
{

  private $user;
  private $user_info;
  private $validator;

  public function __construct()
  {
    $this->user = User::getCurrentUser();
    $this->user_info = $this->user->getUserInfo();
    $this->validator = new ValidatorList;
  }

  public function get()
  {
    $regions = LocationController::$regions;

    $view = new ProfilePageComponent("personal_template");
    $view->setActivePage("personal");
    $view->setTitle("Personal Info");
    $view->addData("user", $this->user);
    $view->addData("user_info", $this->user_info);
    $view->addData("regions", $regions);
    $view->addData("validator", $this->validator);
    $view->addScript(asset('js/promise-polyfill.min.js'));
    $view->addScript(asset('js/axios.min.js'));
    $view->addScript(asset('js/address.js'));
    $view->render();
  }

  public function patch()
  {
    $type = post('type');
    if ($type == 'contact') {
      return $this->updateContact();
    }
    redirect('?page=personal');
  }

  private function updateContact()
  {
    $this->validator->add("firstname", "required|min:2|max:30|name", "Firstname");
    $this->validator->add("lastname", "required|min:2|max:30|name", "Lastname");

    if ($this->validator->hasError())
      return $this->get();

    $this->user->firstname = post('firstname');
    $this->user->lastname = post('lastname');
    $this->user_info->phone = post('phone');

    $this->user->update();
    $this->user_info->update();

    AlertMessage::success("Contact Info updated successfully");
    redirect('?page=personal');
  }
}