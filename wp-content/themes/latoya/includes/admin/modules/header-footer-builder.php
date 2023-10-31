<?php

/**
 * Register new header and footer post type
 * */
function create_custom_post_type_header_footer_builder()
{
  $args = array(
    'labels'              => array('name' => 'HF Builder', 'singular_name' => 'HF Builder'),
    'description'         => 'Header footer builder template',
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => false,
    'show_in_nav_menus'   => true,
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
add_action('init', 'create_custom_post_type_header_footer_builder', 1, 1);

/**
 * Add header & Footer builder to theme option menu
 * */
function add_header_footer_submenu()
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
add_action('admin_menu', 'add_header_footer_submenu');

/**
 * Display tag selected in header & Footer builder on dashboard page
 * */
add_filter('display_post_states', 'hf_add_post_state', 10, 2);
function hf_add_post_state($post_states, $post)
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
