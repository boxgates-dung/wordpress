<?php
/*
 * Plugin Name: WP Email
 * Plugin URI: https://wp-email.work/
 * Description: Email maketing using amazone ses.
 * Author: Doodlebox Team
 * Author URI: https://wp-email.work/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Version: 1.0.0
 * Requires at least: 1.0.0
 * Requires PHP: 8.2
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

/**
 * Defined
 * */
if (!defined('WP_EMAIL_MARKETING_PLUGIN_PATH')) define('WP_EMAIL_MARKETING_PLUGIN_PATH', plugin_dir_path(__FILE__));
if (!defined('WP_EMAIL_MARKETING_PLUGIN_URI')) define('WP_EMAIL_MARKETING_PLUGIN_URI', plugin_dir_url(__FILE__));
if (!defined('WP_EMAIL_MARKETING_PLUGIN_DOMAIN')) define('WP_EMAIL_MARKETING_PLUGIN_DOMAIN', 'WP_EMAIL_MARKETING');

require 'load.php';
use WPEmailMarketing\Load;

/**
 * Email marketing init menu
 */

add_action('init', 'init_email_campaign_post_type');
function init_email_campaign_post_type()
{
  // Add post type email campaign
  $labels = array(
    'name'                  => __('Email campaigns', 'Post type general name', 'textdomain'), // h1 page title
    'singular_name'         => __('Email campaigns', 'Post type singular name', 'textdomain'),
    'menu_name'             => __('Custom Menu', 'Admin Menu text', 'textdomain'),
    'name_admin_bar'        => __('Email campaigns', 'Add New on Toolbar', 'textdomain'),
    'add_new'               => __('Add New', 'textdomain'),
    'add_new_item'          => __('Add New Email Campaigns', 'textdomain'),
    'new_item'              => __('New Email Campaigns', 'textdomain'),
    'edit_item'             => __('Edit Email Campaigns', 'textdomain'),
    'view_item'             => __('View Email Campaigns', 'textdomain'),
    'all_items'             => __('Campaigns', 'textdomain'),
    'search_items'          => __('Search Campaigns', 'textdomain'),
    'parent_item_colon'     => __('Parent Email Campaigns:', 'textdomain'),
    'not_found'             => __('No Email Campaigns found.', 'textdomain'),
    'not_found_in_trash'    => __('No Email Campaigns found in Trash.', 'textdomain'),
    'featured_image'        => __('Email Campaigns Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain'),
    'set_featured_image'    => __('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain'),
    'remove_featured_image' => __('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain'),
    'use_featured_image'    => __('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain'),
    'archives'              => __('Email Campaigns archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain'),
    'insert_into_item'      => __('Insert into Email Campaigns', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain'),
    'uploaded_to_this_item' => __('Uploaded to this Email Campaigns', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain'),
    'filter_items_list'     => __('Filter Email Campaigns list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain'),
    'items_list_navigation' => __('Email Campaigns list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain'),
    'items_list'            => __('Email Campaigns list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain'),
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array('slug' => 'email_template'),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'menu_icon'          => 'dashicons-email',
    'supports'           => array('title', 'thumbnail'),
  );

  register_post_type('email_campaign', $args);
}

// add_action('init', 'init_email_template_post_type');
function init_email_template_post_type()
{
  $labels = array(
    'name'                  => __('Email Templates', 'Post type general name', 'textdomain'), // h1 page title
    'singular_name'         => __('Email TemplatesEmail Templates', 'Post type singular name', 'textdomain'),
    'menu_name'             => __('Email Templates', 'Admin Menu text', 'textdomain'),
    'name_admin_bar'        => __('Email Templates', 'Add New on Toolbar', 'textdomain'),
    'add_new'               => __('Add New', 'textdomain'),
    'add_new_item'          => __('Add New Email Template', 'textdomain'),
    'new_item'              => __('New Email Template', 'textdomain'),
    'edit_item'             => __('Edit Email Template', 'textdomain'),
    'view_item'             => __('View Email Template', 'textdomain'),
    'all_items'             => __('Email Templates', 'textdomain'),
    'search_items'          => __('Search Template', 'textdomain'),
    'parent_item_colon'     => __('Parent Email Template:', 'textdomain'),
    'not_found'             => __('No Email Template found.', 'textdomain'),
    'not_found_in_trash'    => __('No Email Template found in Trash.', 'textdomain'),
    'featured_image'        => __('Email Template Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain'),
    'set_featured_image'    => __('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain'),
    'remove_featured_image' => __('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain'),
    'use_featured_image'    => __('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain'),
    'archives'              => __('Email Templates archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain'),
    'insert_into_item'      => __('Insert into Email Templates', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain'),
    'uploaded_to_this_item' => __('Uploaded to this Email Templates', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain'),
    'filter_items_list'     => __('Filter Email Templates list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain'),
    'items_list_navigation' => __('Email Templates list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain'),
    'items_list'            => __('Email Templates list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain'),
  );

  register_post_type('email_template', array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'query_var'          => true,
    'rewrite'            => array('slug' => 'email_template'),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,

    'show_in_menu' => 'edit.php?post_type=email_campaign',
    'supports' => array('title', 'thumbnail', 'editor'),
  ));
}

Load::get_instance();