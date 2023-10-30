<?php

/**
 * Theme Option config
 * */

// Defined
define('THEME_OPTION_VERSION', '1.0.0');
define('THEME_OPTION_DOMAIN', 'Fanalya');
define('THEME_OPTION_URI', get_template_directory_uri() . '/');
define('THEME_OPTION_DIR', get_template_directory() . '/');

// Add new menu theme option
add_action('admin_menu', 'theme_option');
function theme_option()
{
  add_menu_page(
    'Theme Option',
    'Theme Option',
    'manage_options',
    'theme_option',
    '',
    THEME_OPTION_URI . 'assets/images/dashboard-icon.png',
    50
  );

  add_submenu_page(
    'theme_option',
    'Dashboard',
    'Dashboard',
    'manage_options',
    'theme_option',
    'page_theme_option'
);

  add_submenu_page(
    'theme_option',
    'Header Footer Builder',
    'Header Footer Builder',
    'manage_options',
    'edit.php?post_type=hf_builder'
  );

  add_submenu_page(
    'theme_option',
    'Mega Menu',
    'Mega Menu',
    'manage_options',
    'edit.php?post_type=mega_menu'
  );
}

function page_theme_option()
{
  echo 'asd';
}


function prefix_create_custom_post_type_mega_menu()
{
  /*
   * The $labels describes how the post type appears.
   */
  $labels = array(
    'name'          => 'Products', // Plural name
    'singular_name' => 'Product'   // Singular name
  );

  /*
   * The $supports parameter describes what the post type supports
   */
  $supports = array(
    'title',        // Post title
    'editor',       // Post content
    'excerpt',      // Allows short description
    'author',       // Allows showing and choosing author
    'thumbnail',    // Allows feature images
    'comments',     // Enables comments
    'trackbacks',   // Supports trackbacks
    'revisions',    // Shows autosaved version of the posts
    'custom-fields' // Supports by custom fields
  );

  /*
   * The $args parameter holds important parameters for the custom post type
   */
  $args = array(
    'labels'              => $labels,
    'description'         => 'Post type post product', // Description
    'supports'            => $supports,
    'taxonomies'          => array('category', 'post_tag'), // Allowed taxonomies
    'hierarchical'        => false, // Allows hierarchical categorization, if set to false, the Custom Post Type will behave like Post, else it will behave like Page
    'public'              => true,  // Makes the post type public
    'show_ui'             => true,  // Displays an interface for this post type
    'show_in_menu'        => false,  // Displays in the Admin Menu (the left panel)
    'show_in_nav_menus'   => true,  // Displays in Appearance -> Menus
    'show_in_admin_bar'   => true,  // Displays in the black admin bar
    'menu_position'       => 5,     // The position number in the left menu
    'menu_icon'           => true,  // The URL for the icon used for this post type
    'can_export'          => true,  // Allows content export using Tools -> Export
    'has_archive'         => true,  // Enables post type archive (by month, date, or year)
    'exclude_from_search' => false, // Excludes posts of this type in the front-end search result page if set to true, include them if set to false
    'publicly_queryable'  => true,  // Allows queries to be performed on the front-end part if set to true
    'capability_type'     => 'post' // Allows read, edit, delete like “Post”
  );

  register_post_type('mega_menu', $args); //Create a post type with the slug is ‘product’ and arguments in $args.
}
add_action('init', 'prefix_create_custom_post_type_mega_menu');

function create_custom_post_type_header_footer_builder()
{
  /*
   * The $labels describes how the post type appears.
   */
  $labels = array(
    'name'          => 'Products', // Plural name
    'singular_name' => 'Product'   // Singular name
  );

  /*
   * The $supports parameter describes what the post type supports
   */
  $supports = array(
    'title',        // Post title
    'editor',       // Post content
    'excerpt',      // Allows short description
    'author',       // Allows showing and choosing author
    'thumbnail',    // Allows feature images
    'comments',     // Enables comments
    'trackbacks',   // Supports trackbacks
    'revisions',    // Shows autosaved version of the posts
    'custom-fields' // Supports by custom fields
  );

  /*
   * The $args parameter holds important parameters for the custom post type
   */
  $args = array(
    'labels'              => $labels,
    'description'         => 'Post type post product', // Description
    'supports'            => $supports,
    'taxonomies'          => array('category', 'post_tag'), // Allowed taxonomies
    'hierarchical'        => false, // Allows hierarchical categorization, if set to false, the Custom Post Type will behave like Post, else it will behave like Page
    'public'              => true,  // Makes the post type public
    'show_ui'             => true,  // Displays an interface for this post type
    'show_in_menu'        => false,  // Displays in the Admin Menu (the left panel)
    'show_in_nav_menus'   => true,  // Displays in Appearance -> Menus
    'show_in_admin_bar'   => true,  // Displays in the black admin bar
    'menu_position'       => 5,     // The position number in the left menu
    'menu_icon'           => true,  // The URL for the icon used for this post type
    'can_export'          => true,  // Allows content export using Tools -> Export
    'has_archive'         => true,  // Enables post type archive (by month, date, or year)
    'exclude_from_search' => false, // Excludes posts of this type in the front-end search result page if set to true, include them if set to false
    'publicly_queryable'  => true,  // Allows queries to be performed on the front-end part if set to true
    'capability_type'     => 'post' // Allows read, edit, delete like “Post”
  );

  register_post_type('hf_builder', $args); //Create a post type with the slug is ‘product’ and arguments in $args.
}
add_action('init', 'create_custom_post_type_header_footer_builder', 1, 1);