<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Components\AdminLayoutComponent;
use App\Models\Category;
use App\Utils\Validator;
use App\Utils\AlertMessage;

class ManageCategoryController extends BaseController
{

  private ?Category $category;

  public function __construct(?Category $category = null)
  {
    $this->category = $category;
  }

  public function get()
  {
    $categories = Category::getAll();

    $view = new AdminLayoutComponent("category_page");
    $view->addContentData("categories", $categories);
    $view->addScript(asset("js/admin-category.js"));

    $this->render($view);
  }

  public function updateCategory()
  {
    $validator = new Validator("name", "required|max:15|min:2", "Category name");

    if (!$validator->is_valid) {
      AlertMessage::failed($validator->failure_message);
      redirect("?page=category", "admin");
      return;
    }
    $this->category->name = post('name');
    $this->category->update();
    AlertMessage::success("Category name updated successfully");
    redirect("?page=category", "admin");
  }
}