<?php

namespace App\Components;

class Component {
  
  protected $template;
  protected $data = null;

  public function render()
  {
    view($this->template, $this->data ?? []);
  }

  public function addData($key, $value) {
    if (is_null($this->data))
      $this->data = array();
    $this->data[$key] = $value;
  }

}
