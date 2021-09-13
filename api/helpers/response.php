<?php

function json($data)
{
  header("Content-type:application/json");
  print(json_encode($data));
}