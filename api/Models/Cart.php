<?php

namespace App\Models;

use App\Utils\DB;
use App\Utils\Caching\Cache;

class Cart extends BaseModel
{
  public $id;
  public $user_id;
  public $product_id;
  public $quantity;
  public $created_at;
  public $modified_at;

  private $product = null;

  public function delete()
  {
    DB::prepare("DELETE FROM `carts` WHERE `id` = ?", "i", $this->id);
    Cache::forget("carts:{$this->user_id}");
    Cache::forget("carts:{$this->user_id}:count");
    Cache::forget("cart:{$this->id}");
  }

  public function update()
  {
    DB::prepare(
      "UPDATE `carts` SET `quantity`= ?, `modified_at`=CURRENT_TIMESTAMP WHERE `id` = ?", 
      "ii", 
      $this->quantity, 
      $this->id
    );
    Cache::forget("carts:{$this->user_id}");
    Cache::forget("cart:{$this->id}");
  }

  public function canStillAdd()
  {
    $product = $this->getProduct();
    $new_quantity = $this->quantity + 1;
    $max_order = $product->max_order ?? INF;
    return $new_quantity <=$product->quantity && $new_quantity <= $max_order;
  }

  public function save()
  {
    DB::prepare(
      "INSERT INTO `carts`(`user_id`, `product_id`, `quantity`) VALUES (?, ?, ?)",
      "iii",
      $this->user_id,
      $this->product_id,
      $this->quantity      
    );
    $this->id = DB::getLastId();
    Cache::forget("carts:{$this->user_id}");
    Cache::forget("carts:{$this->user_id}:count");
  }

  public function getSubtotal()
  {
    return $this->quantity * $this->getProduct()->price;
  }

  public function getProduct()
  {
    if (is_null($this->product)) {
      $this->product = Product::find($this->product_id);
    }
    return $this->product;
  }

  public static function clear($user_id)
  {
    DB::prepare("DELETE FROM `carts` WHERE `user_id` = ?", "i", $user_id);
    Cache::forget("carts:$user_id");
    Cache::forget("carts:$user_id:count");
  }

  public static function create($user, $product_id)
  {
    if (!$user->hasInCarts($product_id)) {
      $cart = new Cart;
      $cart->user_id = $user->id;
      $cart->product_id = $product_id;
      $cart->quantity = 1;
      $cart->save();
    }
  }

  public static function populateData($row)
  {
    $cart = new Cart;
    $cart->id = intval($row["id"]);
    $cart->user_id = intval($row["user_id"]);
    $cart->product_id = intval($row["product_id"]);
    $cart->quantity = intval($row["quantity"]);
    $cart->created_at = strtotime($row["created_at"]);
    $cart->modified_at = is_null($row["modified_at"]) ? null : strtotime($row["modified_at"]);
    return $cart;
  }

  public static function find($id)
  {
    $data = Cache::remember("cart:$id", fn() => (
      DB::first('SELECT * FROM `carts` WHERE `id` = ?', "i", $id)
    ));
    $cart = self::decodeData($data);
    return Cart::populateData($cart);
  }

  public static function calculateSubtotal($carts)
  {
    $subtotal = 0;
    foreach ($carts as $cart) {
      $subtotal += $cart->quantity * $cart->getProduct()->price;
    }
    return $subtotal;
  }

  public static function countItem($user_id)
  {
    $data = Cache::remember("carts:$user_id:count", fn() => (
      DB::scalar('SELECT COUNT(*) FROM `carts` WHERE `user_id`=?', "i", $user_id)
    ));
    return self::decodeData($data);
  }

  public static function getAllFromUser($user_id)
  {
    $data = Cache::remember("carts:$user_id", fn() => (
      DB::select("SELECT * FROM `carts` WHERE `user_id` = ?", "i", $user_id)
    ));
    $carts = self::decodeData($data);
    return array_map(fn($cart) => (
      Cart::populateData($cart)
    ), $carts);
  }
}
