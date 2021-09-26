<?php

namespace App\Components;

class CustomerLayoutComponent extends BaseComponent
{
  protected $template = 'customer_layout';
  protected $content_data = [];

  public function __construct(CustomerPageComponent $content)
  {
    $this->js_data["base_url"] = baseURL();
    $this->addData("content", $content);
    $this->addData("title", $content->title);
    $this->addData("description", $content->description);
    $this->addData("scripts", $content->scripts);
    $this->addData("js_data", $content->js_data);
    $this->addData("header", new CustomerHeaderComponent);
  }

}
