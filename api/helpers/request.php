<?php

function __method($method) {
  return "<input type='hidden' name='method' value='$method' />";
}

function post($key) 
{
  return $_POST[$key] ?? null;
}

function get($key) 
{
  return $_GET[$key] ?? null;
}

function getRequestMethod()
{
  $method = post('method') ?? get('method') ?? $_SERVER['REQUEST_METHOD'];
  return $method;
}

function request($key) 
{
  return post($key) ?? get($key);
}
