<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              
 * @since             1.0.0
 * @package           Wt_Smart_Coupon
 *
 * @wordpress-plugin
 * Plugin Name:       ZWP 
 * Plugin URI:        
 * Description:       ZWP plugin adds advanced coupon features to your store to strengthen your marketing efforts and boost sales.
 * Version:           1.5.1
 * Author:            WebToffee
 * Author URI:        https://www.webtoffee.com/
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       wt-smart-coupons-for-woocommerce
 * Domain Path:       /languages
 * WC tested up to:   8.2
 */

// require_once 'includes/class-custom-postype-display.php';
require_once 'includes/temp/index.php';

function register_admin_script() {
	wp_enqueue_script( 'admin-script', plugin_dir_url(__FILE__) . '/assets/dist/js/app.min.js', array('jquery'), '1.0.0', true );
  wp_enqueue_style( 'admin_css', plugin_dir_url(__FILE__) . '/assets/dist/css/styles.min.css', false, '1.0.0' );


  // wp_enqueue_script( 'admin-script-gjs', 'https://cdn.jsdelivr.net/combine/npm/grapesjs@0.14.52,npm/grapesjs-mjml@0.0.31/dist/grapesjs-mjml.min.js', array('jquery'), '1.0.0', true );
  // wp_enqueue_style( 'admin-css-gjs', 'https://cdn.jsdelivr.net/npm/grapesjs@0.14.52/dist/css/grapes.min.css', false, '1.0.0' );
}

add_action( 'admin_enqueue_scripts', 'register_admin_script' );
