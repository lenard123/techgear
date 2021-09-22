<?php

namespace App\Models;

class Category extends BaseModel 
{
  public $id;
  public $name;
  public $created_at;
  public $modified_at;

  public $products = null;
  public $products_count = null;
  static $categories = null;

  public function getProducts()
  {
    if (is_null($this->products))
      $this->products = Product::getAllFromCategory($this->id);
    return $this->products;
  }

  public function getProductCount()
  {
    if (is_null($this->products_count))
      $this->products_count = Product::countByCategory($this->id);
    return $this->products_count;
  }

  public static function find($id)
  {
    if (is_null(self::$categories)) {
      $stmt = self::prepareStatement("SELECT * FROM `categories` WHERE `id`=?");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($row = $result->fetch_assoc()) {
        return self::populateData($row);
      }
    } else {
      foreach(self::$categories as $category) {
        if ($category->id == $id)
          return $category;
      }
    }
    return null;
  }

  public static function populateData($data)
  {
    $category = new Category;
    $category->id = intval($data["id"]);
    $category->name = $data["name"];
    $category->created_at = strtotime($data["created_at"]);
    $category->modified_at = is_null($data["modified_at"]) ? null : strtotime($data["modified_at"]);
    return $category;
  }

  public static function getAll() : array
  {
    if (is_null(self::$categories)){
      $result = array();

      $rs = parent::execQuery("SELECT * FROM `categories`");
      while($row = $rs->fetch_assoc()) {
        array_push($result, Category::populateData($row));
      }

      self::$categories = $result;
    }

    return self::$categories;
  }
}