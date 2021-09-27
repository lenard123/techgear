<?php

namespace App\Components;

class BaseComponent
{

  protected $base_folder = 'templates/components/';

  protected $template;

  protected $data = [];

  public function __construct($template = null, $base_folder = null)
  {
    if (!is_null($template)) {
      $this->template = $template;
    }

    if (!is_null($base_folder)) {
      $this->base_folder = $base_folder;
    }

  }

  private function getTemplatePath()
  {
    return API_PATH . $this->base_folder . $this->template . '.php';
  }

  public function addData(string $key, $value)
  {
    $this->data[$key] = $value;
  }

  public function render()
  {
    ob_start();

    foreach ($this->data as $key => $value)
      $$key = $value;

    require $this->getTemplatePath();

    return ob_get_clean();
  }

}
