<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;
use App\Utils\AlertMessage;

class SigninController extends BaseController
{

  public function __invoke()
  {
    view("admin/signin_page");
  }

  public function process(){
    $email = post('email');
    $password = post('password');

    $user = User::findByEmail($email);
    
    if (is_null($user)) {
      AlertMessage::failed('Email not found on the database.');
      redirect('?page=signin', 'admin');
    } else if (!$user->login($password)) {
      AlertMessage::failed('Invalid Password');
      redirect('?page=signin', 'admin');
    } else {
      redirect('?page=home', 'admin');
    }

  }//end of process()

}//end of class