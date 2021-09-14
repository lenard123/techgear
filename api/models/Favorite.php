<?php

import("models/BaseModel");

class Favorite extends BaseModel
{
  public $id;
  public $user_id;
  public $product_id;
  public $created_at;
  public $modified_at;
}