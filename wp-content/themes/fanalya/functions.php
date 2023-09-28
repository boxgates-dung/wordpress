<?php

define('THEME_DOMAIN', 'Fanalya');
define('THEME_URI', get_template_directory_uri());
define('THEME_PATH', get_template_directory());

// require_once 'includes/merlin/vendor/autoload.php';
// require_once 'includes/merlin/class-merlin.php';
// require_once 'includes/merlin/merlin-config.php';

// require_once 'includes/merlin/merlin-config.php';

/**
 * Theme setup.
 */
add_action('after_setup_theme', 'theme_setup');

function theme_setup()
{
  add_theme_support('title-tag');

  register_nav_menus(
    array(
      'primary' => __('Primary Menu', THEME_DOMAIN),
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

  load_theme_textdomain(THEME_DOMAIN, THEME_PATH . '/languages');

  add_theme_support('custom-logo');
  add_theme_support('post-thumbnails');

  add_theme_support('align-wide');
  add_theme_support('wp-block-styles');

  add_theme_support('editor-styles');
  add_editor_style('css/editor-style.css');
}

/**
 * Enqueue theme assets.
 */
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

function theme_enqueue_scripts()
{
  $theme = wp_get_theme();

  wp_enqueue_style('theme-app', theme_asset('assets/css/app.css'), array(), $theme->get('Version'));
  wp_enqueue_script('theme-app', theme_asset('assets/js/app.js'), array(), $theme->get('Version'));
  wp_enqueue_style('theme-index-css', theme_asset('style.css'), array(), $theme->get('Version'));
}

/**
 * removing Woocommerce Styles.
 */
add_action('wp_enqueue_scripts', 'removing_woo_styles');

function removing_woo_styles()
{
  wp_dequeue_style('wc-block-vendors-style');
  wp_dequeue_style('wc-block-style');
  wp_dequeue_style('woocommerce-general');
  wp_dequeue_style('woocommerce-layout');
  wp_dequeue_style('woocommerce-smallscreen');
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
 * 
 * Add wishlist button after add to cart button in single product page
 * 
 */

add_action('woocommerce_after_add_to_cart_button', 'add_custom_button', 10, 0);
function add_custom_button()
{
  echo  do_shortcode('[yith_wcwl_add_to_wishlist]');
};
