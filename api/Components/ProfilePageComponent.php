<?php

namespace App\Components;

use App\Models\User;

class ProfilePageComponent extends BaseComponent
{
  protected $template = 'profile_page';
  protected BaseComponent $content;

  public function __construct($content_template, $active_page = '')
  {
    $user = User::getCurrentUser();
    $this->content = new BaseComponent($content_template, 'templates/customer/');

    $this->addData('user', $user);
    $this->addData('content', $this->content);
    $this->addData("order_count", $user->countOrder());
    $this->addData("favorite_count", $user->countFavorites());
    $this->addData("active", $active_page);
  }

  public function addContentData($key, $value)
  {
    $this->content->addData($key, $value);
  }
}