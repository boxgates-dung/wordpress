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

require_once THEME_PATH . '/inc/widgets/class-widget-recent-posts.php';
require_once THEME_PATH . '/inc/class-walker-menu.php';
require_once THEME_PATH . '/elementor/elementor.php';

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

  // Add custom widget
  register_widget('Theme_Widget_Recent_Posts');
}

add_action('widgets_init', 'theme_widgets_init');

/**
 * Pagination layout
 * @param array  $args {
 *     (Optional) Array of arguments for generating paginated links for archives.
 *
 *     @type string $base               Base of the paginated url. Default empty.
 *     @type string $format             Format for the pagination structure. Default empty.
 *     @type int    $total              The total amount of pages. Default is the value WP_Query's
 *                                      `max_num_pages` or 1.
 *     @type int    $current            The current page number. Default is 'paged' query var or 1.
 *     @type string $aria_current       The value for the aria-current attribute. Possible values are 'page',
 *                                      'step', 'location', 'date', 'time', 'true', 'false'. Default is 'page'.
 *     @type bool   $show_all           Whether to show all pages. Default false.
 *     @type int    $end_size           How many numbers on either the start and the end list edges.
 *                                      Default 1.
 *     @type int    $mid_size           How many numbers to either side of the current pages. Default 2.
 *     @type bool   $prev_next          Whether to include the previous and next links in the list. Default true.
 *     @type bool   $prev_text          The previous page text. Default '&laquo;'.
 *     @type bool   $next_text          The next page text. Default '&raquo;'.
 *     @type string $type               Controls format of the returned value. Possible values are 'plain',
 *                                      'array' and 'list'. Default is 'array'.
 *     @type array  $add_args           An array of query args to add. Default false.
 *     @type string $add_fragment       A string to append to each link. Default empty.
 *     @type string $before_page_number A string to appear before the page number. Default empty.
 *     @type string $after_page_number  A string to append after the page number. Default empty.
 *     @type string $screen_reader_text Screen reader text for the nav element. Default 'Posts navigation'.
 * }
 * @param string $class                 (Optional) Classes to be added to the <ul> element. Default 'pagination'.
 */
function posts_pagination($args = array(), $class = 'posts-pagination')
{

  if (!$GLOBALS['wp_query'] instanceof WP_Query || (!isset($args['total']) && $GLOBALS['wp_query']->max_num_pages <= 1)) {
    return;
  }

  $args = wp_parse_args(
    $args,
    array(
      'mid_size'           => 2,
      'prev_next'          => true,
      'prev_text'          => _x('<i class="fa-solid fa-angle-left"></i>', 'previous set of posts', THEME_DOMAIN),
      'next_text'          => _x('<i class="fa-solid fa-angle-right"></i>', 'next set of posts', THEME_DOMAIN),
      'current'            => max(1, get_query_var('paged')),
      'screen_reader_text' => __('Posts navigation', THEME_DOMAIN),
    )
  );

  // Make sure we always get an array.
  $args['type'] = 'array';

  /**
   * Array of paginated links.
   *
   * @var array<int,string>
   */
  $links = paginate_links($args);
  if (empty($links)) {
    return;
  }

  echo '<nav aria-labelledby="posts-nav-label">';
  echo '<h2 id="posts-nav-label" class="screen-reader-text">' . esc_html($args['screen_reader_text']) . '</h2>';
  echo '<ul class="' . esc_attr($class) . '">';
  foreach ($links as $link) {
    $search  = array('page-numbers', 'dots');
    $replace = array('page-link', 'disabled dots');

    echo '<li class="page-item ' . (strpos($link, 'current') ? 'active' : '') . '">' . str_replace($search, $replace, $link) . '</li>';
  }
  echo '</ul>';
  echo '</nav>';
}

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

/* Register static page */
add_action('admin_init', function () {
  // register static footer part
  register_setting(
    'reading', // option group "reading", default WP group
    'theme_footer_part', // option name
    [
      'type'              => 'string',
      'sanitize_callback' => 'sanitize_text_field',
      'default'           => NULL,
    ]
  );

  // register static thanks you page
  register_setting(
    'reading', // option group "reading", default WP group
    'theme_header_part', // option name
    [
      'type'              => 'string',
      'sanitize_callback' => 'sanitize_text_field',
      'default'           => NULL,
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
        'posts_per_page'  => -1,
        'orderby'         => 'name',
        'order'           => 'ASC',
        'post_type'       => 'elementor_library',
        'meta_query'      => array(
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
        'posts_per_page'  => -1,
        'orderby'         => 'name',
        'order'           => 'ASC',
        'post_type'       => 'elementor_library',
        'meta_query'      => array(
          array(
            'key'     => '_elementor_template_type',
            'value'   => 'section',
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
