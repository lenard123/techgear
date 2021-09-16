<?php

import("components/Component");
import("components/HeaderComponent");
import("utils/AlertMessage");

class CustomerPageComponent extends Component
{
  protected $template = "customer_page_template";
  protected $content_data = [];
  protected $scripts = [];
  protected $js_data = [
    "base_url" => BASE_URL
  ];

  public function __construct($content)
  {
    parent::addData("content", $content);
    parent::addData("header", new HeaderComponent);
    parent::addData("content_data", $this->content_data);
    parent::addData("scripts", $this->scripts);
    parent::addData("js_data", $this->js_data);
  }

  public function addDescription($description)
  {
    parent::addData("description", $description);
  }

  public function addJSData($key, $value)
  {
    $this->js_data[$key] = $value;
    parent::addData("js_data", $this->js_data);
  }

  public function addScript($script)
  {
    array_push($this->scripts, $script);
    parent::addData("scripts", $this->scripts);
  }

  public function setTitle($title)
  {
    parent::addData("title", $title);
  }

  public function addData($key, $value)
  {
    $this->content_data[$key] = $value;
    parent::addData("content_data", $this->content_data);
  }
}