<?php

namespace App\Models;

use App\Utils\DB;
use App\Utils\Caching\Cache;

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
    $data = Cache::remember("category:$id", fn() => (
      DB::first('SELECT * FROM `categories` WHERE `id` = ?', "i", $id)
    ));
    $category = self::decodeData($data);
    return Category::populateData($category);
  }

  public static function populateData($data)
  {
    if (is_null($data)) return null;

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
      $result = Cache::remember('categories', fn() => DB::select('SELECT * FROM `categories`'));
      $categories = self::decodeData($result);
      self::$categories = array_map(fn($row) => (
        Category::populateData($row)
      ), $categories);
    }
    return self::$categories;
  }
}