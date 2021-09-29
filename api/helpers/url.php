<?php

function baseURL()
{
  static $baseURL = null;
  if (is_null($baseURL)) {
    $protocol = SITE_ENV === 'PRODUCTION' ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $path = empty(BASE_FOLDER) ? BASE_FOLDER : BASE_FOLDER . '/';
    $baseURL = $protocol . $host . '/' . $path;
  }

  return $baseURL;
}

function url($path = '')
{
  return baseURL() . $path;
}

function admin($path='')
{
  return url("admin/{$path}");
}

function asset($path)
{
  return url("assets/" . $path);
}

function storage($path)
{
  return url("storage/" . $path);
}

function redirect($url, $endpoint = null) {
  if (is_null($endpoint)) $url = url($url);
  else if($endpoint == "admin") $url = admin($url);
  header("Location: ". $url);
  exit();
}
