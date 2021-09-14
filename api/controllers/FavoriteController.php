<?php

import("controllers/BaseController");
import("components/ProfilePageComponent");

class FavoriteController extends BaseController
{
  public function get()
  {
    $view = new ProfilePageComponent("favorites_template");
    $view->setTitle("Favorites");
    $view->setActivePage("favorites");
    $view->render();
  }
}