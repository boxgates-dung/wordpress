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
require_once LATOYA_THEME_DIR . 'includes/ajax.php';
require_once LATOYA_THEME_DIR . 'includes/template-hooks.php';
require_once LATOYA_THEME_DIR . 'includes/template-functions.php';

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

/**
 * Add wishlist button after add to cart button in single product page
 */
add_action('woocommerce_after_add_to_cart_button', 'add_custom_button', 10, 0);
function add_custom_button()
{
  echo  do_shortcode('[yith_wcwl_add_to_wishlist]');
};

/**
 * Remove breadcrumb in shop page
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20); /*remove breadcrumb*/

/* Register static page */
add_action('admin_init', function () {
  // register static footer part
  register_setting(
    'reading', // option group "reading", default WP group
    'theme_footer_part', // option name
    [
      'type' => 'string',
      'sanitize_callback' => 'sanitize_text_field',
      'default' => NULL,
    ]
  );

  // register static thanks you page
  register_setting(
    'reading', // option group "reading", default WP group
    'theme_header_part', // option name
    [
      'type' => 'string',
      'sanitize_callback' => 'sanitize_text_field',
      'default' => NULL,
    ]
  );

  // add new setting for header you page part
  add_settings_field(
    'theme_header_part', // ID
    __('Header', 'vara'), // Title
    function () {
      $staticId = get_option('theme_header_part');
      // get all pages
      $args = array(
        'posts_per_page' => -1,
        'orderby' => 'name',
        'order' => 'ASC',
        'post_type' => 'elementor_library',
        'meta_query' => array(
          array(
            'key' => '_elementor_template_type',
            'value' => 'section',
          )
        )
      );
      $items = get_posts($args);
      echo '<select id="theme_header_part" name="theme_header_part">';
      // empty option as default
      echo '<option value="0">' . __('— Select —', LATOYA_THEME_DOMAIN) . '</option>';
      // foreach page we create an option element, with the post-ID as value
      foreach ($items as $item) {
        // add selected to the option if value is the same as $project_page_id
        $selected = ($staticId == $item->ID) ? 'selected="selected"' : '';
        echo '<option value="' . $item->ID . '" ' . $selected . '>' . $item->post_title . '</option>';
      }
      echo '</select>';
    }, // Callback
    'reading',
    'default',
    array('label_for' => 'theme_header_part')
  );

  // add new setting for footer part
  add_settings_field(
    'theme_footer_part', // ID
    __('Footer', 'vara'), // Title
    function () {
      $staticId = get_option('theme_footer_part');
      // get all pages
      $args = array(
        'posts_per_page' => -1,
        'orderby' => 'name',
        'order' => 'ASC',
        'post_type' => 'elementor_library',
        'meta_query' => array(
          array(
            'key' => '_elementor_template_type',
            'value' => 'section',
          )
        )
      );
      $items = get_posts($args);
      echo '<select id="theme_footer_part" name="theme_footer_part">';
      // empty option as default
      echo '<option value="0">' . __('— Select —', LATOYA_THEME_DOMAIN) . '</option>';
      // foreach page we create an option element, with the post-ID as value
      foreach ($items as $item) {
        // add selected to the option if value is the same as $project_page_id
        $selected = ($staticId == $item->ID) ? 'selected="selected"' : '';
        echo '<option value="' . $item->ID . '" ' . $selected . '>' . $item->post_title . '</option>';
      }
      echo '</select>';
    }, // Callback
    'reading',
    'default',
    array('label_for' => 'theme_footer_part')
  );
});
