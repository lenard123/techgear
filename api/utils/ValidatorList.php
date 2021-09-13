<?php

import("utils/Validator");

class ValidatorList
{
  public $fields = [];


  public function add($key, $rules, $name)
  {
    array_push($this->fields, new Validator($key, $rules, $name));
  }

  public function fail($key, $message)
  {
    $validator = $this->getValidator($key);
    if (isset($validator)) {
      $validator->is_valid = false;
      $validator->failure_message = $message;
    }
  }

  public function hasError()
  {
    foreach ($this->fields as $validator) {
      if (!$validator->is_valid) return true;
    }
    return false;
  }

  public function isNotValid($key)
  {
    $validator = $this->getValidator($key);
    if(!is_null($validator)) {
      return !$validator->is_valid;
    }
    return false;
  }

  public function getMessage($key)
  {
    $validator = $this->getValidator($key);
    if (!is_null($validator)) {
      return $validator->failure_message;
    }
    return '';
  }

  public function getValue($key)
  {
    $validator = $this->getValidator($key);
    if (!is_null($validator)) {
      return $validator->value;
    }
    return null;
  }

  public function getValidator($key)
  {
    foreach($this->fields as $field) {
      if ($field->key === $key) {
        return $field;
      }
    }
    return null;
  }

  public function isEmpty()
  {
    return count($this->fields) <= 0;
  }
}