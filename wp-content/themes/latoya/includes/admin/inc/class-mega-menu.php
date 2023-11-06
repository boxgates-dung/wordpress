<?php

/**
 * Mega Menu
 *
 * @package Mega Menu
 */

defined('ABSPATH') || exit;

class Mega_Menu
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
    add_action('init', [$this, 'prefix_create_custom_post_type_mega_menu'], 10, 2);
    add_action('admin_menu', [$this, 'add_submenu_theme_options'], 10, 2);
    add_action('wp_update_nav_menu_item', [$this, 'save_mega_menu_item_width'], 10, 2);
    add_action('wp_nav_menu_item_custom_fields', [$this, 'nav_menu_item_custom_field'], 10, 2);
  }

  /**
   * Create new custom post type mega menu.
   * */
  public function prefix_create_custom_post_type_mega_menu(): void
  {
    /*
   * The $labels describes.
   */
    $labels = array(
      'name'          => 'Mega Menu',
      'singular_name' => 'Mega Menu'
    );

    /*
   * The $supports parameter describes what the post type supports
   */
    $supports = array(
      'title',
      'editor',
      'excerpt',
      'author',
      'thumbnail',
      'comments',
      'trackbacks',
      'revisions',
      'custom-fields'
    );

    /*
   * The $args parameter holds important parameters for the custom post type
   */
    $args = array(
      'labels'              => $labels,
      'description'         => 'Post type mega menu', // Description
      'supports'            => $supports,
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
      'capability_type'     => 'post'
    );

    register_post_type('mega_menu', $args);
  }

  /**
   * Add submenu to theme options in admin dashboard menu
   * */
  public function add_submenu_theme_options(): void
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

  /**
   * Add custom fields to menu item setings.
   * Display on location Appearance>menus -> Menu structure
   * */
  public function nav_menu_item_custom_field($item_id, $item_object)
  {
    if ($item_object->object == 'mega_menu') {
      $cus_menu_width     = get_post_meta($item_id, 'cus_menu_width', true);
      $mega_menu_item_url = get_post_meta($item_id, 'mega_menu_item_url', true);
      $mega_menu_width    = get_post_meta($item_id, 'mega_menu_item_width', true);

      // Add field url
      echo '
      <p class="field-mega-menu-item-url">
				<label for="mega-menu-item-url-' . $item_id . '">
					' . __('Url', THEME_OPTIONS_DOMAIN) . '<br>
					<input type="text" id="mega-menu-item-url-' . $item_id . '" class="widefat mega-menu-item-url" name="mega_menu_item_url[' . $item_id . ']" value="' . $mega_menu_item_url . '" placeholder="https://">
				</label>
			</p>
      ';

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

      $option_out = '';
      foreach ($options as $option) {
        $option_out .= '<option value="' . esc_attr($option['value']) . '" ' . ($option['value'] == $mega_menu_width ? 'selected' : '') . '>' . __($option['title'], THEME_OPTIONS_DOMAIN) . '</option>';
      }

      // Display fields option
      echo '
      <p class="field-mega_menu_item_width">
        <label for="edit-mega-menu-item-width-' . $item_id . '">
          ' . __('Mega Menu Item Width', THEME_OPTIONS_DOMAIN) . '
          <br>
          <select id="edit-mega-menu-item-width-' . $item_id . '" name="mega_menu_item_width[' . $item_id . ']" class="widefat">
            ' . $option_out . '
          </select>
        </label>
      </p>
      ';

      // Script
      echo '
      <script type="application/javascript">
        jQuery(document).ready(function($) {
          $("#edit-mega-menu-item-width-' . $item_id . '").change(function() {
            if ($(this).val() === "container") {
              $(".field-cus-menu-width-' . $item_id . '").css("display", "block")
            } else {
              $(".field-cus-menu-width-' . $item_id . '").css("display", "none")
            }
          })
        })
      </script>
      ';

      // Display Set width
      echo '
      <p class="field-cus-menu-width field-cus-menu-width-' .  $item_id . '" ' . ($mega_menu_width == 'container' ? '' : 'style="display:none"') . '>
        <label for="cus-menu-width-' .  $item_id . '">
        ' . __('Edit Menu Width (px)', THEME_OPTIONS_DOMAIN) . '
        <br />
        <input type="number" class="widefat" id="cus-menu-width-' .  $item_id . '" class="edit-cus-menu-width" name="cus_menu_width[' .  $item_id . ']" value="' . $cus_menu_width . '">
        </label>
      </p>
      ';
    }
  }

  /**
   * Save data custom fields if have action save menu
   * */
  public function save_mega_menu_item_width($menu_id, $menu_item_db_id)
  {
    // Save url
    if (isset($_POST['mega_menu_item_url'][$menu_item_db_id])) {
      $sanitized_data = sanitize_text_field($_POST['mega_menu_item_url'][$menu_item_db_id]);
      update_post_meta($menu_item_db_id, 'mega_menu_item_url', $sanitized_data);
    } else {
      delete_post_meta($menu_item_db_id, 'mega_menu_item_url');
    }

    // Save type width
    if (isset($_POST['mega_menu_item_width'][$menu_item_db_id])) {
      $sanitized_data = sanitize_text_field($_POST['mega_menu_item_width'][$menu_item_db_id]);
      update_post_meta($menu_item_db_id, 'mega_menu_item_width', $sanitized_data);
    } else {
      delete_post_meta($menu_item_db_id, 'mega_menu_item_width');
    }

    // Save custom Width
    if (isset($_POST['cus_menu_width'][$menu_item_db_id])) {
      $sanitized_data = sanitize_text_field($_POST['cus_menu_width'][$menu_item_db_id]);
      update_post_meta($menu_item_db_id, 'cus_menu_width', $sanitized_data);
    } else {
      delete_post_meta($menu_item_db_id, 'cus_menu_width');
    }
  }
}

Mega_Menu::get_instance();
