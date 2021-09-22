<?php

namespace App\Middlewares;

use App\Models\User;

class GuestCustomerOnlyMiddleware extends Middleware
{
  protected function handle()
  {
    return !User::isUserCustomer();
  }

  protected function fallback()
  {
    redirect('');
  }
}