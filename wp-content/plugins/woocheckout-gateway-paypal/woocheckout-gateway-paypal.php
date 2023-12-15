<?php
/*
 * Plugin Name: Woocheckout Paypal Gateway
 * Plugin URI: https://google.com/
 * Description: Adds a more advanced paging navigation to your WordPress blog
 * Author: Kamalar
 * Author URI: https://google.com/
 * Version: 1.0.0
 * Text Domain: WooCommerce Gateway
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Required minimums and constants
 */
define('WOOCHECKOUT_GATEWAY_PAYPAL_VERSION', '1.0.0');
define('WOOCHECKOUT_GATEWAY_PAYPAL_MIN_PHP_VER', '8.0.0');
define('WOOCHECKOUT_GATEWAY_PAYPAL_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('WOOCHECKOUT_GATEWAY_PAYPAL_PLUGIN_URI', plugin_dir_url(__FILE__));
define('WOOCHECKOUT_GATEWAY_PAYPAL_BASENAME', plugin_basename(__FILE__));
define('WOOCHECKOUT_GATEWAY_PAYPAL_PLUGIN_DOMAIN', 'WOOCHECKOUT GATEWAY PAYPAL');

/**
 * Loaded class is plugin active
 * */
add_action('plugins_loaded', 'woocheckout_gateway_paypal_load');
function woocheckout_gateway_paypal_load()
{
  // Check plugin woocommerce is active
  if (!class_exists('WooCommerce')) {
    add_action('admin_notices', function () {
      echo '<div class="error"><p><strong>' . sprintf(esc_html__('Stripe requires WooCommerce to be installed and active. You can download %s here.', WOOCHECKOUT_GATEWAY_PAYPAL_PLUGIN_DOMAIN), '<a href="https://woocommerce.com/" target="_blank">WooCommerce</a>') . '</strong></p></div>';
    });
    return;
  }

  // Check php version minimun
  if (version_compare(phpversion(), WOOCHECKOUT_GATEWAY_PAYPAL_MIN_PHP_VER, '<')) {
    add_action('admin_notices', function () {
      echo '<div class="error"><p>' . sprintf(__('WooCommerce Stripe - The minimum PHP version required for this plugin is %1$s. You are running %2$s.', WOOCHECKOUT_GATEWAY_PAYPAL_PLUGIN_DOMAIN), WOOCHECKOUT_GATEWAY_PAYPAL_MIN_PHP_VER, phpversion()) . '</p></div>';
    });
    return;
  }
  require_once WOOCHECKOUT_GATEWAY_PAYPAL_PLUGIN_PATH . './update.php';

  // Loaded class
  require_once WOOCHECKOUT_GATEWAY_PAYPAL_PLUGIN_PATH . './load.php';
  static $plugin;
  if (!isset($plugin)) {
    // $plugin = Load::get_instance();
  }
  return $plugin;
}
