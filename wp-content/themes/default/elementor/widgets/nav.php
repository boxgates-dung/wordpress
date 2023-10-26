<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class Nav_Widget extends Widget_Base
{
  public static $slug = 'default_nav';

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
    return __('Nav', THEME_DOMAIN);
  }

  public function get_icon()
  {
    return 'eicon-nav-menu';
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
    $this->end_controls_section();
  }

  protected function render()
  {
    $settings = $this->get_settings_for_display();
?>
    <div class="header-main">
      <div class="container d-none d-lg-block p-0">
        <div class="d-flex gx-0 justify-content-around">
          <div class="row w-100">
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

            <div class="header-navigation flex-fill w-100">
              <nav class="main-navigation">
                <div class="main-navigation-inner">
                  <!-- nav -->
                  <?php wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => '',
                    'menu_class' => 'primary-menu-nav',
                  ]) ?>
                  <!-- end nav -->
                </div>
              </nav>
            </div>

            <div class="header-meta">
              <div class="header-right-item h-btn-search">
                <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </a>
              </div>
            </div>

            <div class="header-social">
              <a href="<?php echo esc_url('https://www.facebook.com/sharer/sharer.php?u=' . get_permalink(get_the_ID())); ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="<?php echo esc_url('https://twitter.com/intent/tweet?url=' . get_permalink(get_the_ID())); ?>" target="_blank"><i class="fa-brands fa-twitter"></i></a>
              <a href="<?php echo esc_url('https://www.linkedin.com/shareArticle?mini=true&url=' . get_permalink(get_the_ID())); ?>" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
              <a href="<?php echo esc_url('https://www.instagram.com/?url=' . get_permalink(get_the_ID())); ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}
