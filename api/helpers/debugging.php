<?php

/**
 * Display information about the variable
 */
function dump($data) 
{
  var_dump($data);
}

/**
 * Display information about the variable then end execution
 */
function dd($data) 
{
  header("Content-type:application/json");
  print(json_encode($data));
  exit();
}
