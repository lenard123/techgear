<?php

namespace App\Components;

class AlertComponent extends Component
{
  const STATUS_SUCCESS = 1;
  const STATUS_FAILED = 2;

  protected $template = "alert_template";

  public function __construct($status, $message)
  {
    $this->addData("status", $status);
    $this->addData("message", $message);
  }
}