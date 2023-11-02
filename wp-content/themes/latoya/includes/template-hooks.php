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

  do_shortcode('[product_search_form]');

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
