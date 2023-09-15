<?php

namespace WPEmailMarketing;

require_once WP_EMAIL_MARKETING_PLUGIN_PATH . 'includes/subcriber/subcriber.php';
use WPEmailMarketing\Includes\Subcriber;

class Load
{
  public static function get_instance(): static
  {
    static $instance = null;
    if ($instance === null) {
      $instance = new static();
    }
    return $instance;
  }

  protected function __construct()
  {
    add_action('admin_enqueue_scripts', [$this, 'load_styles_and_scripts']);
    $this->load_modules();
  }

  /**
   * Load script and styles
   * */
  public function load_styles_and_scripts(): void
  {
    wp_register_style('wp-email-marketing-css', WP_EMAIL_MARKETING_PLUGIN_URI . '/assets/public/css/style.min.css');
    wp_enqueue_style('wp-email-marketing-css');

    wp_register_script('wp-email-marketing-js', WP_EMAIL_MARKETING_PLUGIN_URI  . '/assets/public/js/app.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('wp-email-marketing-js');
  }

  /**
   * Loads modules from the modules directory.
   */

  public function load_modules(): void
  {
    Subcriber::get_instance();
  }
}
