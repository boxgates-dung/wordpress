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

    // $this->add_control(
		// 	'widget_title',
		// 	[
		// 		'label'       => esc_html__( 'Title', THEME_DOMAIN ),
		// 		'type'        => Controls_Manager::TEXT,
		// 		'default'     => esc_html__( 'Default title', THEME_DOMAIN ),
		// 		'placeholder' => esc_html__( 'Type your title here', THEME_DOMAIN ),
		// 	]
		// );
    $this->add_control(
			'widget_title',
			[
				'label'       => esc_html__( 'Title', THEME_DOMAIN ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Default title', THEME_DOMAIN ),
				'placeholder' => esc_html__( 'Type your title here', THEME_DOMAIN ),
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
                <div class="middle-meta"> <label>envato@gmail.com</label> <span>Mail to us</span></div> <a href="mailto:envato@gmail.com" class="middle-link"></a>
              </div>
              <div class="middle-item">
                <div class="middle-icon"><i class="flaticon flaticon-phone"></i></div>
                <div class="middle-meta"> <label>Call for help:</label> <span>(+123) 5462 3257</span></div> <a href="tel:+12354623257" class="middle-link"></a>
              </div>
              <div class="middle-item">
                <div class="middle-icon"><i class="flaticon flaticon-alarm-clock"></i></div>
                <div class="middle-meta"> <label>Sunday - Friday:</label> <span>9am - 8pm</span></div>
              </div>
              <div class="middle-item">
                <div class="middle-icon"><i class="flaticon flaticon-pin"></i></div>
                <div class="middle-meta"> <label>380 Albert St, Melbourne</label> <span>Australia</span></div> <a href="https://www.google.com/maps?q=380+St+Kilda+Road,+Melbourne,+Australia" class="middle-link"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
  }
}
