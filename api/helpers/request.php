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

function isSecure()
{
    if (
        ( ! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || ( ! empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
        || ( ! empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on')
        || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)
        || (isset($_SERVER['HTTP_X_FORWARDED_PORT']) && $_SERVER['HTTP_X_FORWARDED_PORT'] == 443)
        || (isset($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https')
    ) {
        return true;
    } else {
        return false;
    }
}

function user()
{
  return App\Models\User::getCurrentUser();
}
