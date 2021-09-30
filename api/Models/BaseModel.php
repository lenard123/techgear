<?php

namespace App\Models;

class BaseModel {

  static $connection = null;

  static function getConnection()
  {
    if (is_null(self::$connection)) {

      $host = config('db.host');
      $user = config('db.user');
      $pass = config('db.pass');
      $db   = config('db.database');

      self::$connection = new \mysqli($host, $user, $pass, $db);
      if (self::$connection->connect_error) {
        die("Error Connecting to database: ". self::$connection->connect_error);
      }
    }
    return self::$connection;
  }

  static function execQuery($query)
  {
    return self::getConnection()->query($query);
  }

  static function getLastId()
  {
    return self::getConnection()->insert_id;
  }

  static function prepareStatement($query)
  {
    return self::getConnection()->prepare($query);
  }

  static function isExist($table, $column, $value, $ignore = '') {

    $stmt = self::prepareStatement("SELECT id FROM `$table` WHERE `$column`=? and `$column`<>? limit 1");
    $stmt->bind_param('ss', $value, $ignore);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result->num_rows > 0;
  }

  static function decodeData($data)
  {
    if (is_string($data)) {
      $decoded_data = json_decode($data, true);
      if (json_last_error() == JSON_ERROR_NONE)
        return $decoded_data;
    }
    return $data;
  }
}
