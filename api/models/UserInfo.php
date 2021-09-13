<?php

import("models/BaseModel");

class UserInfo extends BaseModel
{
  public $id;
  public $user_id;
  public $region;
  public $province;
  public $municipality;
  public $barangay;
  public $street;
  public $unit;
  public $phone;
  public $created_at;
  public $modified_at;

  public static function populateData($row)
  {
    $user_info = new UserInfo;
    $user_info->id = intval($row["id"]);
    $user_info->user_id = intval($row["user_id"]);
    $user_info->region = $row["region"];
    $user_info->province = $row["province"];
    $user_info->municipality = $row["municipality"];
    $user_info->barangay = $row["barangay"];
    $user_info->street = $row["street"];
    $user_info->unit = $row["unit"];
    $user_info->phone = $row["phone"];
    $user_info->created_at = strtotime($row["created_at"]);
    $user_info->modified_at = is_null($row["modified_at"]) ? null : strtotime($row["modified_at"]);
    return $user_info;
  }

  public function save()
  {
    $stmt = self::prepareStatement("INSERT INTO `user_info`(`user_id`, `region`, `province`, `municipality`, `barangay`, `street`, `unit`, `phone`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
      "isssssss", 
      $this->user_id,
      $this->region,
      $this->province,
      $this->municipality,
      $this->barangay,
      $this->street,
      $this->unit,
      $this->phone
    );
    $stmt->execute();
    $this->id = self::getLastId();
  }

  public static function findByUser($user_id)
  {
    $stmt = self::prepareStatement("SELECT * FROM `user_info` WHERE `user_id` = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc())
      return self::populateData($row);
    return null;
  }

  public static function newUser($id)
  {
    $user_info = new UserInfo();
    $user_info->user_id = $id;
    $user_info->save();
    return $user_info;
  }
}