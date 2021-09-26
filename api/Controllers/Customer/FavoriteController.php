<?php

namespace App\Controllers\Customer;

use App\Components\ProfilePageComponent;
use App\Models\Favorite;
use App\Models\User;
use App\Utils\AlertMessage;

class FavoriteController extends CustomerController
{
  public function get()
  {
    $favorites = User::getCurrentUser()->getFavorites();

    $view = new ProfilePageComponent("favorites_page");
    $view->setTitle("Favorites");
    $view->setActivePage("favorites");
    $view->addContentData("favorites", $favorites);

    $this->render($view);
  }

  public function delete()
  {
    $product_id = post('product_id');

    if (is_null($product_id)) return redirect('?page=favorites');
    if (!user()->isFavorite($product_id)) return redirect('?page=favorites'); 

    Favorite::deleteProduct(user()->id, $product_id);
    AlertMessage::success("Product successfully removed from favorites");
    redirect('?page=favorites');
  }

  public function post()
  {
    $product_id = post('product_id');

    if (is_null($product_id)) return redirect('?page=favorites');
    if (user()->isFavorite($product_id)) return redirect('?page=favorites'); 

    $new_favorite = new Favorite;
    $new_favorite->user_id = User::getCurrentUser()->id;
    $new_favorite->product_id = $product_id;
    $new_favorite->save();

    AlertMessage::success("Product successfully added to favorites");
    redirect('?page=favorites');
  }
}