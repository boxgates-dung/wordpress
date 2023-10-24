<?php

/**
 * functions.php
 * @package WordPress
 * @subpackage Fanalya
 * @since 1.0.0
 * 
 */

define('THEME_DOMAIN', 'latoya');
define('THEME_URI', get_template_directory_uri());
define('THEME_PATH', get_template_directory());

// require_once THEME_PATH . '/admin/index.php';

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
  wp_enqueue_script('theme-app', theme_asset('assets/dist/js/app.min.js'), array('jquery'), $theme->get('Version'));
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

add_action('widgets_init', function () {
  register_sidebar(array(
    'name'          => 'Blog sidebar',
    'id'            => 'sidebar-blog',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ));
});

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


function setup_theme(): void
{
  load_theme_textdomain(THEME_DOMAIN, THEME_PATH . '/languages');
  add_theme_support('post-thumbnails');
  add_theme_support('woocommerce');
  set_post_thumbnail_size(800, 1022, true);
  register_nav_menus(
    array(
      'primary'   => __('Primary', THEME_DOMAIN),
      'footer' => __('Footer Menu', THEME_DOMAIN),
      'social' => __('Social Links Menu', THEME_DOMAIN),
      'sidebar' => __('Sidebar', THEME_DOMAIN),
    )
  );
  add_theme_support('align-wide');
  add_theme_support(
    'custom-logo',
    array(
      'height' => 190,
      'width' => 190,
      'flex-width' => true,
      'flex-height' => true,
    )
  );
  // Add support for editor styles.
  add_theme_support('editor-styles');
  // Enqueue editor styles.
  add_editor_style('style-editor.css');
  remove_theme_support('widgets-block-editor');
}
add_action('after_setup_theme', 'setup_theme');

class Mobile_Nav_Walker extends Walker_Nav_Menu {
  /**
  * Phương thức start_lvl()
  * Được sử dụng để hiển thị các thẻ bắt đầu cấu trúc của một cấp độ mới trong menu. (ví dụ: <ul class="sub-menu">)
  * @param string $output | Sử dụng để thêm nội dung vào những gì hiển thị ra bên ngoài
  * @param interger $depth | Cấp độ hiện tại của menu. Cấp độ 0 là lớn nhất.
  * @param array $args | Các tham số trong hàm wp_nav_menu()
  **/
  public function start_lvl( &$output, $depth = 0, $args = array() )
  {
    $indent = str_repeat("\t", $depth);
    $output .= "<span class=\"sub-intro\">Menu con</span>";
    $output .= "\n$indent<ul class=\"sub-menu\">\n";
 
  }
 
 
  /**
  * Phương thức end_lvl()
  * Được sử dụng để hiển thị đoạn kết thúc của một cấp độ mới trong menu. (ví dụ: </ul> )
  * @param string $output | Sử dụng để thêm nội dung vào những gì hiển thị ra bên ngoài
  * @param interger $depth | Cấp độ hiện tại của menu. Cấp độ 0 là lớn nhất.
  * @param array $args | Các tham số trong hàm wp_nav_menu()
  **/
  public function end_lvl( &$output, $depth = 0, $args = array() )
  {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }
 
 
  /**
  * Phương thức start_el()
  * Được sử dụng để hiển thị đoạn bắt đầu của một phần tử trong menu. (ví dụ: <li id="menu-item-5"> )
  * @param string $output | Sử dụng để thêm nội dung vào những gì hiển thị ra bên ngoài
  * @param string $item | Dữ liệu của các phần tử trong menu
  * @param interger $depth | Cấp độ hiện tại của menu. Cấp độ 0 là lớn nhất.
  * @param array $args | Các tham số trong hàm wp_nav_menu()
  * @param interger $id | ID của phần tử hiện tại
  **/
  public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
  {
 
 
  }
 
 
  /**
  * Phương thức end_el()
  * Được sử dụng để hiển thị đoạn kết thúc của một phần tử trong menu. (ví dụ: </li> )
  * @param string $output | Sử dụng để thêm nội dung vào những gì hiển thị ra bên ngoài
  * @param string $item | Dữ liệu của các phần tử trong menu
  * @param interger $depth | Cấp độ hiện tại của menu. Cấp độ 0 là lớn nhất.
  * @param array $args | Các tham số trong hàm wp_nav_menu()
  * @param interger $id | ID của phần tử hiện tại
  **/
  public function end_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
  {
 
 
  }
 } // end ThachPham_Nav_Walker