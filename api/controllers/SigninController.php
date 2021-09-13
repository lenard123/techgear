<?php

import("controllers/BaseController");
import("components/CustomerPageComponent");
import("models/User");
import("utils/ValidatorList");
import("utils/AlertMessage");

class SigninController extends BaseController
{

  private $validator = null;

  public function __construct()
  {
    $this->validator = new ValidatorList;
  }

  public function get()
  {

    $validator = $this->validator;

    $view = new CustomerPageComponent("signin_template");
    $view->setTitle("Sign In");
    $view->addData("validator", $validator);
    $view->render();
  }

  public function validate()
  {
    $this->validator->add('email', 'required|email', 'Email');
    $this->validator->add('password', 'required', 'Password');
  }

  public function authenticate()
  {
    if ($this->validator->hasError()) return;

    $user = User::findByEmail(post('email'));
    if (is_null($user)) {
      $this->validator->fail('email', 'Email not found on the database.');
    } else if (!$user->login(request('password'), post('remember'))) {
      $this->validator->fail('password', 'Wrong password!');
    }

  }

  public function post()
  {
    $this->validate();
    $this->authenticate();

    if ($this->validator->hasError()) {
      $this->get();
      return;
    }

    AlertMessage::success('Login successfully');
    redirect('');
  }
}
