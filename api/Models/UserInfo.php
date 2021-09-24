<?php

namespace App\Models;

use App\Utils\DB;
use App\Utils\Caching\Cache;

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
    if (is_null($row)) return null;

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

  public function update()
  {
    DB::prepare("UPDATE `user_info` SET `region`=?, `province`=?, `municipality`=?, `barangay`=?, `street`=?, `unit`=?, `phone`=?, `modified_at`=CURRENT_TIMESTAMP WHERE `user_id`=?",
      "sssssssi",
      $this->region,
      $this->province,
      $this->municipality,
      $this->barangay,
      $this->street,
      $this->unit,
      $this->phone,
      $this->user_id
    );
    Cache::forget("user_info:uid:{$this->user_id}");
  }

  public function save()
  {
    DB::prepare("INSERT INTO `user_info`(`user_id`, `region`, `province`, `municipality`, `barangay`, `street`, `unit`, `phone`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
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
    $this->id = DB::getLastId();
  }

  public static function findByUser($user_id)
  {
    $data = Cache::remember("user_info:uid:$user_id", fn() => (
      DB::first("SELECT * FROM `user_info` WHERE `user_id` = ?", "i", $user_id)
    ));
    $user_info = self::decodeData($data);
    return self::populateData($user_info);
  }

  public static function newUser($id)
  {
    $user_info = new UserInfo();
    $user_info->user_id = $id;
    $user_info->save();
    return $user_info;
  }
}