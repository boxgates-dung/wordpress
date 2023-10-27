<?php

/**
 * Latoya hooks
 *
 * @package Latoya
 */

defined('ABSPATH') || exit;

/**
 * Header hook
 */
function latoya_template_header()
{
  $header_static_id = get_static_template('theme_header_part');
  if ($header_static_id) {
    $ele = Elementor\Plugin::instance();
    echo '<header id="header">' . $ele->frontend->get_builder_content_for_display($header_static_id) . '</header>';
  }
  get_template_part('template-parts/mobile', 'nav');
}
add_action('latoya_theme_header', 'latoya_template_header');

/**
 * Footer hook
 */
function latoya_template_footer()
{
  $footer_static_id = get_static_template('theme_footer_part');
  if ($footer_static_id) {
    $ele = Elementor\Plugin::instance();
    echo '<footer id="footer">' . $ele->frontend->get_builder_content_for_display($footer_static_id) . '</footer>';
  }
}
add_action('latoya_theme_footer', 'latoya_template_footer');

function latoya_add_template_footer()
{
  /* Offcanvas */
  get_template_part('template-parts/offcanvas/offcanvas', 'menu');
  get_template_part('template-parts/offcanvas/offcanvas', 'wishlist-and-mini-cart');
}
add_action('latoya_theme_footer', 'latoya_add_template_footer', 20, 1);

/**
 * Hook product search form
 * */
function latoya_product_search_form()
{
  $args = array(
    'taxonomy'     => 'product_cat',
    'orderby'      => 'name',
    'show_count'   => 0,
    'pad_counts'   => 0,
    'hierarchical' => 1,
    'title_li'     => '',
    'hide_empty'   => true
  );
  $product_cats = get_categories($args);

  echo '<form action="' . esc_url(get_home_url()) . '" data-ajax_action="' . esc_url(admin_url('admin-ajax.php')) . '" method="get" class="search-form ajax-search show-category">';
  echo '<div class="form-group">';
  echo '<div class="input-group">';

  echo '<div class="select-category order-3 w-100">';
  echo '<select name="product_cat" id="product-cat-EzxqJ" class="dropdown_product_cat border-0 rounded-0 position-relative">';
  echo '<option value="" selected="selected">' . __('All', LATOYA_THEME_DOMAIN) . '</option>';
  foreach ($product_cats as $cat) {
    echo '<option class="level-0" value="' . $cat->slug . '">' . $cat->name . '&nbsp;&nbsp;(' . $cat->count . ')</option>';
  }
  echo '</select>';
  echo '</div>';


  echo '<button type="submit" class="button-search btn btn-sm border-0 shadow-none>"><i class="tb-icon tb-icon-search-normal"></i></button>';
  echo '<input type="text" placeholder="'.__('Search in 20.000+ products...', LATOYA_THEME_DOMAIN).'" name="s" required="" class="form-control input-sm border-0 px-1 shadow-none" autocomplete="off">';
  echo '<input type="hidden" name="post_type" value="product" class="post_type">';

  echo '<div class="search-results-wrapper"> <div class="search-results position-absolute bg-white d-none"> </div></div>';
  echo '</div>';
  echo '</div>';
  echo '</form>';
}
add_action('latoya_product_search_form', 'latoya_product_search_form');


