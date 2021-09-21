<?php

import("components/Component");
import("components/AdminHeaderComponent");
import("components/AdminSidebarComponent");

class AdminPageComponent extends Component
{
  protected $template = "admin/admin_page_template";
  private $content_data = [];

  public function __construct($content)
  {
    parent::addData("content", $content);
    parent::addData("content_data", $this->content_data);
    parent::addData("header", new AdminHeaderComponent);
    parent::addData("sidebar", new AdminSidebarComponent);
  }

  public function addData($key, $value)
  {
    $this->content_data[$key] = $value;
    parent::addData("content_data", $this->content_data);
  }

}
