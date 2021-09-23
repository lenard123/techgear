<?php

namespace App\Utils;

use mysqli;
use mysqli_result;

class DB
{

  private static $connection = null;

  private static function getConnection() : mysqli
  {
    if (is_null(self::$connection))
      self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
    return self::$connection;
  }

  public static function select(string $query, ?string $param_type = null, ...$params)
  {
    $query_result = !is_null($param_type) >= 2
      ? self::prepare($query, $param_type, ...$params)
      : self::execute($query);
    $result = array();
    while($row = $query_result->fetch_assoc())
      array_push($result, $row);
    return $result;
  }

  public static function execute(string $query)
  {
    return self::getConnection()->query($query);
  }

  public static function prepare(string $query, string $param_type, ...$params)
  {
    $stmt = self::getConnection()->prepare($query);
    $stmt->bind_param($param_type, ...$params);
    //call_user_func_array(array($stmt, 'bind_params'), refValues($params));
    $stmt->execute();
    return $stmt->get_result();
  }
}
