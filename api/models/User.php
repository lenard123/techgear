<?php

import("models/BaseModel");
import("models/UserInfo");
import("models/Cart");
import("models/Order");
import("models/Favorite");

class User extends BaseModel
{
  public $id;
  public $role;
  public $email;
  public $password;
  public $firstname;
  public $lastname;
  public $created_at;
  public $modified_at;

  public $carts = null;
  public $user_info = null;
  public $orders = null;
  public $favorites = null;

  public static $current_user = null;

  public static function populateData($data)
  {
    $user = new User;
    $user->id = intval($data["id"]);
    $user->role = intval($data["role"]);
    $user->email = $data["email"];
    $user->password = $data["password"];
    $user->firstname = $data["firstname"];
    $user->lastname = $data["lastname"];
    $user->created_at = strtotime($data["created_at"]);
    $user->modified_at = is_null($data["modified_at"]) ? null : strtotime($data["modified_at"]);
    return $user;
  }

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
    $stmt = self::prepareStatement("UPDATE `users` SET `role`=?, `email`=?, `password`=?, `firstname`=?, `lastname`=?, `modified_at`=CURRENT_TIMESTAMP WHERE `id`=?");
    $stmt->bind_param(
      "issssi",
      $this->role,
      $this->email,
      $this->password,
      $this->firstname,
      $this->lastname,
      $this->id
    );
    $stmt->execute();
  }

  public function save()
  {
    $user_stmt = self::prepareStatement("INSERT INTO `users`(`role`, `email`, `password`, `firstname`, `lastname`) VALUES (?, ?, ?, ?, ?)");
    $user_stmt->bind_param(
      "issss", 
      $this->role, 
      $this->email, 
      $this->password, 
      $this->firstname, 
      $this->lastname
    );
    $user_stmt->execute();
    $this->id = self::getLastId();

    UserInfo::newUser($this->id);
  }

  public function countOrder()
  {
    return Order::getOrderCount($this->id);
  }

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

  public function getFavorites()
  {
    if (is_null($this->favorites))
      $this->favorites = Favorite::getAllFromUser($this->id);
    return $this->favorites;
  }

  public function getOrders()
  {
    if (is_null($this->orders))
      $this->orders = Order::getAllFromUser($this->id);
    return $this->orders;
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

  public static function findByEmail($email)
  {
    $stmt = self::prepareStatement("SELECT * FROM `users` WHERE `email`=? limit 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
      return User::populateData($result->fetch_assoc());
    }
    return null;
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
      return $current_user->role === USER_ROLE_CUSTOMER;
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
}
