<?php

namespace App\Utils\Caching;

use Predis\Client;

class CacheRedisProvider extends CacheProvider
{
  public $client = null;

  public function __construct($tls_url)
  {
    $this->client = new Client($tls_url);
  }

  public function has(string $key) : bool
  {
    return $this->client->exists($key);
  }

  public function forget(string $key) : void
  {
    $this->client->del($key);
  }

  public function get(string $key, $default = null) : ?string
  {
    if ($this->has($key))
      return $this->client->get($key);

    if ($default instanceof \Closure)
      $default = $default();

    if (is_null($default))
      return null;

    if (!is_string($default))
      return json_encode($default);

    return $default;
  }

  public function remember(string $key, $default) : ?string
  {
    if ($this->has($key)) return $this->get($key);

    if ($default instanceof \Closure)
      $default = $default();
    
    if (!is_string($default)) 
      $default = json_encode($default);

    $this->put($key, $default);

    return $default;

  }

  public function put(string $key, string $value, ?int $expiration = null) : void
  {
    $this->client->set($key, $value);
    $this->client->expire($key, CACHE_EXPIRATION * 60);
  }
}