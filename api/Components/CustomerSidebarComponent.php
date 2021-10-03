<?php

namespace App\Components;

use App\Models\Category;

class CustomerSidebarComponent extends BaseComponent
{

  protected $template = 'customer_sidebar';

  public function __construct()
  {
    $this->addData('categories', Category::getAll());
  }

}
