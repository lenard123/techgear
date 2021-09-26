<?php

namespace App\Components;

class CustomerLayoutComponent extends BaseComponent
{
  protected $template = 'customer_layout';

  public function __construct(CustomerPageComponent $content)
  {
    $this->addData("content", $content);
    $this->addData("title", $content->title);
    $this->addData("description", $content->description);
    $this->addData("scripts", $content->scripts);
    $this->addData("js_data", $content->js_data);
    $this->addData("header", new CustomerHeaderComponent);
  }

}
