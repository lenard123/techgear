<?php

namespace App\Components;

class CustomerLayoutComponent extends BaseComponent
{
  protected $template = 'customer_layout';

  private static $js_libraries = [
    'popper' => [
      'local' => 'js/popper.min.js',
      'prod' => 'https://unpkg.com/@popperjs/core@2'
    ],
    'tippy' => [
      'local' => 'js/tippy.min.js',
      'prod' => 'https://unpkg.com/tippy.js@6',
    ]
  ];

  public $installed_libraries = [];

  public function __construct(CustomerPageComponent $content)
  {
    $this->addData('layout', $this);
    $this->addData("content", $content);
    $this->addData("title", $content->title);
    $this->addData("description", $content->description);
    $this->addData("scripts", $content->scripts);
    $this->addData("js_data", $content->js_data);
    $this->addData("header", new CustomerHeaderComponent);

    foreach($content->js_libraries as $library)
      $this->addJSLibrary($library);

  }

  public function addJSLibrary($library)
  {
    if (!isset(self::$js_libraries[$library])) return;

    if (SITE_ENV === 'LOCAL') {
      $library = self::$js_libraries[$library]['local'];
      array_push($this->installed_libraries, asset($library));
    } else if (SITE_ENV === 'PRODUCTION') {
      $library = self::$js_libraries[$library]['prod'];
      array_push($this->installed_libraries, $library); 
    }
  }
}
