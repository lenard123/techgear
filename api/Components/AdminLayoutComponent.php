<?php

namespace App\Components;

class AdminLayoutComponent extends LayoutComponent
{
  protected $template = 'admin_layout';

  public BaseComponent $header;

  public function __construct($content_template)
  {
    $this->header = new BaseComponent('admin_header');
    $this->sidebar = new BaseComponent('admin_sidebar');

    //Add Library
    $this->addJSLibrary('alpine-collapse');

    //Admin Scripts
    $this->addCustomScript('js/admin.js');

    parent::__construct($content_template, 'templates/admin/');
  }

}