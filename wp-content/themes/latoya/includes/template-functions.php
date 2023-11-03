<?php

/**
 * Get page id
 *
 * @return int $page_id Page id
 */
function latoya_get_page_id()
{
  $page_id = get_queried_object_id();

  if (class_exists('woocommerce')) {
    if (is_shop()) {
      $page_id = get_option('woocommerce_shop_page_id');
    } elseif (is_product_category()) {
      $page_id = false;
    }
  }

  return $page_id;
}

/**
 * Check Elementor active
 *
 * @return bool
 */
function latoya_is_elementor_activated()
{
  return defined('ELEMENTOR_VERSION');
}

/**
 * Detect Elementor Page editor with current page
 *
 * @param int $page_id The page id.
 *
 * @return     bool
 */
function latoya_is_elementor_page($page_id = false)
{
  if (!latoya_is_elementor_activated()) {
    return false;
  }

  if (!$page_id) {
    $page_id = latoya_get_page_id();
  }

  $is_elementor_page = get_post_meta($page_id, '_elementor_edit_mode', true);
  $is_elementor_page = 'builder' === $is_elementor_page ? true : false;

  // Priority first.
  if (in_array(get_post_type($page_id), array('hf_builder', 'mega_menu'), true)) {
    return $is_elementor_page;
  }

  if (!$page_id || is_tax() || is_singular('product')) {
    $is_elementor_page = false;
  }

  return $is_elementor_page;
}