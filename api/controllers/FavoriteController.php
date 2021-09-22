<?php

import("controllers/BaseController");
import("components/ProfilePageComponent");
import("models/Favorite");
import("Utils/AlertMessage");

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

  public function delete()
  {
    $product_id = post('product_id');

    if (is_null($product_id)) return redirect('?page=favorites');
    if (!Favorite::isCurrentUserFavorite($product_id)) return redirect('?page=favorites'); 

    Favorite::deleteProduct($product_id);
    AlertMessage::success("Product successfully removed from favorites");
    redirect('?page=favorites');
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