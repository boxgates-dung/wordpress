<?php

/**
 * Latoya Product Recently Viewed Class
 *
 * @package Product Recently Viewed
 */

defined('ABSPATH') || exit;

class Product_Recently_Viewed
{
  const COOKIE_PRODUCT_RECENTLY_VIEWED = 'product_recently_viewed';

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

  public function init(): void
  {
    add_shortcode('product_recently_viewed', [$this, 'render_product_recently_viewed']);
    add_action('woocommerce_before_single_product', [$this, 'set_cookie_recently_viewed']);
  }

  public function set_cookie_recently_viewed(): void
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

          if (count($cookie_value) > 10) {
            array_splice($cookie_value, 0, 1);
          }

          setcookie($this::COOKIE_PRODUCT_RECENTLY_VIEWED, json_encode($cookie_value), time() + (86400 * 30), "/"); // 86400 = 1 day
        }
      }
    }
  }

  /**
   * Get all product recently viewed
   * @return products
   * */
  function list_product_recently_viewed(): array
  {
    $product_ids = empty($_COOKIE[$this::COOKIE_PRODUCT_RECENTLY_VIEWED]) ? [] : json_decode($_COOKIE[$this::COOKIE_PRODUCT_RECENTLY_VIEWED]);

    if (!empty($product_ids)) {
      $products = wc_get_products(array('include' => $product_ids, 'limit' => 10));
      return $products;
    } else {
      return array();
    }
  }

  /**
   * Render html products recently viewed
   * @return html
   * */
  public function render_product_recently_viewed(): void
  {
    $products = $this->list_product_recently_viewed();
    if (!empty($products)) {
      echo '<ul class="list-recent">';
      foreach ($products as $product) {
        echo '<li class="product-item">';
        echo '<a title="' . $product->get_name() . '" href="' . $product->get_permalink() . '" class="product-image">';
        echo $product->get_image('thumbnail');
        echo '</a>';
        echo '</li>';
      }
      echo '</ul>';
    }
  }
}

Product_Recently_Viewed::get_instance();
