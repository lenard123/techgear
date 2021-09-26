<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Components\AdminLayoutComponent;
use App\Models\Product;

class DashboardController extends BaseController
{
  public function get()
  {
    $page = new AdminLayoutComponent('dashboard_page');
    $page->addContentData('featured_products', Product::getFeaturedProducts());
    $this->render($page);
  }
}