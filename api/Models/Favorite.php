<?php

namespace App\Models;

use App\Utils\DB;
use App\Utils\Caching\Cache;

class Favorite extends BaseModel
{
  public $id;
  public $user_id;
  public $product_id;
  public $created_at;
  public $modified_at;

  public $product = null;

  public function getProduct()
  {
    if (is_null($this->product))
      $this->product = Product::find($this->product_id);
    return $this->product;
  }

  public function save()
  {
    DB::prepare("INSERT INTO `favorites`(`user_id`, `product_id`) VALUES (?, ?)", 
      "ii", 
      $this->user_id,
      $this->product_id
    );
    $this->id = DB::getLastId();
    Cache::forget("favorites:{$this->user_id}");
    Cache::forget("favorites:{$this->user_id}:count");
  }

  public static function populateData($row)
  {
    $favorite = new Favorite;
    $favorite->id = intval($row["id"]);
    $favorite->user_id = intval($row["user_id"]);
    $favorite->product_id = intval($row["product_id"]);
    $favorite->created_at = strtotime($row["created_at"]);
    $favorite->modified_at = is_null($row["modified_at"])
      ? null
      : strtotime($row["modified_at"]);
    return $favorite;
  }

  public static function getAllFromUser($user_id)
  {
    $data = Cache::remember("favorites:$user_id", fn() => (
      DB::select('SELECT * FROM `favorites` WHERE `user_id` = ?', "i", $user_id)
    ));
    $favorites = self::decodeData($data);
    return array_map(fn($favorite) => (
      Favorite::populateData($favorite)
    ), $favorites);
  }

  public static function countByUser($user_id)
  {
    $data = Cache::remember("favorites:$user_id:count", fn() => (
      DB::scalar("SELECT COUNT(*) FROM `carts` WHERE `user_id` = ?", "i", $user_id)
    ));
    return self::decodeData($data);
  }

  public static function deleteProduct($user_id, $product_id)
  {
    DB::prepare("DELETE FROM `favorites` WHERE `product_id` = ?", "i", $product_id);
    Cache::forget("favorites:$user_id");
    Cache::forget("favorites:$user_id:count");
  }
}