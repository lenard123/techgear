<?php

function url($path = '')
{
  return BASE_URL . $path;
}

function asset($path)
{
  return BASE_URL . "assets/" . $path;
}

function storage($path)
{
  return BASE_URL . "storage/" . $path;
}

function redirect($url) {
  header("Location: ". url($url));
  exit();
}
