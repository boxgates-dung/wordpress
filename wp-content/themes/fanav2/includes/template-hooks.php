<?php

/**
 * Woostify hooks
 *
 * @package latoya
 */

defined('ABSPATH') || exit;

/**
 * Header
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
 * Footer
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
