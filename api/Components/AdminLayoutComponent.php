<?php

namespace App\Components;

class AdminLayoutComponent extends BaseComponent
{
  protected $template = 'admin_layout';

  protected $content;
  public $title = null;
  public $js_data = [];
  public $scripts = [];

  public function __construct($template)
  {
    $content = new BaseComponent($template, 'templates/admin/');

    $this->addData('header', new AdminHeaderComponent);
    $this->addData('sidebar', new AdminSidebarComponent);
    $this->addData('content', $content);
    $this->addData('js_data', $this->js_data);
    $this->addData('scripts', $this->scripts);
    $this->addData('title', $this->title);

    $this->content = $content;
  }

  public function addContentData($key, $value)
  {
    $this->content->addData($key, $value);
  }

  public function addJSData($key, $value)
  {
    $this->js_data[$key] = $value;
    $this->addData('js_data', $this->js_data);
  }

  public function addScript($js)
  {
    array_push($this->scripts, $js);
    $this->addData('scripts', $this->scripts);
  }

}