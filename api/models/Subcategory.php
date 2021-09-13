<?php

import("models/BaseModel");
import("models/Category");
import("models/Product");

class Subcategory extends BaseModel
{
  public $id;
  public $category_id;
  public $name;
  public $created_at;
  public $modified_at;

  public $category = null;
  public $products = null;

  static public $subcategories = null;

  public function getCategory()
  {
    if (is_null($this->category)) {
      $this->category = Category::find($this->category_id);
    }
    return $this->category;
  }

  public function getProducts()
  {
    if (is_null($this->products)) {
      $this->products = Product::getAllFromSubcategory($this->id);
    }
    return $this->products;
  }

  public static function populateData($row)
  {
    $subcategory = new Subcategory;
    $subcategory->id = intval($row["id"]);
    $subcategory->category_id = intval($row["category_id"]);
    $subcategory->name = $row["name"];
    $subcategory->created_at = strtotime($row["created_at"]);
    $subcategory->modified_at = isset($row["modified_at"]) ? strtotime($row["modified_at"]) : null;
    return $subcategory;
  }

  public static function getAll()
  {
    if(is_null(self::$subcategories)) {
      $result = array();
      $rs = parent::execQuery("SELECT * FROM `subcategories`");
      while($row = $rs->fetch_assoc()) {
        array_push($result, Subcategory::populateData($row));
      }
      self::$subcategories = $result;
    }
    return self::$subcategories;
  }

  public static function find($id)
  {
    if (is_null(self::$subcategories)) {
      $stmt = parent::prepareStatement("SELECT * FROM `subcategories` WHERE `id`=?");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $rs = $stmt->get_result();
      if ($row = $rs->fetch_assoc()) {
        return self::populateData($row);
      }
    } else {
      foreach (self::$subcategories as $subcategory) {
        if ($subcategory->id == $id) return $subcategory;
      }
    }
    return null;
  }
}
