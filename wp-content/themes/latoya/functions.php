<?php

/**
 * Latoya
 *
 * @package Latoya
 */

// Define constants.
define('LATOYA_VERSION', '2.2.5');
define('LATOYA_THEME_DOMAIN', 'Fanalya');
define('LATOYA_THEME_URI', get_template_directory_uri() . '/');
define('LATOYA_THEME_DIR', get_template_directory() . '/');

// Latoya ajax, functions, hooks.
require_once LATOYA_THEME_DIR . 'includes/class-latoya-walker-menu.php';
require_once LATOYA_THEME_DIR . 'includes/class-product-ajax-search.php';
require_once LATOYA_THEME_DIR . 'includes/class-product-recently-viewed.php';

require_once LATOYA_THEME_DIR . 'includes/ajax.php';
require_once LATOYA_THEME_DIR . 'includes/template-functions.php';
require_once LATOYA_THEME_DIR . 'includes/template-hooks.php';
require_once LATOYA_THEME_DIR . 'includes/elementor/elementor.php';
require_once LATOYA_THEME_DIR . 'includes/admin/index.php';


/**
 * Theme setup.
 */
add_action('after_setup_theme', 'theme_setup');

function theme_setup()
{
  add_theme_support('title-tag');

  register_nav_menus(
    array(
      'primary' => __('Primary Menu', LATOYA_THEME_DOMAIN),
    )
  );

  add_theme_support(
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    )
  );

  load_theme_textdomain(LATOYA_THEME_DOMAIN, LATOYA_THEME_DIR . 'languages');

  add_theme_support('custom-logo');
  add_theme_support('post-thumbnails');
  add_theme_support('align-wide');
  add_theme_support('wp-block-styles');
  add_theme_support('editor-styles');
  add_editor_style('css/editor-style.css');
}

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function theme_asset($path)
{
  if (wp_get_environment_type() === 'production') {
    return get_stylesheet_directory_uri() . '/' . $path;
  }

  return add_query_arg('time', time(),  get_stylesheet_directory_uri() . '/' . $path);
}

/**
 * Enqueue theme assets.
 */
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

function theme_enqueue_scripts()
{
  $theme = wp_get_theme();

  wp_enqueue_style('theme-vendors', theme_asset('assets/dist/css/vendors.css'), array(), $theme->get('Version'));
  wp_enqueue_style('theme-style', theme_asset('assets/dist/css/theme.css'), array(), $theme->get('Version'));
  wp_enqueue_style('theme-index-css', theme_asset('style.css'), array(), $theme->get('Version'));
  wp_enqueue_script('theme-app', theme_asset('assets/dist/js/app.min.js'), array(), $theme->get('Version'));
}

/**
 * removing Woocommerce Styles.
 */
add_action('wp_enqueue_scripts', 'removing_woo_styles');

function removing_woo_styles()
{
  // wp_dequeue_style('wc-block-vendors-style');
  // wp_dequeue_style('wc-block-style');
  wp_dequeue_style('woocommerce-general');
  // wp_dequeue_style('woocommerce-layout');
  wp_dequeue_style('woocommerce-smallscreen');
}

add_filter('body_class', 'woocommerce_body_classes');
function woocommerce_body_classes($classes)
{
  $classes[] = 'woocommerce';
  $classes[] = 'woocommerce-page';
  $classes[] = 'woocommerce-js';

  return $classes;
}

/**
 * Remove breadcrumb in shop page
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20); /*remove breadcrumb*/
