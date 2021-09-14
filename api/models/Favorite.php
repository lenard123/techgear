<?php

import("models/BaseModel");

class Favorite extends BaseModel
{
  public $id;
  public $user_id;
  public $product_id;
  public $created_at;
  public $modified_at;

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