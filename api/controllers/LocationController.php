<?php

import("controllers/BaseController");

class LocationController extends BaseController
{

  public static $location;
  public static $regions = [
    "01" => "REGION I", 
    "02" => "REGION II", 
    "03" => "REGION III", 
    "4A" => "REGION IV - A", 
    "4B" => "REGION IV - B", 
    "05" => "REGION V", 
    "06" => "REGION VI", 
    "07" => "REGION VII", 
    "08" => "REGION VIII", 
    "09" => "REGION IX", 
    "10" => "REGION X", 
    "11" => "REGION XI", 
    "12" => "REGION XII", 
    "13" => "REGION XIII", 
    "BARMM" => "BARMM", 
    "CAR" => "CAR", 
    "NCR" => "NCR"
  ];


  public static function getLocation()
  {
    if (is_null(self::$location)) {
      $location = file_get_contents(resolve_dir("philippine_location.json"));
      self::$location = json_decode($location);
    }
    return self::$location;
  }

  public static function isValidRegion($region)
  {
    return isset(self::$regions[$region]);
  }

  public function get()
  {
    if (is_null(get('region'))) throw new NotFoundException;
    if (!self::isValidRegion(get('region'))) throw new NotFoundException;
    $region = get('region');
    json(self::getLocation()->$region);
  }
}
