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
  $theme_options_config = get_option('theme_options_config', array('top_header_id' => '', 'header_id' => ''));
  $top_header_static_id = $theme_options_config['top_header_id'];
  $header_static_id     = $theme_options_config['header_id'];

  echo '<header id="header" class="d-none d-xl-block">';
  if ($top_header_static_id) {
    $ele = Elementor\Plugin::instance();
    echo $ele->frontend->get_builder_content_for_display($top_header_static_id);
  }

  if ($header_static_id) {
    $ele = Elementor\Plugin::instance();
    echo $ele->frontend->get_builder_content_for_display($header_static_id);
  }
  echo '</header>';
  get_template_part('template-parts/mobile', 'nav');
}
add_action('latoya_theme_header', 'latoya_template_header');

/**
 * Footer hook
 */
function latoya_template_footer()
{
  $theme_options_config = get_option('theme_options_config', array('back_to_top_button'  => '', 'footer_id' => ''));
  $footer_static_id     = $theme_options_config['footer_id'];
  $back_to_top_button   = $theme_options_config['back_to_top_button'];

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

  /* Back to top button */
  if (!empty($back_to_top_button)) {
    echo '<div class="latoya-to-top active"><a href="javascript:void(0);" id="back-to-top"><i class="tb-icon tb-icon-arrow-top"></i></a></div>';
  }
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
 * Hook free shipping progress bar
 * */
function latoya_free_shipping_progress_bar()
{
  get_template_part('template-parts/free', 'shipping-progress-bar');
}
add_action('latoya_free_shipping_progress_bar', 'latoya_free_shipping_progress_bar');

/**
 * Hook render form login
 * */
function latoya_form_login()
{
  wc_get_template('myaccount/form-login.php');
}
add_action('latoya_form_login', 'latoya_form_login');
