<?php

namespace App\Middlewares;

use App\Models\User;
use App\Utils\AlertMessage;

class CustomerOnlyMiddleware extends Middleware
{
  protected function handle()
  {
    return User::isUserCustomer();
  }

  protected function fallback()
  {
    AlertMessage::failed('You have to login first');
    redirect('?page=signin');
  }
}