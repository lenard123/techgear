<?php

namespace App\Utils\Caching;

class CacheFileProvider extends CacheProvider
{

  private $cache_folder;

  public function __construct($cache_folder)
  {
    $this->cache_folder = $cache_folder;
  }

  public function getCaches() : array
  {
    $files = scandir($this->cache_folder);
    $caches = array();

    foreach($files as $file) {
      $filepath = $this->getFileFullPath($file);

      if (!CacheFile::isValid($filepath)) continue;
      $cache = new CacheFile($filepath);
      $caches[$cache->getKey()] = $cache;
    }

    return $caches;
  }

  public function get(string $key, $default = null) : ?string
  {
    $caches = $this->getCaches();
    $key = md5($key);
    if (isset($caches[$key])) {
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

    $this->put($key, $default);

    return $default;
  }

  public function forget(string $key) : void
  {
    $key = md5($key);
    $caches = $this->getCaches();
    if (isset($caches[$key])) {
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