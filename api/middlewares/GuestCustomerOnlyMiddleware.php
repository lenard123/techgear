<?php

import("middlewares/Middleware");
import("models/User");

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