<?php

class Blog_Customize
{
  static private $instance;
  public $panel_name = 'Blog';
  public $panel_slug = 'latoya_panel_blog';

  static public function get_instance()
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  private function __construct()
  {
    add_action('customize_register', [$this, 'register_blog_customize']);
  }

  public function register_blog_customize($wp_customize)
  {
    $wp_customize->add_panel($this->panel_slug, array(
      'title'       => esc_html__($this->panel_name, LATOYA_THEME_DOMAIN),
      'description' => '',
      'priority'    => 20,
    ));

    // Fields config
    $this->section_blog_config($wp_customize);
  }

  public function section_blog_config($wp_customize)
  {
    $section_name = 'Blog Archive';
    $section_slug = 'latoya_section_blog_archive';

    // Section Header Settings
    $wp_customize->add_section($section_slug, array(
      'title'     => esc_html__($section_name, LATOYA_THEME_DOMAIN),
      'priority'  => 10,
      'panel'     => $this->panel_slug,
    ));

    // Blog Archive Layout Settings
    $field_blog_archive_layout_setting = 'latoya_blog_layout';
    $wp_customize->add_setting($field_blog_archive_layout_setting);

    $wp_customize->add_control('latoya_blog_archive_control', array(
      'label'       => esc_html__('Blog Archive Layout', LATOYA_THEME_DOMAIN),
      'description' => esc_html__('Select layout', LATOYA_THEME_DOMAIN),
      'section'     => $section_slug,
      'settings'    => $field_blog_archive_layout_setting,
      'type'        => 'select',
      'default'     => 'left_main',
      'choices'     => array(
        'left-sidebar'    => esc_html__('Left Sidebar', LATOYA_THEME_DOMAIN),
        'right-sidebar'   => esc_html__('Right Sidebar', LATOYA_THEME_DOMAIN),
        'full-width'      => esc_html__('Full Width', LATOYA_THEME_DOMAIN),
      ),
    ));
  }
}

Blog_Customize::get_instance();
