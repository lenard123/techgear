<?php

namespace App\Components;

class CustomerLayoutComponent extends LayoutComponent
{
  protected $template = 'customer_layout';

  public $header;
  public $footer;
  public $sidebar;

  public function __construct($content_template)
  {
    $this->header = new CustomerHeaderComponent;
    $this->sidebar = new CustomerSidebarComponent;
    $this->footer = new BaseComponent('customer_footer');

    parent::__construct($content_template, 'templates/customer/');
  }

}