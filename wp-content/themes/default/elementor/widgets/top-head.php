<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Top_Head_Widget extends Widget_Base
{
  public static $slug = 'default_top_head';

  public function __construct($data = [], $args = null)
  {
    parent::__construct($data, $args);
  }

  public function get_name()
  {
    return self::$slug;
  }

  public function get_title()
  {
    return __('Top Head', THEME_DOMAIN);
  }

  public function get_icon()
  {
    return 'eicon-header';
  }

  public function get_categories()
  {
    return ['bgx'];
  }

  protected function register_controls()
  {
    $this->start_controls_section(
      'content_section',
      [
        'label' => esc_html__('Content', THEME_DOMAIN),
        'tab'   => Controls_Manager::TAB_CONTENT,
      ]
    );

    /* Email */
    $this->add_control(
      'email_heading',
      [
        'label'     => esc_html__('Email', THEME_DOMAIN),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->add_control(
      'email_title',
      [
        'label'       => esc_html__('Title', THEME_DOMAIN),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Default title', THEME_DOMAIN),
        'placeholder' => esc_html__('Type your title here', THEME_DOMAIN),
      ]
    );
    $this->add_control(
      'email_address',
      [
        'label'       => esc_html__('Email Address', THEME_DOMAIN),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('youremail@domain.com', THEME_DOMAIN),
        'placeholder' => esc_html__('Type your title here', THEME_DOMAIN),
      ]
    );

    $this->add_control(
      'email_url',
      [
        'label'       => esc_html__( 'Link', THEME_DOMAIN ),
				'type'        => Controls_Manager::URL,
				'options'     => [ 'url', 'is_external', 'nofollow' ],
				'default'     => [
					'url'         => 'youremail@domain.com',
					'is_external' => true,
					'nofollow'    => true,
				],
				'label_block' => true,
      ]
    );

    /* Phone */
    $this->add_control(
      'phone_heading',
      [
        'label'     => esc_html__('Phone', THEME_DOMAIN),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->add_control(
      'phone_title',
      [
        'label'       => esc_html__('Title', THEME_DOMAIN),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Default title', THEME_DOMAIN),
        'placeholder' => esc_html__('Type your title here', THEME_DOMAIN),
      ]
    );
    $this->add_control(
      'phone_address',
      [
        'label'       => esc_html__('Phone Number', THEME_DOMAIN),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Phone Number', THEME_DOMAIN),
        'placeholder' => esc_html__('Phone Number here', THEME_DOMAIN),
      ]
    );

    $this->add_control(
      'phone_url',
      [
        'label'       => esc_html__( 'Phone Link', THEME_DOMAIN ),
				'type'        => Controls_Manager::URL,
				'options'     => [ 'url', 'is_external', 'nofollow' ],
				'default'     => [
					'url'         => '840123456',
					'is_external' => true,
					'nofollow'    => true,
				],
				'label_block' => true,
      ]
    );

    /* Open Time */
    $this->add_control(
      'open_time_heading',
      [
        'label'     => esc_html__('Open Time', THEME_DOMAIN),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->add_control(
      'open_time_title',
      [
        'label'       => esc_html__('Title', THEME_DOMAIN),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Default title', THEME_DOMAIN),
        'placeholder' => esc_html__('Type your title here', THEME_DOMAIN),
      ]
    );

    $this->add_control(
      'open_time',
      [
        'label'       => esc_html__('Open Time', THEME_DOMAIN),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Default title', THEME_DOMAIN),
        'placeholder' => esc_html__('Type your title here', THEME_DOMAIN),
      ]
    );

    /* Address */

    $this->add_control(
      'address_heading',
      [
        'label'     => esc_html__('Address', THEME_DOMAIN),
        'type'      => Controls_Manager::HEADING,
        'separator' => 'before',
      ]
    );

    $this->add_control(
      'address_title',
      [
        'label'       => esc_html__('Title', THEME_DOMAIN),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Default title', THEME_DOMAIN),
        'placeholder' => esc_html__('Type your title here', THEME_DOMAIN),
      ]
    );

    $this->add_control(
      'address',
      [
        'label'       => esc_html__('Address', THEME_DOMAIN),
        'type'        => Controls_Manager::TEXT,
        'default'     => esc_html__('Default Address', THEME_DOMAIN),
        'placeholder' => esc_html__('Type your title here', THEME_DOMAIN),
      ]
    );

    $this->add_control(
      'location_url',
      [
        'label'       => esc_html__( 'Location Link', THEME_DOMAIN ),
				'type'        => Controls_Manager::URL,
				'options'     => [ 'url', 'is_external', 'nofollow' ],
				'default'     => [
					'url'         => 'https://www.google.com/maps?q=380+St+Kilda+Road,+Melbourne,+Australia',
					'is_external' => true,
					'nofollow'    => true,
				],
				'label_block' => true,
      ]
    );

    $this->end_controls_section();
  }

  protected function render()
  {
    $settings = $this->get_settings_for_display();
?>

    <div class="header-wrap">
      <div class="header-middle">
        <div class="container">
          <div class="row">
            <div class="header-branding">
              <div class="header-branding-inner">
                <?php if (get_custom_logo()) { ?>
                  <?php echo get_custom_logo(); ?>
                <?php } else { ?>
                  <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-logo-link">
                    <span>
                      <?php echo get_bloginfo('name'); ?>
                    </span>
                  </a>
                <?php } ?>
              </div>
            </div>

            <div class="header-holder">
              <div class="middle-item">
                <div class="middle-icon"><i class="flaticon flaticon-mail"></i></div>
                <div class="middle-meta">
                  <label><?php echo $settings['email_title']; ?></label>
                  <span><?php echo $settings['email_address']; ?></span>
                </div>
                <a href="<?php echo $settings['address_url']['url']; ?>" class="middle-link"></a>
              </div>
              <div class="middle-item">
                <div class="middle-icon"><i class="flaticon flaticon-phone"></i></div>
                <div class="middle-meta">
                  <label><?php echo $settings['phone_title']; ?></label>
                  <span><?php echo $settings['phone_address']; ?></span>
                </div>
                <a href="<?php echo $settings['phone_url']['url']; ?>" class="middle-link"></a>
              </div>
              <div class="middle-item">
                <div class="middle-icon"><i class="flaticon flaticon-alarm-clock"></i></div>
                <div class="middle-meta">
                  <label><?php echo $settings['open_time_title']; ?></label> 
                  <span><?php echo $settings['open_time']; ?></span>
                </div>
              </div>
              <div class="middle-item">
                <div class="middle-icon"><i class="flaticon flaticon-pin"></i></div>
                <div class="middle-meta">
                  <label><?php echo $settings['address_title']; ?></label>
                  <span><?php echo $settings['address']; ?></span>
                </div>
                <a href="<?php echo $settings['location_url']['url']; ?>" class="middle-link"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
  }
}
