<?php

/**
 * Header and Footer builder
 *
 * @package Header and Footer builder
 */

defined('ABSPATH') || exit;

class HF_Builder
{
  public static $instance;

  public static function get_instance()
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {
    $this->init();
  }

  public function init()
  {
    add_action('init', [$this, 'create_custom_post_type_hf_builder'], 1, 1);
    add_action('admin_menu', [$this, 'add_header_footer_submenu']);
    add_filter('display_post_states', [$this, 'hf_add_post_state'], 10, 2);
  }

  /**
   * Register new header and footer post type
   * */
  public function create_custom_post_type_hf_builder()
  {
    $args = array(
      'labels'              => array('name' => 'HF Builder', 'singular_name' => 'HF Builder'),
      'description'         => 'Header footer builder template',
      'hierarchical'        => false,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => false,
      'show_in_nav_menus'   => false, // Not show on nav menu
      'show_in_admin_bar'   => true,
      'menu_position'       => 5,
      'menu_icon'           => true,
      'can_export'          => true,
      'has_archive'         => true,
      'exclude_from_search' => false,
      'publicly_queryable'  => true,
      'capability_type'     => 'post',
      'supports'            => array('title')
    );

    register_post_type('hf_builder', $args);
  }

  /**
   * Add header & Footer builder to theme option menu
   * */
  public function add_header_footer_submenu()
  {
    add_submenu_page(
      THEME_OPTIONS_SLUG,
      'Header Footer Builder',
      'Header Footer Builder',
      'manage_options',
      'edit.php?post_type=hf_builder',
      50
    );
  }

  /**
   * Display tag selected in header & Footer builder on dashboard page
   * */
  public function hf_add_post_state($post_states, $post)
  {
    $theme_options_config = get_option('theme_options_config', array(
      'header_id' => '',
      'footer_id' => ''
    ));

    if ($theme_options_config['header_id'] || $theme_options_config['footer_id']) {
      if ($post->ID == $theme_options_config['header_id']) {
        $post_states[] = 'Header Section';
      }

      if ($post->ID == $theme_options_config['footer_id']) {
        $post_states[] = 'Footer Section';
      }
    }

    return $post_states;
  }
}

HF_Builder::get_instance();
