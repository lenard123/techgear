<?php

namespace App\Utils\Caching;

class CacheProvider
{
  public static $providers = [
    'file' => CacheFileProvider::class
  ];

  public function getCaches()
  {}

  public function get(string $key, $default = null) : ?string
  {}

  public function put(string $key, string $value, ?int $expiration = null) : void
  {}

  public function remember(string $key, $default) : ?string
  {}

  public function forget(string $key) : void
  {}
}
