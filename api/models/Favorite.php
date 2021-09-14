<?php

import("models/BaseModel");
import("models/Product");
import("models/User");

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
    $stmt = self::prepareStatement("INSERT INTO `favorites`(`user_id`, `product_id`) VALUES (?, ?)");
    $stmt->bind_param("ii", $this->user_id, $this->product_id);
    $stmt->execute();
    $this->id = self::getLastId();
  }

  public static function isCurrentUserFavorite($product_id)
  {
    if (User::isUserCustomer()) {
      $user = User::getCurrentUser();
      foreach($user->getFavorites() as $favorite) {
        if ($favorite->product_id == $product_id)
          return true;
      }
    }
    return false;
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
    $favorites = array();
    $stmt = self::prepareStatement("SELECT * FROM `favorites` WHERE `user_id`=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $rs = $stmt->get_result();
    while($row = $rs->fetch_assoc())
      array_push($favorites, self::populateData($row));
    return $favorites;
  }
}