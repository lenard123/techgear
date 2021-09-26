<?php

namespace App\Controllers\Customer;

use App\Components\CustomerPageComponent1;
use App\Models\User;
use App\Utils\ValidatorList;
use App\Utils\AlertMessage;

class SigninController extends CustomerController
{

  private $validator = null;

  public function __construct()
  {
    $this->validator = new ValidatorList;
  }

  public function __invoke()
  {

    $validator = $this->validator;

    $view = new CustomerPageComponent1("signin_page");
    $view->setTitle("Sign In");
    $view->addData("validator", $validator);

    $this->render($view);
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

  public function signin()
  {
    $this->validate();
    $this->authenticate();

    if ($this->validator->hasError()) {
      $this->__invoke();
      return;
    }

    AlertMessage::success('Login successfully');
    redirect('');
  }
}