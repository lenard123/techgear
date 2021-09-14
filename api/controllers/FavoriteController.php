<?php

import("controllers/BaseController");
import("components/ProfilePageComponent");
import("models/Favorite");
import("utils/AlertMessage");

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

  public function post()
  {
    $product_id = post('product_id');

    if (is_null($product_id)) return redirect('?page=favorites');
    if (Favorite::isCurrentUserFavorite($product_id)) return redirect('?page=favorites'); 

    $new_favorite = new Favorite;
    $new_favorite->user_id = User::getCurrentUser()->id;
    $new_favorite->product_id = $product_id;
    $new_favorite->save();

    AlertMessage::success("Product successfully added to favorites");
    redirect('?page=favorites');
  }
}