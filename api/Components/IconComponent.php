<?php

namespace App\Components;

class IconComponent extends BaseComponent
{

  protected $base_folder = 'templates/svgs/';

  protected $defaultHeight = 16;
  protected $defaultWidth = 16;

  public function __construct($name, $classes = '')
  {
    $this->template = "$name.svg";
    $this->addData('height', $this->defaultHeight);
    $this->addData('width', $this->defaultWidth);
    $this->addData('classes', $classes);
  }

  public function height($height)
  {
    $this->addData('height', $height);
    return $this;
  }

  public function width($width)
  {
    $this->addData('width', $width);
    return $this;
  }

  public function size($size)
  {
    return $this->height($size)->width($size);
  }

}