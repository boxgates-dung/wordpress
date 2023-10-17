<?php

/**
 * Adds a submenu page under a theme.
 */
add_action('admin_menu', 'theme_options');

function theme_options()
{
  add_submenu_page(
    "themes.php",
    __("Theme Options", THEME_DOMAIN),
    __("Theme Options", THEME_DOMAIN),
    "manage_options",
    "theme-options",
    "theme_options_page_callback"
  );
}

/**
 * Display callback for the submenu page.
 */
function theme_options_page_callback()
{
include 'theme-options.php';
}
