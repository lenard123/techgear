<?php

namespace App\Utils\Caching;

class CacheProvider
{
  public static $providers = [
    'file' => CacheFileProvider::class,
    'redis' => CacheRedisProvider::class
  ];

  public function getCaches() : array
  {
    return array();
  }

  public function get(string $key, $default = null) : ?string
  {
    if ($default instanceof \Closure) 
      $default = $default();

    if (is_null($default))
      return $default;

    if (!is_string($default))
      return json_encode($default);

    return $default;
  }

  public function has(string $key) : bool
  {
    return false;
  }

  public function put(string $key, string $value, ?int $expiration = null) : void
  {}

  public function remember(string $key, $default) : ?string
  {
    return $this->get($key, $default);
  }

  public function forget(string $key) : void
  {}
}
