<?php

require_once "debugging.php";
require_once "request.php";
require_once "response.php";
require_once "url.php";

function resolve_dir($path)
{
  return API_PATH . $path;
}


function view($template, $data = []) {
  foreach ($data as $key => $value) 
    $$key = $value;
  include resolve_dir("templates/{$template}.php");
}

function money($number) {
  return '&#8369;'.number_format($number, 2);
}

function toDate($time)
{
  return date('M. d, Y', $time);
}

function template($componentKey, ...$args)
{

  $component = App\Components\BaseComponent::$reusables;

  if (!isset($component[$componentKey])) {
    throw new Exception("$componentKey is not registered as reusable a component");
  }

  $className = App\Components\BaseComponent::$reusables[$componentKey];
  return new $className(...$args);;
}

function __($text) {
  return htmlspecialchars($text);
}