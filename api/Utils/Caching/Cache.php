<?php

namespace App\Utils\Caching;

class Cache
{
  public static function getProvider() : CacheProvider
  {
    return self::store(CACHE_PROVIDER);
  }

  public static function store($provider_key)
  {
    if (CACHE_ENABLED) {
      if ($provider_key == 'file') {
        return new CacheFileProvider(CACHE_FILE_DIR);
      }      
    }
    return new CacheProvider; //Empty Cache Provider
  }

  public static function get(string $key, $default = null) : ?string
  {
    return self::getProvider()->get($key, $default);
  }

  public static function put(string $key, string $value, ?int $expiration = null) : void
  {
    self::getProvider()->put($key, $value, $expiration);
  }

  public static function remember(string $key, $default) : ?string
  {
    return self::getProvider()->remember($key, $default);
  }

  public static function forget(string $key) : void
  {
    self::getProvider()->forget($key);
  }
}
