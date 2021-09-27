<?php

function baseURL()
{
  $protocol = isSecure() ? 'https://' : 'http://';
  $host = $_SERVER['HTTP_HOST'];
  $path = empty(BASE_FOLDER) ? BASE_FOLDER : BASE_FOLDER . '/';
  return $protocol . $host . '/' . $path;
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
