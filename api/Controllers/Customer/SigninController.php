<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Components\CustomerPageComponent;
use App\Models\User;
use App\Utils\ValidatorList;
use App\Utils\AlertMessage;

class SigninController extends BaseController
{

  private $validator = null;

  public function __construct()
  {
    $this->validator = new ValidatorList;
  }

  public function __invoke()
  {

    $validator = $this->validator;

    $view = new CustomerPageComponent("signin_page");
    $view->setTitle("Sign In");
    $view->addData("validator", $validator);

    $this->renderCustomerLayout($view);
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
