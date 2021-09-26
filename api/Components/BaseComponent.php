<?php

namespace App\Components;

abstract class BaseComponent
{

  protected $base_folder = 'templates/components/';

  protected $template;

  protected $data = [];

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

    include $this->getTemplatePath();

    return ob_get_clean();
  }

}