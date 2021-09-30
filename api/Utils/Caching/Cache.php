<?php

namespace App\Utils\Caching;

class Cache
{
  public static function getProvider() : CacheProvider
  {
    return self::store(config('cache.provider'));
  }

  public static function store($provider_key)
  {
    if (config('cache.enabled')) {
      if ($provider_key == 'file') {
        return new CacheFileProvider(config('cache.file_dir'));
      } else if ($provider_key == 'redis') {
        return new CacheRedisProvider(config('cache.redis_url'));
      }
    }
    return new CacheProvider; //Empty Cache Provider
  }

  public static function flush() : void
  {
    self::getProvider()->flush();
  }

  public static function get(string $key, $default = null) : ?string
  {
    return self::getProvider()->get($key, $default);
  }

  public static function put(string $key, string $value, ?int $expiration = null) : void
  {
    self::getProvider()->put($key, $value, $expiration);
  }

  public static function has(string $key) : bool
  {
    return self::getProvider()->has($key);
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
