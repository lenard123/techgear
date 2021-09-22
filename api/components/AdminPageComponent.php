<?php

namespace App\Components;

class AdminPageComponent extends Component
{
  protected $template = "admin/admin_page_template";
  private $content_data = [];
  private $js_data = [];

  public function __construct($content)
  {
    parent::addData("content", $content);
    parent::addData("content_data", $this->content_data);
    parent::addData("js_data", $this->js_data);
    parent::addData("header", new AdminHeaderComponent);
    parent::addData("sidebar", new AdminSidebarComponent);
  }

  public function addJSData($key, $value)
  {
    $this->js_data[$key] = $value;
    parent::addData("js_data", $this->js_data);
  }

  public function setActivePage($page)
  {
    $this->js_data["active_page"] = $page;
    parent::addData("js_data", $this->js_data);
  }

  public function addData($key, $value)
  {
    $this->content_data[$key] = $value;
    parent::addData("content_data", $this->content_data);
  }

}
