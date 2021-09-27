<?php

namespace App\Components;

use App\Models\User;

class ProfilePageComponent extends CustomerPageComponent
{
  protected $base_folder = 'templates/components/';
  //protected $template = 'profile_page_layout';
  protected $content;

  public function __construct($template)
  {
    $user = User::getCurrentUser();
    $content = new BaseComponent($template, 'templates/customer/');
    $this->content = $content;
    $this->addData('user', $user);
    $this->addData('content', $content);
    $this->addData("order_count", $user->countOrder());
    $this->addData("favorite_count", $user->countFavorites());
    $this->addData("active", '');
    parent::__construct('profile_page_layout');
  }

  public function addContentData($key, $value)
  {
    $this->content->addData($key, $value);
  }

  public function setActivePage($page)
  {
    $this->addData('active', $page);
  }
}
