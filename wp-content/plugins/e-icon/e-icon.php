<?php

/**
 * Plugin Name: E ICON
 * Plugin URI:  https://eicon.io
 * Description: Eicon description.
 * Version:     5.7.5
 * Author:      eicon.io
 * Author URI:  https://eicon.io
 * License:     GPL2+
 * Text Domain: meta-box
 *
 * @package Meta Box
 */
if (!defined('E_PLUGIN_DIR')) {
  define('E_PLUGIN_DIR', plugin_dir_path(__FILE__)); // The path with trailing slash
}
if (!defined('E_PLUGIN_URL')) {
  define('E_PLUGIN_URL', plugin_dir_url(__FILE__)); // The path with trailing slash
}
require_once 'includes/list/cus.php';
require_once 'models/list-model.php';

use Eicon\List\cus;

cus::get_instance();
add_action('admin_enqueue_scripts', 'addEnqueueScriptsStyles');

function addEnqueueScriptsStyles(): void
{
  wp_enqueue_script('dashboard-script', E_PLUGIN_URL . './assets/app.js', array('jquery'), '', true);
}


function wpdocs_register_my_custom_menu_page()
{
  add_menu_page(
    __('Custom Menu Title', 'textdomain'),
    'custom menu',
    'manage_options',
    'custompage',
    'my_custom_menu_page',
    plugins_url('myplugin/images/icon.png'),
    6
  );
}
add_action('admin_menu', 'wpdocs_register_my_custom_menu_page');

function my_custom_menu_page()
{
  include E_PLUGIN_DIR . 'templates/cus.php';
}
