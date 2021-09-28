<?php

namespace App\Components;

use App\Utils\AlertMessage;

abstract class LayoutComponent extends BaseComponent
{

  protected BaseComponent $content;

  public $page_title;
  public $js_data = [];
  public $custom_scripts = [];
  public $installed_libraries = [];
  public $meta_data = [];

  /**
   * - Local source must be placed on assets folder
   * - prod must be a url
   * - set defer to true add defer attribute to script
   **/
  private static $libraries = [
    'popper' => [
      'local' => 'js/lib/popper.min.js',
      'prod' => 'https://unpkg.com/@popperjs/core@2',
    ],
    'tippy' => [
      'local' => 'js/lib/tippy.min.js',
      'prod' => 'https://unpkg.com/tippy.js@6',
    ],
    'babel-polyfill' => [
      'local' => 'js/lib/babel-polyfill.min.js'
    ],
    'alpine' => [
      'local' => 'js/lib/alpine.min.js',
      'defer' => true
    ],
    'axios' => [
      'local' => 'js/lib/axios.min.js',
    ],
  ];

  public function __construct($content, $base_folder = null)
  {
    $this->addData('layout', $this);

    //Global JS Data
    $this->addJSData('base_url', baseURL());

    //Global Library
    $this->addJSLibrary('babel-polyfill');
    $this->addJSLibrary('alpine');

    //Global Meta Data
    $this->addMetaData('viewport', 'width=device-width,initial-scale=1');

    if ($content instanceof BaseComponent) {
      $this->content = $content;
    } else {
      $this->content = new BaseComponent($content, $base_folder);
    }
  }

  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function addContentData($key, $variable)
  {
    $this->content->addData($key, $variable);
  }

  public function addMetaData($name, $content)
  {
    $this->meta_data[$name] = $content;
  }

  public function addCustomScript($script, $isLocal = true)
  {
    $script = $isLocal ? asset($script) : $script;
    array_push($this->custom_scripts, $script);
  }

  public function addJSData($key, $value)
  {
    $this->js_data[$key] = json_encode($value);
  }

  public function addJSLibrary($library) {
    if (!isset(self::$libraries[$library])) 
      throw new \Exception("Unkown Js library: $library");
      
    array_push($this->installed_libraries, $library);
  }

  public function renderAlertNotification() {
    return AlertMessage::render();
  }

  public function renderMetaData()
  {
    $data = '  <!-- PHP Generated Meta Tags -->' . PHP_EOL;
    foreach($this->meta_data as $name => $content){
      $content = __($content);
      $data .= "  <meta name='$name' content='$content' />" . PHP_EOL;
    }
    return $data . PHP_EOL;
  }

  public function renderCustomScripts()
  {
    $data = '<!-- CUSTOM SCRIPTS -->'. PHP_EOL;
    foreach($this->custom_scripts as $source) {
      $data .= "<script src='$source'></script>" . PHP_EOL;
    }
    return $data . PHP_EOL;
  }

  public function renderLibraries()
  {
    $data = '<!-- IMPORTED LIBRARY -->' . PHP_EOL;

    foreach ($this->installed_libraries as $library) {
      $library_src = $this->getLibraryUrl($library);
      if ($library_src) {
        $defer = isset(self::$libraries[$library]['defer']) ? 'defer' : '';
        $data .= "<script src='$library_src' $defer></script>" . PHP_EOL;
      }
    }
    return $data  . PHP_EOL;
  }

  private function getLibraryUrl($library)
  {
    if (!isset(self::$libraries[$library])) return null;

    $sources = self::$libraries[$library];

    if (SITE_ENV === 'PRODUCTION') 
      return $sources['prod'] ?? asset($sources['local']);

    return asset($sources['local']);
  }

  public function renderJSData()
  {
    $data = '<!-- PHP GENERATED VARIABLES -->' . PHP_EOL;
    $data .= '<script>' . PHP_EOL;
    foreach ($this->js_data as $key => $value) {
      $data .= "  var php_$key = $value;" . PHP_EOL;
    }
    $data .= '</script>' . PHP_EOL;
    return $data . PHP_EOL;
  }

}