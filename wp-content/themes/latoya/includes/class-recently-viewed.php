<?php
/**
 * Latoya Recently Viewed Class
 *
 * @package  Recently Viewed
 */

 defined( 'ABSPATH' ) || exit;

class Recently_Viewed
{
  public static $instance;

  public static function get_instance()
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function __construct()
  {
  }
}

Recently_Viewed::get_instance();