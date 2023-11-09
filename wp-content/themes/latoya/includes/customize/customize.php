<?php
require_once 'class-wp-editor.php';
require_once 'blog-customize.php';

add_action('customize_register', function ($wp_customize) {
  /* ===================== [ HEADER SETTINGS ] ===================== */
  $wp_customize->add_panel('fana_panel_header_settings', array(
    'title'       => __('Header Settings', LATOYA_THEME_DOMAIN),
    'description' => '',
    'priority'    => 20,
  ));
  /* ------------------------- Lựa chọn kiểu header --------------------------------- */
  // Section Header Settings
  $wp_customize->add_section('fana_section_header_type_settings', array(
    'title'     => __('Header Select Type', LATOYA_THEME_DOMAIN),
    'priority'  => 10,
    'panel'     => 'fana_panel_header_settings',
  ));

  // Header Settings
  $wp_customize->add_setting('fana_setting_header_select_type');

  // print_r($get_list_header);
  $wp_customize->add_control('fana_control_header_select_type', array(
    'label' => __('Custom Dropdown Pages'),
    'description' => __('This is a custom dropdown pages option.'),
    'type' => 'select',
    'section' => 'fana_section_header_type_settings',
    'settings'  => 'fana_setting_header_select_type',
    'choices' => array(
      'header_type_1' => 'Header Type 1',
      'header_type_2' => 'Header Type 2',
    ),
  ));
  /* ------------------------- Chỉnh sửa header top --------------------------------- */
  // Section Header Settings
  // $wp_customize->add_section('fana_section_top_header_settings', array(
  //   'title'     => __('Top Header Settings', LATOYA_THEME_DOMAIN),
  //   'priority'  => 20,
  //   'panel'     => 'fana_panel_header_settings',
  // ));

  // $wp_customize->add_setting('fana_setting_top_header_display_setting');
  // $wp_customize->add_control(new WP_Customize_Control(
  //   $wp_customize,
  //   'fana_control_top_header_display_setting',
  //   array(
  //     'label' => 'Show top notification',
  //     'section' => 'fana_section_top_header_settings',
  //     'type' => 'checkbox',
  //     'settings' => 'fana_setting_top_header_display_setting',
  //   )
  // ));

  // // Color
  // $wp_customize->add_setting('fana_setting_top_header_background_color');
  // $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'fana_control_top_header_background_color', array(
  //   'label'        => 'Background Color',
  //   'section'    => 'fana_section_top_header_settings',
  //   'settings'   => 'fana_setting_top_header_background_color',
  // )));

  // // Top notification settings
  // $wp_customize->add_setting('fana_setting_top_header_notification');
  // $wp_customize->add_control(new WP_Customize_TinyMCE_Control($wp_customize, 'fana_control_top_header_notification', array(
  //   'label'       => __('Top Bar Text Messager', LATOYA_THEME_DOMAIN),
  //   'section'     => 'fana_section_top_header_settings',
  //   'settings'    => 'fana_setting_top_header_notification',
  //   'type'        => 'textarea',
  //   'input_attrs' => [
  //     'toolbar1'     => 'formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,wp_more,spellchecker,fullscreen,wp_adv,listbuttons',
  //     'toolbar2'     => 'styleselect,strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help',
  //     'height'       => 300,
  //     'mediaButtons' => false,
  //   ]
  // )));

  // // Setup logo header
  // $wp_customize->add_section('fana_section_header_logo', array(
  //   'title'      => __('Header Logo', "bg-clotya"),
  //   'panel' => 'fana_panel_header_settings',
  //   "priority"   => 30,
  // ));

  // $wp_customize->add_setting('theme_logo_desktop');
  // $wp_customize->add_setting('theme_logo_mobile');

  // $wp_customize->add_control(new WP_Customize_Image_Control(
  //   $wp_customize,
  //   'theme_logo_desktop',
  //   array(
  //     'label' => 'Desktop Logo',
  //     'section' => 'fana_section_header_logo',
  //     'settings' => 'theme_logo_desktop',
  //   )
  // ));

  // $wp_customize->add_control(new WP_Customize_Image_Control(
  //   $wp_customize,
  //   'theme_logo_mobile',
  //   array(
  //     'label' => 'Mobile Logo',
  //     'section' => 'fana_section_header_logo',
  //     'settings' => 'theme_logo_mobile',
  //   )
  // ));

  // /* ===================== [ GENERAL SETTINGS ] ===================== */
  // $wp_customize->add_panel('fana_panel_general_settings', array(
  //   'title'       => __('General Settings', LATOYA_THEME_DOMAIN),
  //   'description' => '',
  //   'priority'    => 20,
  // ));

  // /* ------------------------- Chỉnh sửa image breacrumb --------------------------------- */
  // $wp_customize->add_section('fana_section_general_settings', array(
  //   'title'     => __('Image background breacrum', LATOYA_THEME_DOMAIN),
  //   'priority'  => 20,
  //   'panel'     => 'fana_panel_general_settings',
  // ));
  // $wp_customize->add_setting('fana_setting_breadcrumb_background_image');
  // $wp_customize->add_control(new WP_Customize_Image_Control(
  //   $wp_customize,
  //   'fana_control_breadcrumb_background_image',
  //   array(
  //     'label' => 'Breadcrumb Image',
  //     'section' => 'fana_section_general_settings',
  //     'settings' => 'fana_setting_breadcrumb_background_image',
  //   )
  // ));
  // /* ------------------------- Theme setting --------------------------------- */
  // $wp_customize->add_section('fana_section_theme_settings', array(
  //   'title'     => __('Theme Settings', LATOYA_THEME_DOMAIN),
  //   'priority'  => 20,
  //   'panel'     => 'fana_panel_general_settings',
  // ));
  // $wp_customize->add_setting('fana_setting_theme_settings');
  // $wp_customize->add_control('fana_control_theme_settings', array(
  //   'label' => __('Custom Dropdown Pages'),
  //   'description' => __('This is a custom dropdown pages option.'),
  //   'type' => 'select',
  //   'section' => 'fana_section_theme_settings',
  //   'settings'  => 'fana_setting_theme_settings',
  //   'choices' => array(
  //     'default' => 'Theme default',
  //     'theme_yellow' => 'Theme Yellow',
  //   ),
  // ));

});
