<?php

namespace App\Controllers\Customer;

use App\Components\ProfilePageComponent;
use App\Utils\AlertMessage;
use App\Utils\ValidatorList;
use App\Models\User;

class SettingsController extends CustomerController
{

  private $user;
  private $validator;

  public function __construct()
  {
    $this->user = User::getCurrentUser();
    $this->validator = new ValidatorList;
  }

  public function get()
  {
    $view = new ProfilePageComponent("settings_page");
    $view->setTitle("Settings");
    $view->addContentData("validator", $this->validator);
    $view->addContentData("user", $this->user);

    $this->render($view);
  }

  public function patch()
  {
    $type = post('type');
    if ($type == 'email') {
      return $this->updateEmail();
    } else if ($type == 'password') {
      return $this->updatePassword();
    }
    redirect('?page=settings');
  }

  public function updatePassword()
  {
    $this->validator->add("current_password", "required|min:8", "Current Password");
    $this->validator->add("new_password", "required|min:8", "New Password");
    $this->validator->add("c_password", "required|min:8|compare:new_password", "Confirm Password");

    if (!password_verify(post('current_password'), $this->user->password)) {
      $this->validator->fail('current_password', 'Wrong password!');
    }

    if ($this->validator->hasError()) {
      return $this->get();
    }

    $this->user->setPassword(post('new_password'));
    $this->user->update();

    AlertMessage::success("Password updated successfully");
    redirect('?page=settings');
  }

  public function updateEmail()
  {
    $this->validator->add("new_email", "required|email|unique:users,email,{$this->user->email}", "New Email");

    if ($this->validator->hasError())
      return $this->get();

    $this->user->changeEmail(post('new_email'));

    AlertMessage::success("Email updated successfully");
    redirect("?page=settings");
  }
}