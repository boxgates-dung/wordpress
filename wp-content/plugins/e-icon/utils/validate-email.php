<?php

namespace Eicon\Utils;

class ValidateEmail
{
  public static function get_instance(): static
  {
    static $instance = null;

    if ($instance === null) {
      $instance = new static();
    }

    return $instance;
  }

  protected function __construct()
  {
  }

  public function validate($email): bool
  {
    if (isset($email)) {
      
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;

      } else {
        return true;

      }


    } else {
      return false;
    }
  }
}
