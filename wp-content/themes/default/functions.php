<?php

/**
 * functions.php
 * @package WordPress
 * @subpackage 
 * @since 1.0.0
 * 
 */

define('THEME_DOMAIN', 'latoya');
define('THEME_URI', get_template_directory_uri());
define('THEME_PATH', get_template_directory());

// require_once THEME_PATH . '/inc/hooks.php';

/**
 * Theme setup.
 */

function theme_setup()
{
  load_theme_textdomain(THEME_DOMAIN, THEME_PATH . '/languages');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('align-wide');
  add_theme_support('wp-block-styles');
  add_theme_support('editor-styles');
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
  add_theme_support(
    'custom-logo',
    array(
      'height' => 190,
      'width' => 190,
      'flex-width' => true,
      'flex-height' => true,
    )
  );
  set_post_thumbnail_size(800, 1022, true);

  register_nav_menus(
    array(
      'primary' => __('Primary Menu', THEME_DOMAIN),
    )
  );

  // Enqueue editor styles.
  add_editor_style('style-editor.css');
  remove_theme_support('widgets-block-editor');
}

add_action('after_setup_theme', 'theme_setup');

/**
 * Enqueue theme assets.
 */

function theme_enqueue_scripts()
{
  $theme = wp_get_theme();

  wp_enqueue_style('theme-vendors', get_stylesheet_directory_uri() . '/assets/dist/css/vendors.css', array(), $theme->get('Version'));
  wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/dist/css/theme.css', array(), $theme->get('Version'));
  wp_enqueue_style('theme-index-css', get_stylesheet_directory_uri() . '/style.css', array(), $theme->get('Version'));
  wp_enqueue_script('theme-app', get_stylesheet_directory_uri() . '/assets/dist/js/app.min.js', array('jquery'), $theme->get('Version'));
}

add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

/**
 * Theme widget init
 */

function theme_widgets_init()
{
  register_sidebar(array(
    'name'          => 'Blog sidebar',
    'id'            => 'sidebar-blog',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ));
}

add_action('widgets_init', 'theme_widgets_init');

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
      echo '<option value="0">' . __('— Select —', THEME_DOMAIN) . '</option>';
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
      echo '<option value="0">' . __('— Select —', THEME_DOMAIN) . '</option>';
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

/**
 * Get template elementor id
 * */
function get_static_template($static_name)
{
  $staticId = false;
  if (!is_singular('elementor_library')) {
    $staticId = get_option($static_name);
  }
  return $staticId;
}
