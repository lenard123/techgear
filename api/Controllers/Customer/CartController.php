<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Components\CustomerPageComponent;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Utils\AlertMessage;

class CartController extends BaseController
{
  public function __invoke()
  {
    $carts = User::getCurrentUser()->getCarts();
    $subtotal = Cart::calculateSubtotal($carts);
    $total = SITE_SHIPPING_FEE + $subtotal;

    $view = new CustomerPageComponent("cart_page");
    $view->setTitle("Shopping Cart");
    $view->addData("carts", $carts);
    $view->addData("subtotal", $subtotal);
    $view->addData("total", $total);
    $view->addJSLibrary('popper');
    $view->addJSLibrary('tippy');
    $view->addScript(asset('js/cart.js'));

    $this->renderCustomerLayout($view);
  }

  public function put()
  {
    $product = $this->getProduct();
    Cart::create(User::getCurrentUser(), $product->id);
    redirect('?page=cart');
  }

  public function delete()
  {
    User::getCurrentUser()->clearCart();
    redirect('?page=cart');
  }

  public function patch()
  {
    $cart = $this->getCart();
    $action = post('action');
    switch($action) {
      case "SUBTRACT":
        $this->add($cart, -1);
        break;

      case "ADD":
        $this->add($cart, 1);
        break;
    }
    redirect('?page=cart');
  }

  public function add($cart, $quantity)
  {
    if ($cart->quantity > $cart->getProduct()->quantity || $cart->quantity <= 0) {
      $cart->delete();
      redirect('?page=cart');
    }


    $new_quantity = $cart->quantity + $quantity;

    if ($new_quantity > $cart->getProduct()->quantity) {
      AlertMessage::failed("You have reached the maximum order for this product");
      redirect('?page=cart');
    }

    if ($new_quantity <= 0) {
      $cart->delete();
      redirect('?page=cart');
    }

    $cart->quantity = $new_quantity;
    $cart->update();
    redirect('?page=cart');

  }

  public function getCart()
  {
    $id = post('id');
    if (is_null($id)) {
      redirect('?page=cart');
    }

    $cart = Cart::find($id);
    if (is_null($cart)) {
      redirect("?page=cart");
    }

    return $cart;
  }

  public function getProduct()
  {
    $id = post('product_id');
    if (is_null($id)) {
      redirect('?page=cart');
    }

    $product = Product::find($id);
    if (is_null($product)) {
      redirect('?page=cart');
    }

    if (!$product->isAvailable()) {
      AlertMessage::failed("Product not available");
      redirect('?page=cart');
    }

    return $product;
  }

}
