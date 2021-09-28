<?php

namespace App\Utils\Caching;

class CacheFileProvider extends CacheProvider
{

  private $cache_folder;
  private $caches = null;

  public function __construct($cache_folder)
  {
    $this->cache_folder = $cache_folder;
    if (!file_exists($cache_folder)) {
      mkdir($cache_folder);
    }
  }

  public function flush() : void
  {
    $caches = $this->getCaches();
    foreach($caches as $cache) {
      $cache->delete();
    }
  }

  public function getCaches() : array
  {
    if (is_null($this->caches)) {
      $files = scandir($this->cache_folder);
      $caches = array();

      foreach($files as $file) {
        $filepath = $this->getFileFullPath($file);

        if (!CacheFile::isValid($filepath)) continue;
        $cache = new CacheFile($filepath);
        $caches[$cache->getKey()] = $cache;
      }
      $this->caches = $caches;
    }

    return $this->caches;
  }

  public function has(string $key, bool $isHashed = false) : bool
  {
    if (!$isHashed) $key = md5($key);
    return isset($this->getCaches()[$key]);
  }

  public function get(string $key, $default = null) : ?string
  {
    $caches = $this->getCaches();
    $key = md5($key);
    if ($this->has($key, true)) {
      $cache = $caches[$key];
      if (!$cache->isExpired()) {
        return $cache->getContent();
      }
      $cache->delete();
    } 
    if ($default instanceof \Closure)
      return $default();    
    return $default;
  }

  public function remember(string $key, $default) : ?string
  {
    $remembered = $this->get($key);
    if (!is_null($remembered)) return $remembered;

    if ($default instanceof \Closure)
      $default = $default();
    
    if (!is_string($default)) 
      $default = json_encode($default);

    $this->put($key, $default);

    return $default;
  }

  public function forget(string $key) : void
  {
    $key = md5($key);
    $caches = $this->getCaches();
    if ($this->has($key, true)) {
      $cache = $caches[$key];
      $cache->delete();
    }
  }

  public function put(string $key, string $value, ?int $expiration = null) : void
  {
    $key = md5($key);
    $expiration = $expiration ?? CACHE_EXPIRATION; 
    $filename = $key . '_' . $expiration . '.cache';
    $filepath = $this->getFileFullPath($filename);
    file_put_contents($filepath, $value);
  }

  private function getFileFullPath($filename)
  {
    return $this->cache_folder . '/' . $filename;
  }

}