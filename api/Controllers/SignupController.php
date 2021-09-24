<?php

namespace App\Controllers;

use App\Components\CustomerPageComponent;
use App\Models\User;
use App\Utils\ValidatorList;
use App\Utils\AlertMessage;

class SignupController extends BaseController
{

  private $validator = null;

  public function __construct()
  {
    $this->validator = new ValidatorList;
  }

  public function __invoke()
  {

    $validator = $this->validator;

    $view = new CustomerPageComponent("signup_template");
    $view->setTitle("Sign Up");
    $view->addData("validator", $validator);
    $view->render();
  }

  public function process()
  {
    $this->validate();

    if ($this->validator->hasError()) {
      $this->__invoke();
      return;
    }

    $user = $this->saveUser();
    $user->login(post('password'));

    AlertMessage::success('Registered Successfully');
    redirect('');
  }

  private function saveUser()
  {
    $user = new User;
    $user->role = USER::ROLE_CUSTOMER;
    $user->email = post('email');
    $user->setPassword(post('password'));
    $user->firstname = post('firstname');
    $user->lastname = post('lastname');
    $user->save();

    return $user;
  }

  private function validate()
  {
    $this->validator->add("firstname", "required|min:2|max:30|name", "Firstname");
    $this->validator->add("lastname", "required|min:2|max:30|name", "Lastname");
    $this->validator->add("email", "required|email|unique:users,email", "Email");
    $this->validator->add("password", "required|min:8", "Password");
    $this->validator->add("c_password", "required|min:8|compare:password", "Confirm Password");
  }
}
