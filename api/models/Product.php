<?php

import("models/BaseModel");
import("models/Favorite");
import("models/Category");

class Product extends BaseModel
{
  public $id;
  public $category_id;
  public $name;
  public $description;
  public $price;
  public $image;
  public $quantity;
  public $max_order;
  public $created_at;
  public $modified_at;

  public $category = null;
  public $related_products = null;

  const DEFAULT_IMAGE = 'img/product1.jpg';

  public function getImage()
  {
    if (is_null($this->image)) {
      return asset(self::DEFAULT_IMAGE);
    }
    return url($this->image);
  }

  public function getDescription()
  {
    if (is_null($this->description) or $this->description == "")
      return "No description available";
    return $this->description;
  }

  public function isFavorite()
  {
    return Favorite::isCurrentUserFavorite($this->id);
  }

  public function getRelatedProducts()
  {
    if (is_null($this->related_products)){
      $products = array();
      $stmt = self::prepareStatement("SELECT * FROM `products` WHERE `category_id`=? AND `id`<>? LIMIT 5");
      $stmt->bind_param("ii", $this->category_id, $this->id);
      $stmt->execute();
      $rs = $stmt->get_result();
      while($row = $rs->fetch_assoc()) 
        array_push($products, self::populateData($row));
      $this->related_products = $products;
    }
    return $this->related_products;
  }

  public function update()
  {
    $stmt = self::prepareStatement("UPDATE `products` SET `category_id`=?, `name`=?, `description`=?, `price`=?, `image`=?, `quantity`=?, `max_order`=?, `modified_at`=CURRENT_TIMESTAMP WHERE `id`=?");
    $stmt->bind_param(
      "issdsiii",
      $this->category_id,
      $this->name,
      $this->description,
      $this->price,
      $this->image,
      $this->quantity,
      $this->max_order,
      $this->id
    );
    $stmt->execute();
  }

  public function isAvailable()
  {
    return $this->quantity > 0;
  }

  public function getCategory()
  {
    if (is_null($this->category))
      $this->category = Category::find($this->category_id);
    return $this->category;
  }

  public static function find($id)
  {
    $stmt = self::prepareStatement("SELECT * FROM `products` WHERE `id`=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
      return self::populateData($row);
    }
    return null;
  }

  public static function search($query)
  {
    $result = array();
    $query = "%$query%";
    $stmt = self::prepareStatement("SELECT * FROM `products` WHERE `name` LIKE ? OR `description` LIKE ?");
    $stmt->bind_param("ss", $query, $query);
    $stmt->execute();
    $rs = $stmt->get_result();
    while($row = $rs->fetch_assoc())
      array_push($result, self::populateData($row));
    return $result;
  }

  public static function populateData($row)
  {
    $product = new Product;
    $product->id = intval($row["id"]);
    $product->category_id = intval($row["category_id"]);
    $product->name = $row["name"];
    $product->description = $row["description"];
    $product->price = floatval($row["price"]);
    $product->image = $row["image"];
    $product->quantity = intval($row["quantity"]);
    $product->max_order = is_null($row["max_order"]) ? $product->quantity : intval($row["max_order"]);
    $product->created_at = strtotime($row["created_at"]);
    $product->modified_at = !is_null($row["modified_at"]) ? strtotime($row["modified_at"]) : null;
    return $product;
  }

  public static function getFeaturedProducts()
  {
    $products = [];
    $rs = self::execQuery("SELECT * FROM `products` ORDER BY RAND() LIMIT 15");
    while($row = $rs->fetch_assoc())
      array_push($products, self::populateData($row));
    return $products;
  }

  public static function getAllFromCategory($category_id)
  {
    $result = array();
    $stmt = self::prepareStatement("SELECT * FROM `products` WHERE `category_id`=?");
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $rs = $stmt->get_result();
    while($row = $rs->fetch_assoc()) {
      array_push($result, self::populateData($row));
    }
    return $result;    
  }
}
