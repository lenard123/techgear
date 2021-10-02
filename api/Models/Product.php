<?php

namespace App\Models;

use App\Utils\DB;
use App\Utils\Caching\Cache;

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

  const DEFAULT_IMAGE = 'assets/img/product-default.jpg';

  public function getImage()
  {
    if (is_null($this->image)) {
      return url(self::DEFAULT_IMAGE);
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
    if (user()) return user()->isFavorite($this->id);
    return false;
  }

  public function getRelatedProducts()
  {
    if (is_null($this->related_products)){
      $data = Cache::remember("product:{$this->id}:related", fn() => (
        DB::select("SELECT * FROM `products` WHERE `category_id`=? AND `id`<>? LIMIT 5",
          "ii", $this->category_id, $this->id
        )
      ));
      $products = self::decodeData($data);
      $this->related_products = array_map(fn($product) => (
        self::populateData($product)
      ), $products);
    }
    return $this->related_products;
  }

  public function update()
  {
    DB::prepare("UPDATE `products` SET `category_id`=?, `name`=?, `description`=?, `price`=?, `image`=?, `quantity`=?, `max_order`=?, `modified_at`=CURRENT_TIMESTAMP WHERE `id`=?",
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
    Cache::forget("products");
    Cache::forget("product:{$this->id}");
    Cache::forget("products:featured");
    Cache::forget("products:{$this->category_id}");
  }

  public function save()
  {
    $query = "INSERT INTO `products`(`category_id`,`name`,`description`,`price`,`image`,`quantity`,`max_order`) VALUES(?, ?, ?, ?, ?, ?, ?);";
    DB::prepare($query, 'issdsii', 
      $this->category_id,
      $this->name,
      $this->description,
      $this->price,
      $this->image,
      $this->quantity,
      $this->max_order
    );
    $this->id = DB::getLastId();
    Cache::forget("products");
    Cache::forget("product:{$this->id}");
    Cache::forget("products:featured");
    Cache::forget("products:{$this->category_id}");
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
    $data = Cache::remember("product:$id", fn() => (
      DB::first("SELECT * FROM `products` WHERE `id` = ?", "i", $id)
    ));
    $product = self::decodeData($data);
    return self::populateData($product);
  }

  public static function search($query)
  {
    $query = "%$query%";
    $products = DB::select("SELECT * FROM `products` WHERE `name` LIKE ? OR `description` LIKE ?", "ss", $query, $query);
    return array_map(fn($product) => self::populateData($product), $products);
  }

  public static function populateData($row)
  {
    if (is_null($row)) return null;
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

  public static function countByCategory($category_id)
  {
    $data = Cache::remember("products:$category_id:count", fn() => (
      DB::scalar("SELECT COUNT(*) FROM `products` WHERE `category_id`=?", "i", $category_id)
    ));
    return self::decodeData($data);
  }

  public static function getFeaturedProducts()
  {
    $data = Cache::remember("products:featured", fn () => (
      DB::select("SELECT * FROM `products` ORDER BY RAND() LIMIT 15")
    ));
    $products = self::decodeData($data);
    return array_map(fn($prod) => self::populateData($prod), $products);
  }

  public static function getAll()
  {
    $data = Cache::remember('products', fn() => (
      DB::select("SELECT * FROM `products`")
    ));;
    $products = self::decodeData($data);
    return array_map(fn($prod) => self::populateData($prod), $products);
  }

  public static function getAllFromCategory($category_id)
  {
    $data = Cache::remember("products:$category_id", fn() => (
      DB::select("SELECT * FROM `products` WHERE `category_id`=?", "i", $category_id)
    ));
    $products = self::decodeData($data);
    return array_map(fn($prod) => self::populateData($prod), $products);
  }
}
