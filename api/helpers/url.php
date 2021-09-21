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
  return url("admin{$path}");
}

function asset($path)
{
  return url("assets/" . $path);
}

function storage($path)
{
  return url("storage/" . $path);
}

function redirect($url) {
  header("Location: ". url($url));
  exit();
}
