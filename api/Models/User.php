<?php

namespace App\Models;

use App\Utils\DB;
use App\Utils\Caching\Cache;

class User extends BaseModel
{
  public $id;
  public $role;
  public $email;
  public $password;
  public $firstname;
  public $lastname;
  public $image;
  public $created_at;
  public $modified_at;

  public $carts = null;
  public $user_info = null;
  public $orders = null;
  public $favorites = null;

  public static $current_user = null;

  const ROLE_CUSTOMER = 1;
  const ROLE_SUBADMIN = 2;
  const ROLE_ADMIN = 3;

  //User Info
  public function getUserInfo()
  {
    if (is_null($this->user_info))
      $this->user_info = UserInfo::findByUser($this->id);
    return $this->user_info;
  }

  public function changeEmail($email)
  {
    $_SESSION['user_email'] = $email;
    setcookie("user_email", $email, time() + (86400 * 30));
    $this->email = $email;
    $this->update();
  }

  public function update()
  {
    DB::prepare("UPDATE `users` SET `role`=?, `email`=?, `password`=?, `firstname`=?, `lastname`=?, `image`=? , `modified_at`=CURRENT_TIMESTAMP WHERE `id`=?",
      "isssssi",
      $this->role,
      $this->email,
      $this->password,
      $this->firstname,
      $this->lastname,
      $this->image,
      $this->id
    );
    Cache::forget("user:{$this->email}");
  }

  public function save()
  {
    DB::prepare("INSERT INTO `users`(`role`, `email`, `password`, `firstname`, `lastname`, `image`) VALUES (?, ?, ?, ?, ?, ?)",
      "isssss", 
      $this->role, 
      $this->email, 
      $this->password, 
      $this->firstname, 
      $this->lastname,
      $this->image
    );
    $this->id = DB::getLastId();
    UserInfo::newUser($this->id);
  }


  //Order
  public function countOrder()
  {
    return Order::getOrderCount($this->id);
  }

  public function getOrders()
  {
    if (is_null($this->orders))
      $this->orders = Order::getAllFromUser($this->id);
    return $this->orders;
  }

  //Cart
  public function countCart()
  {
    return Cart::countItem($this->id);
  }

  public function getCarts()
  {
    if (is_null($this->carts)) {
      $this->carts = Cart::getAllFromUser($this->id);
    }
    return $this->carts;
  }

  public function clearCart()
  {
    Cart::clear($this->id);
  }

  public function hasInCarts($product_id)
  {
    $carts = $this->getCarts();
    foreach ($carts as $cart) {
      if ($cart->product_id == $product_id)
        return true;
    }
    return false;
  }

  //Favorite
  public function getFavorites()
  {
    if (is_null($this->favorites))
      $this->favorites = Favorite::getAllFromUser($this->id);
    return $this->favorites;
  }

  public function countFavorites()
  {
    return Favorite::countByUser($this->id);
  }

  public function isFavorite($product_id)
  {
    foreach($this->getFavorites() as $favorite) {
      if ($favorite->product_id == $product_id)
        return true;
    }
    return false;
  }

  //Authentication
  public function login($password, $remember = null)
  {
    if (password_verify($password, $this->password)) {
      if ($remember) $this->rememberLogin();

      $_SESSION["user_email"] = $this->email;
      return true;
    }
    return false;
  }

  public function logout()
  {
    self::$current_user = null;
    unset($_SESSION['user_email']);
    self::forgetUser();
  }

  public function rememberLogin()
  {
    setcookie("user_email", $this->email, time() + (86400 * 30));
    setcookie("user_auth", md5($_SERVER['HTTP_USER_AGENT'] . $this->password), time() + (86400 * 30));
  }

  public static function forgetUser()
  {
    setcookie("user_email", "", time() - 3600);
    setcookie("user_auth", "", time() - 3600);
  }

  public static function rememberedUser()
  {
    if (isset($_COOKIE['user_email']) && isset($_COOKIE['user_auth']))
    {
      $email = $_COOKIE['user_email'];
      $user = self::findByEmail($email);
      if ($user) {
        $data = md5($_SERVER['HTTP_USER_AGENT'] . $user->password);
        if ($data == $_COOKIE['user_auth']) {
          return $user;
        }
      }
    }
    return null;
  }

  public function setPassword($password)
  {
    $this->password = password_hash($password, PASSWORD_DEFAULT);
  }


  //Static functions
  public static function findByEmail($email)
  {
    $data = Cache::remember("user:$email", fn() => (
      DB::first("SELECT * FROM `users` WHERE `email`=? limit 1", "s", $email)
    ));
    $user = self::decodeData($data);
    return self::populateData($user);
  }

  public static function getCurrentUser()
  {
    if (isset(self::$current_user)) {
      return self::$current_user;
    }

    if (isset($_SESSION["user_email"])) {
      $user = self::findByEmail($_SESSION["user_email"]);

      if (isset($user)) {
        self::$current_user = $user;
        return self::$current_user;
      } 
      unset($_SESSION["user_email"]);
    }

    if (isset($_COOKIE["user_email"]) && isset($_COOKIE["user_auth"])) {
      $remembered_user = self::rememberedUser();
      if ($remembered_user) {
        self::$current_user = $remembered_user;
        $_SESSION['user_email'] = $remembered_user->email;
        return $remembered_user;
      }
    }

    return null;
  }

  public static function isUserCustomer()
  {
    $current_user = self::getCurrentUser();
    if(isset($current_user)) {
      return $current_user->role === self::ROLE_CUSTOMER;
    }
    return false;
  }

  public static function isLogin()
  {
    $current_user = self::getCurrentUser();
    if (isset($current_user)) {
      return true;
    }
    return false;
  }

  public static function populateData($data)
  {
    if (is_null($data)) return null;
    $user = new User;
    $user->id = intval($data["id"]);
    $user->role = intval($data["role"]);
    $user->email = $data["email"];
    $user->password = $data["password"];
    $user->firstname = $data["firstname"];
    $user->lastname = $data["lastname"];
    $user->image = $data["image"];
    $user->created_at = strtotime($data["created_at"]);
    $user->modified_at = is_null($data["modified_at"]) ? null : strtotime($data["modified_at"]);
    return $user;
  }
}
