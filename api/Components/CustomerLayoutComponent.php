<?php

namespace App\Components;

class CustomerLayoutComponent extends LayoutComponent
{
  protected $template = 'customer_layout';

  public $header;
  public $footer;

  public function __construct($content_template)
  {
    $this->header = new CustomerHeaderComponent;
    $this->footer = new BaseComponent('customer_footer');

    //this will render to every customer pages
    $this->addCustomScript('js/app.js');

    parent::__construct($content_template, 'templates/customer/');
  }

}