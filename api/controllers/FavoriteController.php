<?php

import("controllers/BaseController");
import("components/ProfilePageComponent");
import("models/Favorite");

class FavoriteController extends BaseController
{
  public function get()
  {
    $favorites = User::getCurrentUser()->getFavorites();

    $view = new ProfilePageComponent("favorites_template");
    $view->setTitle("Favorites");
    $view->setActivePage("favorites");
    $view->addData("favorites", $favorites);
    $view->render();
  }
}