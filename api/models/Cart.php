<?php

namespace App\Models;

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
    $stmt = self::prepareStatement("DELETE FROM `carts` WHERE `id` = ?");
    $stmt->bind_param("i", $this->id);
    $stmt->execute();
  }

  public function update()
  {
    $stmt = self::prepareStatement("UPDATE `carts` SET `quantity`= ?, `modified_at`=CURRENT_TIMESTAMP WHERE `id` = ?");
    $stmt->bind_param("ii", $this->quantity, $this->id);
    $stmt->execute();
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
    $stmt = self::prepareStatement("INSERT INTO `carts`(`user_id`, `product_id`, `quantity`) VALUES (?, ?, ?)");
    $stmt->bind_param(
      "iii",
      $this->user_id,
      $this->product_id,
      $this->quantity
    );
    $stmt->execute();
    $this->id = self::getLastId();
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
    $stmt = self::prepareStatement("DELETE FROM `carts` WHERE `user_id` = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
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
    $stmt = self::prepareStatement("SELECT * FROM `carts` WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
      return self::populateData($row);
    }
    return null;
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
    $stmt = self::prepareStatement("SELECT COUNT(*) FROM `carts` WHERE `user_id` = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_array())
      return $row[0];
    return 0;
  }

  public static function getAllFromUser($user_id)
  {
    $result = array();
    $stmt = self::prepareStatement("SELECT * FROM `carts` WHERE `user_id` = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $rs = $stmt->get_result();
    while ($row = $rs->fetch_assoc()) {
      array_push($result, self::populateData($row));
    }
    return $result;
  }
}
