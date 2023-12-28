<?php

define('THEME_DOMAIN', 'tailpress');
define('THEME_URI', get_template_directory_uri());
define('THEME_PATH', get_template_directory());

// require_once 'includes/merlin/vendor/autoload.php';
// require_once 'includes/merlin/class-merlin.php';
// require_once 'includes/merlin/merlin-config.php';

/**
 * Theme setup.
 */
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

add_action('after_setup_theme', 'theme_setup');

/**
 * Enqueue theme assets.
 */
function theme_enqueue_scripts()
{
  $theme = wp_get_theme();

  wp_enqueue_style('theme-app', theme_asset('assets/css/app.css'), array(), $theme->get('Version'));
  wp_enqueue_script('theme-app', theme_asset('assets/js/app.js'), array(), $theme->get('Version'));
  wp_enqueue_style('theme-index-css', theme_asset('style.css'), array(), $theme->get('Version'));
}

add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

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
