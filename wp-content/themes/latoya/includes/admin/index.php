<?php

/**
 * Theme Option config
 * */

// Defined
define('THEME_OPTION_VERSION', '1.0.0');
define('THEME_OPTION_DOMAIN', 'Fanalya');
define('THEME_OPTION_URI', get_template_directory_uri() . '/includes/admin/');
define('THEME_OPTION_DIR', get_template_directory() . '/includes/admin/');
define('THEME_OPTION_SLUG', 'theme_options');

// Modules
require_once THEME_OPTION_DIR . 'modules/header-footer-builder.php';
require_once THEME_OPTION_DIR . 'modules/mega-menu.php';

// Add new menu theme option
add_action('admin_menu', 'theme_options');
function theme_options()
{
  add_menu_page(
    'Theme Options',
    'Theme Options',
    'manage_options',
    THEME_OPTION_SLUG,
    '',
    THEME_OPTION_URI . 'assets/images/dashboard-icon.png',
    50
  );

  add_submenu_page(
    THEME_OPTION_SLUG,
    'Dashboard',
    'Dashboard',
    'manage_options',
    THEME_OPTION_SLUG,
    function () {
      include THEME_OPTION_DIR . 'templates/dashboard.php';
    },
    0
  );
}