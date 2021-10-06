<?php

namespace App\Components;

class IconComponent extends BaseComponent
{

  protected $base_folder = 'templates/svgs/';

  protected $height = 16;
  protected $width = 16;
  protected $classes = '';

  public function __construct($name, $classes = '')
  {
    $this->classes = $classes;
    $this->template = "$name.svg";
  }

  public function height($height)
  {
    $this->height = $height;
    return $this;
  }

  public function width($width)
  {
    $this->width = $width;
    return $this;
  }

  public function size($size)
  {
    $this->height = $size;
    $this->width = $size;
    return $this;
  }

  public function attr()
  {
    return "class='{$this->classes}' height='{$this->height}' width='{$this->width}'";
  }

}