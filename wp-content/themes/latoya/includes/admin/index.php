<?php

/**
 * Theme Option config
 * */

// Defined
define('THEME_OPTIONS_VERSION', '1.0.0');
define('THEME_OPTIONS_DOMAIN', 'Theme Oprions');
define('THEME_OPTIONS_URI', get_template_directory_uri() . '/includes/admin/');
define('THEME_OPTIONS_DIR', get_template_directory() . '/includes/admin/');
define('THEME_OPTIONS_SLUG', 'theme_options');

// Modules
require_once THEME_OPTIONS_DIR . 'classes/class-hf-builder.php';
require_once THEME_OPTIONS_DIR . 'classes/class-mega-menu.php';

// Add new menu theme option
add_action('admin_menu', 'theme_options');
function theme_options()
{
  add_menu_page(
    'Theme Options',
    'Theme Options',
    'manage_options',
    THEME_OPTIONS_SLUG,
    '',
    THEME_OPTIONS_URI . 'assets/images/dashboard-icon.png',
    50
  );

  add_submenu_page(
    THEME_OPTIONS_SLUG,
    'Dashboard',
    'Dashboard',
    'manage_options',
    THEME_OPTIONS_SLUG,
    function () {
      include THEME_OPTIONS_DIR . 'templates/dashboard.php';
    },
    0
  );
}