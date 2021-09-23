<?php

namespace App\Models;

use App\Utils\DB;
use App\Utils\Caching\Cache;

class OrderItem extends BaseModel
{
  public $id;
  public $order_id;
  public $product_id;
  public $quantity;
  public $price;
  public $created_at;
  public $modified_at;

  private $product = null;

  public function getProduct()
  {
    if (is_null($this->product))
      $this->product = Product::find($this->product_id);
    return $this->product;
  }

  public function save()
  {
    DB::prepare("INSERT INTO `order_items`(`order_id`, `product_id`, `quantity`, `price`) VALUES (?, ?, ?, ?)",
      "iiid", 
      $this->order_id,
      $this->product_id,
      $this->quantity,
      $this->price
    );
    $this->id = DB::getLastId();
    Cache::forget("order_items:{$this->order_id}");
  }

  public function getSubtotal()
  {
    return $this->price * $this->quantity;
  }

  public static function getAllFromOrder($order_id)
  {
    $data = Cache::remember("order_items:$order_id", fn() => (
      DB::select("SELECT * FROM `order_items` WHERE `order_id` = ?", "i", $order_id)
    ));
    $items = self::decodeData($data);
    return array_map(fn($item) => (
      OrderItem::populateData($item)
    ), $items);
  }

  public static function moveCart($user_id, $order_id)
  {
    $cart_items = Cart::getAllFromUser($user_id);
    foreach($cart_items as $cart)
    {
      $product = $cart->getProduct();

      $order_item = new OrderItem;
      $order_item->order_id = $order_id;
      $order_item->product_id = $cart->product_id;
      $order_item->quantity = $cart->quantity;
      $order_item->price = $product->price;
      $order_item->save();

      $product->quantity -= $cart->quantity;
      $product->update();
    }
    Cart::clear($user_id);
  }

  public static function populateData($row)
  {
    if (is_null($row)) return null;
    $item = new OrderItem;
    $item->id = intval($row["id"]);
    $item->order_id = intval($row["order_id"]);
    $item->product_id = intval($row["product_id"]);
    $item->quantity = intval($row["quantity"]);
    $item->price = floatval($row["price"]);
    $item->created_at = strtotime($row["created_at"]);
    $item->modified_at = is_null($row)
      ? null
      : strtotime($row["modified_at"]);
    return $item;
  }
}
