<?php

require_once "init.php";

use App\Utils\NotFoundException;
use App\Utils\Route;


function load($page)
{cx 
  require_once "routing/web.php";
  try{
    Route::load($page);
  } catch (NotFoundException $ex) {
    $ex->render404();
  }
}

function loadAdmin($page)
{
  require_once "routing/admin.php";
  try{
    Route::load($page);
  } catch (NotFoundException $ex) {
    $ex->render404();
  }
}

function loadApi($page)
{
  require_once "routing/api.php";
  try{
    Route::load($page);
  } catch (NotFoundException $ex) {
    $ex->render404();
  }
}
