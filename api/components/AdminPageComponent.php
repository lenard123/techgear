<?php

import("components/Component");
import("components/AdminHeaderComponent");

class AdminPageComponent extends Component
{
  protected $template = "admin/admin_page_template";

  public function __construct()
  {
    parent::addData("header", new AdminHeaderComponent);
  }

}
