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
  $theme_options_config = get_option('theme_options_config', array('header_id' => ''));
  $header_static_id     = $theme_options_config['header_id'];

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
  $theme_options_config = get_option('theme_options_config', array('footer_id' => ''));
  $footer_static_id     = $theme_options_config['footer_id'];

  if ($footer_static_id) {
    $ele = Elementor\Plugin::instance();
    echo '<footer id="footer">' . $ele->frontend->get_builder_content_for_display($footer_static_id) . '</footer>';
  }

  /* Offcanvas */
  get_template_part('template-parts/offcanvas/offcanvas', 'menu');
  get_template_part('template-parts/offcanvas/offcanvas', 'search');
  get_template_part('template-parts/offcanvas/offcanvas', 'recently-viewed');
  get_template_part('template-parts/offcanvas/offcanvas', 'wishlist-and-mini-cart');

  /* Modals */
  get_template_part('template-parts/modals/modal', 'login');

}
add_action('latoya_theme_footer', 'latoya_template_footer');

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
  echo '<select name="product_cat" class="latoya-dropdown dropdown_product_cat border-0 rounded-0 position-relative">';
  echo '<option value="" selected="selected">' . __('All Categories', LATOYA_THEME_DOMAIN) . '</option>';
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

/**
 * Hook bulk saving
 * */
function latoya_bulk_saving () {
  get_template_part('template-parts/bulk', 'saving');
}
add_action('latoya_bulk_saving', 'latoya_bulk_saving');


/**
 * Hook render form login
 * */ 
function latoya_form_login () {
  wc_get_template('myaccount/form-login.php');
}
add_action('latoya_form_login', 'latoya_form_login');
