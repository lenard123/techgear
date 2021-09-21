<?php

import("models/BaseModel");
import("models/OrderItem");

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
    $query = "INSERT INTO `orders`(`user_id`,`status`,`recipient_firstname`, `recipient_lastname`, `region`, `province`, `municipality`, `barangay`, `street`, `unit`, `phone`, `email`, `shipping_fee`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = self::prepareStatement($query);
    $stmt->bind_param("iissssssssssd",
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
    $stmt->execute();
    $this->id = self::getLastId();

    OrderItem::moveCart($this->user_id, $this->id);
  }

  public static function find($id)
  {
    $stmt = self::prepareStatement("SELECT * FROM `orders` WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc())
      return self::populateData($row);
    return null;
  }

  public static function getAllFromUser($user_id)
  {
    $orders = array();
    $stmt = self::prepareStatement("SELECT * FROM `orders` WHERE `user_id` = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $rs = $stmt->get_result();
    while($row = $rs->fetch_assoc())
      array_push($orders, self::populateData($row));
    return $orders;
  }

  public static function getOrderCount($user_id)
  {
    $stmt = self::prepareStatement("SELECT COUNT(*) FROM `orders` WHERE `user_id` = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_array())
      return $row[0];
    return 0;
  }

  public static function populateData($row)
  {
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
