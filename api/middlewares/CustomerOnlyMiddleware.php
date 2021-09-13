<?php

import("middlewares/Middleware");
import("models/User");
import("utils/AlertMessage");

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