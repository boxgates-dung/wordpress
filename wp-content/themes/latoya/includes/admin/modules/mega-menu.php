<?php
function prefix_create_custom_post_type_mega_menu()
{
  /*
   * The $labels describes how the post type appears.
   */
  $labels = array(
    'name'          => 'Mega Menu', // Plural name
    'singular_name' => 'Mega Menu'   // Singular name
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
    'show_in_menu'        => false, // Displays in the Admin Menu (the left panel)
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

/**
 * Add Mega Menu builder to theme option menu
 * */
function add_mega_menu_submenu()
{
  add_submenu_page(
    THEME_OPTIONS_SLUG,
    'Mega Menu',
    'Mega Menu',
    'manage_options',
    'edit.php?post_type=mega_menu',
    50
  );
}
add_action('admin_menu', 'add_mega_menu_submenu');

/**
 * Check is mega menu
 * */
function is_mega_menu($id)
{


  
  return true;
}

/**
 * Display custom field in menu dashboard
 * */
function nav_menu_item_custom_field($item_id)
{
  print_r(wp_get_nav_menu_object($item_id));
  $menuitems = wp_get_nav_menu_items($item_id, array( 'order' => 'DESC' ) );
  print_r($menuitems);

  $mega_menu_width = get_post_meta($item_id, 'mega-menu-item-width', true);

  if (is_mega_menu($item_id)) {
    // Option mega menu width select box
    $options = array(
      array(
        'value' => '',
        'title' => 'Default',
      ),
      array(
        'value' => 'container',
        'title' => 'Container Width',
      ),
      array(
        'value' => 'full',
        'title' => 'Full Width',
      ),
    );

    // Display fields
    echo '<p class="mega_menu_item_width">';
    echo '<label for="edit-mega-menu-item-width-' . $item_id . '">';
    echo __('Mega Menu Item Width', LATOYA_THEME_DOMAIN);
    echo '<br>';
    echo '<select id="edit-mega-menu-item-width-' . $item_id . '" name="mega-menu-item-width[' . $item_id . ']">';
    foreach ($options as $option) {
      echo '<option value="' . esc_attr($option['value']) . '" ' . ($option['value'] == $mega_menu_width ? 'selected' : '') . '>' . __($option['title'], LATOYA_THEME_DOMAIN) . '</option>';
    }
    echo '</select>';
    echo '</label>';
    echo '</p>';
  }
}
add_action('wp_nav_menu_item_custom_fields', 'nav_menu_item_custom_field');

/**
 * Save post meta mega menu
 * */
function save_mega_menu_item_width($menu_id, $menu_item_db_id)
{
  if (isset($_POST['mega-menu-item-width'][$menu_item_db_id])) {
    $sanitized_data = sanitize_text_field($_POST['mega-menu-item-width'][$menu_item_db_id]);
    update_post_meta($menu_item_db_id, 'mega-menu-item-width', $sanitized_data);
  } else {
    delete_post_meta($menu_item_db_id, 'mega-menu-item-width');
  }
}
add_action('wp_update_nav_menu_item', 'save_mega_menu_item_width', 10, 2);
