<?php

import("models/BaseModel");
import("models/Subcategory");

class Category extends BaseModel 
{
  public $id;
  public $name;
  public $created_at;
  public $modified_at;

  public $subcategories = null;

  static $categories = null;

  public function getSubcategories()
  {
    if(is_null($this->subcategories)) {
      $all_subcategories = Subcategory::getAll();
      $result = array();
      foreach ($all_subcategories as $subcategory) {
        if ($subcategory->category_id == $this->id)
          array_push($result, $subcategory);
      }
      $this->subcategories = $result;
    }
    return $this->subcategories;
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