<?php

namespace WPEmailMarketing\Utilities;

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
    if (isset($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return true;
    } else {
      return false;
    }
  }
}
