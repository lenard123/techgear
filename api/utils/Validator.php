<?php

import('models/BaseModel');

class Validator
{
  public $is_valid = true;
  public $failure_message = '';
  public $key;
  public $value;

  public function __construct($key, $rules, $name)
  {
    $this->key = $key;
    $this->value = $this->getData();

    $data = $this->getData();

    $rules = explode("|", $rules);
    foreach ($rules as $rule) {
      $rule = explode(":", $rule);
      $main_rule = $rule[0];
      $params = count($rule) > 1 ? $rule[1] : "";
      if ($main_rule == 'required' && self::isEmpty($data))
      {
        $this->failure_message = "The $name field is required.";
        $this->is_valid = false;
        break;
      }
      if ($main_rule == 'min' && strlen($data) < intval($params)) 
      {
        $this->failure_message = "The $name field must have atleast $params characters.";
        $this->is_valid = false;
        break;
      }
      if ($main_rule == 'max' && strlen($data) > intval($params)) {
        $this->failure_message = "The $name field is too long.";
        $this->is_valid = false;
        break;
      }
      if ($main_rule == 'name' && !self::isValidName($data))
      {
        $this->failure_message = "The $name field must not contain numbers and symbols.";
        $this->is_valid = false;
        break;
      }
      if ($main_rule == 'email' && !self::isValidEmail($data))
      {
        $this->failure_message = "The $name field must be a valid email";
        $this->is_valid = false;
        break;
      }
      if ($main_rule == 'compare' && !self::isMatch($data, $params))
      {
        $this->failure_message = "The $name field does not match";
        $this->is_valid = false;
        break;
      }
      if ($main_rule == 'unique' && !self::isUnique($data, $params)) 
      {
        $this->failure_message = "Invalid $name, data already exists!";
        $this->is_valid = false;
        break;
      }
    }
  }

  static function isUnique($data, $params)
  {
    $params = explode(",", $params);
    $table = $params[0];
    $column = $params[1];
    $ignore = $params[2] ?? '';
    return !BaseModel::isExist($table, $column, $data, $ignore);
  }

  static function isMatch($data, $params)
  {
    $compare = $_POST[$params] ?? $_GET[$params] ?? '';
    return $data == $compare;
  }

  static function isValidName($data)
  {
    $pattern = "/^[a-zA-Z-' ]*$/";
    return preg_match($pattern, $data);
  }

  static function isValidEmail($data)
  {
    return filter_var($data, FILTER_VALIDATE_EMAIL);
  }

  static function isEmpty($data)
  {
    return strlen($data) <= 0;
  }

  public function getData()
  {
    return $_POST[$this->key] ?? $_GET[$this->key] ?? '';
  }
}