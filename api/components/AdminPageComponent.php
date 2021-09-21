<?php

import("components/Component");
import("components/AdminHeaderComponent");
import("components/AdminSidebarComponent");

class AdminPageComponent extends Component
{
  protected $template = "admin/admin_page_template";

  public function __construct($content)
  {
    parent::addData("content", $content);
    parent::addData("header", new AdminHeaderComponent);
    parent::addData("sidebar", new AdminSidebarComponent);
  }

}
