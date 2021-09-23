<?php

namespace App\Utils\Caching;

class CacheFile
{
  private $key;
  private $expiration_date;
  private $expiration; //In minutes
  private $file;

  public function __construct($filepath)
  {
    $filename = pathinfo($filepath)["filename"];
    $this->file = $filepath;
    $this->key = explode("_", $filename)[0];
    $this->expiration = explode("_", $filename)[1];
  }

  public function getKey()
  {
    return $this->key;
  }

  public function getContent()
  {
    return file_get_contents($this->file);
  }

  public function isExpired()
  {
    $expiration = new \DateTime($this->getExpiration());
    $current = new \DateTime(date('Y-m-d H:i'));
    $diff = $current->diff($expiration);
    return $diff->invert == 1;
  }

  private function getExpiration()
  {
    $date_modified = new \DateTime(date('Y-m-d H:i', filemtime($this->file)));
    $date_modified->add(new \DateInterval('PT' . $this->expiration . 'M'));
    return $date_modified->format('Y-m-d H:i');
  }

  public function delete()
  {
    unlink($this->file);
  }

  public static function isValid($filepath)
  {
    $info = pathinfo($filepath);
    return $info['extension'] == 'cache';
  }
}