<?php

namespace App\Models;

use App\Utils\DB;
use App\Utils\Caching\Cache;

class Order extends BaseModel
{
  public $id;
  public $user_id;
  public $status;
  public $recipient_firstname;
  public $recipient_lastname;
  public $region;
  public $province;
  public $municipality;
  public $barangay;
  public $street;
  public $unit;
  public $phone;
  public $email;
  public $shipping_fee;
  public $created_at;
  public $modified_at;

  public $items = null;

  const STATUS_PREPARING = 1;
  const STATUS_SHIPPED = 2;
  const STATUS_DELIVERY = 3;
  const STATUS_DELIVERED = 4;

  public function getItems()
  {
    if (is_null($this->items))
      $this->items = OrderItem::getAllFromOrder($this->id);
    return $this->items;
  }

  public function getTotalPrice()
  {
    $subtotal = 0;
    foreach($this->getItems() as $item) {
      $subtotal += $item->getSubtotal();
    }
    return $subtotal + $this->shipping_fee;
  }

  public function getTotalItemCount()
  {
    $item_count = 0;
    foreach($this->getItems() as $item)
    {
      $item_count += $item->quantity;
    }
    return $item_count;
  }

  public function save()
  {
    DB::prepare(
      "INSERT INTO `orders`(`user_id`,`status`,`recipient_firstname`, `recipient_lastname`, `region`, `province`, `municipality`, `barangay`, `street`, `unit`, `phone`, `email`, `shipping_fee`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
      "iissssssssssd",
      $this->user_id,
      $this->status,
      $this->recipient_firstname,
      $this->recipient_lastname,
      $this->region,
      $this->province,
      $this->municipality,
      $this->barangay,
      $this->street,
      $this->unit,
      $this->phone,
      $this->email,
      $this->shipping_fee
    );

    $this->id = DB::getLastId();
    OrderItem::moveCart($this->user_id, $this->id);
    Cache::forget("orders:{$this->user_id}");
    Cache::forget("orders:{$this->user_id}:count");
  }

  public static function find($id)
  {
    $data = Cache::remember("order:$id", fn() => (
      DB::first("SELECT * FROM `orders` WHERE `id`=?", "i", $id)
    ));
    $order = self::decodeData($data);
    return Order::populateData($order);
  }

  public static function getAllFromUser($user_id)
  {
    $data = Cache::remember("orders:$user_id", fn() => (
      DB::select("SELECT * FROM `orders` WHERE `user_id` = ? ORDER BY `modified_at` DESC, `created_at` DESC", "i", $user_id)
    ));
    $orders = self::decodeData($data);
    return array_map(fn($order) => self::populateData($order), $orders);
  }

  public static function getOrderCount($user_id)
  {
    $data = Cache::remember("orders:$user_id:count", fn() => (
      DB::scalar("SELECT COUNT(*) FROM `orders` WHERE `user_id` = ?", "i", $user_id)
    ));
    $count = self::decodeData($data);
    return $count;
  }

  public static function populateData($row)
  {
    if (is_null($row)) return null;
    $order = new Order;
    $order->id = intval($row["id"]);
    $order->user_id = intval($row["user_id"]);
    $order->status = intval($row["status"]);
    $order->recipient_firstname = $row["recipient_firstname"];
    $order->recipient_lastname = $row["recipient_lastname"];
    $order->region = $row["region"];
    $order->province = $row["province"];
    $order->municipality = $row["municipality"];
    $order->barangay = $row["barangay"];
    $order->street = $row["street"];
    $order->unit = $row["unit"];
    $order->phone = $row["phone"];
    $order->email = $row["email"];
    $order->shipping_fee = floatval($row["shipping_fee"]);
    $order->created_at = strtotime($row["created_at"]);
    $order->modified_at = is_null($row["modified_at"])
      ? null 
      : strtotime($row["modified_at"]);
    return $order;   
  }
}
