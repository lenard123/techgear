<?php

import("Utils/NotFoundException");

class BaseController
{
  public function index(){
    throw new NotFoundException();
  }

  public function get()
  {
    throw new NotFoundException();
  }

  public function post(){
    throw new NotFoundException();
  }

  public function patch(){
    throw new NotFoundException();
  }

  public function put()
  {
    throw new NotFoundException();
  }

  public function delete(){
    throw new NotFoundException();
  }
}