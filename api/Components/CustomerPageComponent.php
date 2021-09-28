<?php

namespace App\Components;

class CustomerPageComponent extends BaseComponent
{

  protected $base_folder = 'templates/customer/';

  public $title = null;
  public $description = null;
  public $js_data = [];
  public $scripts = [];
  public $js_libraries = [];

  public function __construct($template)
  {
    $this->js_data['base_url'] = baseURL();
    $this->template = $template;
  }

  public function addJSLibrary($library)
  {
    array_push($this->js_libraries, $library);
  }

  public function addDescription($description)
  {
    $this->addDescription = $description;
  }

  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function addScript($js)
  {
    array_push($this->scripts, $js);
  }

  public function addJSData($key, $value)
  {
    $this->js_data[$key] = $value;
  }
}