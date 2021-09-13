<?php

import("controllers/BaseController");
import("components/CustomerPageComponent");
import("components/ProductCardComponent");
import("models/Subcategory");

class SubcategoryController extends BaseController
{

  private $subcategory;

  public function __construct($subcategory)
  {
    $this->subcategory = $subcategory;
  }

  public function get()
  {

    $subcategory = $this->subcategory;
    $products = $subcategory->getProducts();

    $view = new CustomerPageComponent("subcategory_template");
    $view->setTitle($subcategory->name);
    $view->addData("subcategory", $subcategory);
    $view->addData("products", $products);
    $view->render();

  }
}
