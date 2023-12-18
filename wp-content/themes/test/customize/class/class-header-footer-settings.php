<?php
require_once 'class-wp-editor.php';

class Header_Footer_Settings
{
  private static $instance;
  private $panel_id   = 'panel_header_footer_settings';
  private $panel_name = 'Header Footer Settings';

  public static function get_instance()
  {
    if (null === self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function __construct()
  {
    add_action('customize_register', [$this, '__customize_register']);
  }

  public function __customize_register($wp_customize)
  {
    $wp_customize->add_panel($this->panel_id, array(
      'title'       => __($this->panel_name, 'woocommerce'),
      'description' => '',
      'priority'    => 20,
    ));

    $this->section_header_top_notification_bar($wp_customize);
    $this->section_footer_template($wp_customize);
  }

  /**
   * @return setting_show_top_notification_bar;
   * @return setting_bg_top_notification_bar;
   * @return setting_text_top_notification_bar;
   * */
  public function section_header_top_notification_bar($wp_customize)
  {
    $section_id   = 'section_header_top_notification_bar';
    $section_name = __('Header Top Notification', 'woocommerce');
    $wp_customize->add_section($section_id, array('title' => $section_name, 'priority' => 10, 'panel' => $this->panel_id));

    // Fields display
    $wp_customize->add_setting('setting_show_top_notification_bar');
    $wp_customize->add_control(new WP_Customize_Control(
      $wp_customize,
      'control_show_top_notification_bar',
      array(
        'label'     => 'Show top notification',
        'section'   => $section_id,
        'type'      => 'checkbox',
        'settings'  => 'setting_show_top_notification_bar',
      )
    ));

    // Background color
    $wp_customize->add_setting('setting_bg_top_notification_bar');
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'control_bg_top_notification_bar', array(
      'label'     => 'Background Color',
      'section'   => $section_id,
      'settings'  => 'setting_bg_top_notification_bar',
    )));

    // Top notification settings
    $wp_customize->add_setting('setting_text_top_notification_bar');
    $wp_customize->add_control(new WP_Customize_TinyMCE_Control($wp_customize, 'control_text_top_notification_bar', array(
      'label'       => __('Top Bar Text Messager', 'woocommerce'),
      'section'     => $section_id,
      'settings'    => 'setting_text_top_notification_bar',
      'type'        => 'textarea',
      'input_attrs' => [
        'toolbar1'     => 'formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,wp_more,spellchecker,fullscreen,wp_adv,listbuttons',
        'toolbar2'     => 'styleselect,strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help',
        'height'       => 300,
        'mediaButtons' => false,
      ]
    )));
  }

  /**
   * @return setting_footer_select_template;
   * */
  public function section_footer_template($wp_customize)
  {
    $section_id   = 'section_footer_select_template';
    $section_name = __('Footer Template', 'woocommerce');
    $wp_customize->add_section($section_id, array('title' => $section_name, 'priority' => 10, 'panel' => $this->panel_id,));

    // Add fields in section
    $setting_footer_select_template = 'setting_footer_select_template';
    $control_footer_select_template = 'control_footer_select_template';

    $args = [
      'posts_per_page'  => -1,
      'orderby'         => 'name',
      'order'           => 'ASC',
      'post_type'       => 'elementor_library',
      'meta_query' => [
        [
          'key'   => '_elementor_template_type',
          'value' => 'section',
        ]
      ]
    ];
    $items = get_posts($args);
    $template = array();
    foreach ($items as $item) $template[$item->ID] = $item->post_title;

    $wp_customize->add_setting($setting_footer_select_template);
    $wp_customize->add_control($control_footer_select_template, array(
      'label'       => __('Select template'),
      'description' => __('Dropdown template page options or <a href="/wp-admin/edit.php?post_type=elementor_library&tabs_group=library">Add new</a>'),
      'type'        => 'select',
      'section'     => $section_id,
      'settings'    => $setting_footer_select_template,
      'choices'     => $template,
    ));
  }
}

Header_Footer_Settings::get_instance();
