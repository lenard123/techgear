<?php

function baseURL()
{
  static $baseURL = null;
  if (is_null($baseURL)) {

    $protocol = config('app.env') === 'PRODUCTION' ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];

    $path = '/';
    if (config('app.env') === 'LOCAL') {
      $path .= basename(ROOT_PATH) . '/public/';
    }

    $baseURL = $protocol . $host  . $path;
  }

  return $baseURL;
}

function url($path = '')
{
  return baseURL() . $path;
}

function admin($path='')
{
  return url("admin.php{$path}");
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
