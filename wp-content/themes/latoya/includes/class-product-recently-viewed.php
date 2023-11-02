<?php

/**
 * Latoya Product Recently Viewed Class
 *
 * @package Product Recently Viewed
 */

defined('ABSPATH') || exit;

class Product_Recently_Viewed
{
  const COOKIE_PRODUCT_RECENTLY_VIEWED = 'product_recently_viewed_x';

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
    $this->init();
  }

  public function init()
  {
    // $this->set_cookie_recently_viewed();
    add_action('latoya_theme_footer', [$this, 'set_cookie_recently_viewed']);
  }

  public function set_cookie_recently_viewed()
  {
    global $post;

    if ($post->post_type == 'product' && is_product()) {
      $cookie_value = empty($_COOKIE[$this::COOKIE_PRODUCT_RECENTLY_VIEWED]) ? [] : json_decode($_COOKIE[$this::COOKIE_PRODUCT_RECENTLY_VIEWED]);
      if (empty($cookie_value)) {
        $cookie_value[] = $post->ID;
        setcookie($this::COOKIE_PRODUCT_RECENTLY_VIEWED, json_encode($cookie_value), time() + (86400 * 30), "/"); // 86400 = 1 day
      } else {
        if (!in_array($post->ID, $cookie_value)) {
          $cookie_value[] = $post->ID;

          if (count($cookie_value) > 5) {
            array_splice($cookie_value, 0, 1);
          }

          setcookie($this::COOKIE_PRODUCT_RECENTLY_VIEWED, json_encode($cookie_value), time() + (86400 * 30), "/"); // 86400 = 1 day
        }
      }
    }
  }
}

Product_Recently_Viewed::get_instance();