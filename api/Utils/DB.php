<?php

namespace App\Utils;

use mysqli;
use mysqli_result;

class DB
{

  private static $connection = null;

  private static function getConnection() : mysqli
  {

    if (is_null(self::$connection)) {
      $host = config('db.host');
      $user = config('db.user');
      $pass = config('db.pass');
      $db   = config('db.database');
      $connection = new mysqli($host, $user, $pass, $db);

      if ($connection->connect_errno) {
        throw new \Exception('There is an error with your database connection.');
      }

      self::$connection = $connection;
    }

    return self::$connection;
  }

  public static function first(string $query, ?string $param_type = null, ...$params)
  {
    $result = self::select($query, $param_type, ...$params);
    if (count($result) >= 1) return $result[0];
    return null;
  }

  public static function scalar(string $query, ?string $param_type = null, ...$params)
  {
    $stmt = self::prepare($query, $param_type, ...$params);
    if ($row = $stmt->fetch_array())
      if (isset($row[0]))
        return $row[0];
    return null;
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

  public static function getLastId()
  {
    return self::getConnection()->insert_id;
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
