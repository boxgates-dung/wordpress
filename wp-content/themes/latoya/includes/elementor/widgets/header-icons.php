<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Latoya_Header_Icons_Widget extends Widget_Base
{
  public static $slug = 'latoya-header-icons';

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
    return __('Header Icons', LATOYA_THEME_DOMAIN);
  }

  public function get_icon()
  {
    return 'eicon-icon-box';
  }

  public function get_categories()
  {
    return ['latoya'];
  }

  protected function register_controls()
  {
    $this->start_controls_section(
      'search_content_section',
      [
        'label' => esc_html__('Search', LATOYA_THEME_DOMAIN),
        'tab'   => Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'is_active_search',
      [
        'label'         => esc_html__('Show Icon Search', LATOYA_THEME_DOMAIN),
        'type'          => Controls_Manager::SWITCHER,
        'label_on'      => esc_html__('Show', LATOYA_THEME_DOMAIN),
        'label_off'     => esc_html__('Hide', LATOYA_THEME_DOMAIN),
        'return_value'  => 'yes',
        'default'       => 'yes',
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'myaccount_content_section',
      [
        'label' => esc_html__('My Account', LATOYA_THEME_DOMAIN),
        'tab'   => Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'is_active_my_account',
      [
        'label'         => esc_html__('Show Icon My Account', LATOYA_THEME_DOMAIN),
        'type'          => Controls_Manager::SWITCHER,
        'label_on'      => esc_html__('Show', LATOYA_THEME_DOMAIN),
        'label_off'     => esc_html__('Hide', LATOYA_THEME_DOMAIN),
        'return_value'  => 'yes',
        'default'       => 'yes',
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'recently_viewed_content_section',
      [
        'label' => esc_html__('Recently Viewed', LATOYA_THEME_DOMAIN),
        'tab'   => Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'is_active_recently_viewed',
      [
        'label'         => esc_html__('Show Icon Recently Viewed', LATOYA_THEME_DOMAIN),
        'type'          => Controls_Manager::SWITCHER,
        'label_on'      => esc_html__('Show', LATOYA_THEME_DOMAIN),
        'label_off'     => esc_html__('Hide', LATOYA_THEME_DOMAIN),
        'return_value'  => 'yes',
        'default'       => 'yes',
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'wishlist_content_section',
      [
        'label' => esc_html__('Wishlist', LATOYA_THEME_DOMAIN),
        'tab'   => Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'is_active_wishlist',
      [
        'label'         => esc_html__('Show Icon Wishlist', LATOYA_THEME_DOMAIN),
        'type'          => Controls_Manager::SWITCHER,
        'label_on'      => esc_html__('Show', LATOYA_THEME_DOMAIN),
        'label_off'     => esc_html__('Hide', LATOYA_THEME_DOMAIN),
        'return_value'  => 'yes',
        'default'       => 'yes',
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'cart_content_section',
      [
        'label' => esc_html__('Cart', LATOYA_THEME_DOMAIN),
        'tab'   => Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'is_active_cart',
      [
        'label'         => esc_html__('Show Icon Cart', LATOYA_THEME_DOMAIN),
        'type'          => Controls_Manager::SWITCHER,
        'label_on'      => esc_html__('Show', LATOYA_THEME_DOMAIN),
        'label_off'     => esc_html__('Hide', LATOYA_THEME_DOMAIN),
        'return_value'  => 'yes',
        'default'       => 'yes',
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'divider_content_section',
      [
        'label' => esc_html__('Divider', LATOYA_THEME_DOMAIN),
        'tab'   => Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'is_active_divider',
      [
        'label'         => esc_html__('Show Icon Divider', LATOYA_THEME_DOMAIN),
        'type'          => Controls_Manager::SWITCHER,
        'label_on'      => esc_html__('Show', LATOYA_THEME_DOMAIN),
        'label_off'     => esc_html__('Hide', LATOYA_THEME_DOMAIN),
        'return_value'  => 'yes',
        'default'       => 'yes',
      ]
    );

    $this->end_controls_section();
    /********************* End content *************************/
  }

  protected function render()
  {
    $settings = $this->get_settings_for_display();
?>
    <?php if (class_exists('WooCommerce')) { ?>
      <div class="row header-icons">

        <!-- Search icon -->
        <?php if ($settings['is_active_search'] == 'yes') { ?>
          <div class="search-offcanvas">
            <a href="#" class="btn-search-icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch" aria-controls="offcanvasSearch">
              <i aria-hidden="true" class="tb-icon tb-icon-search-normal"></i>
            </a>
          </div>
        <?php } ?>
        <!-- End earch icon -->

        <!-- My account icon -->
        <?php if ($settings['is_active_my_account'] == 'yes') { ?>
          <div class="account header-icon">
            <?php if (is_user_logged_in()) { ?>
              <a title="Account" href="<?php echo get_permalink(wc_get_page_id('myaccount')); ?>">
                <i aria-hidden="true" class="tb-icon tb-icon-user"></i>
              </a>
            <?php } else { ?>
              <a data-bs-toggle="modal" data-bs-target="#loginModal" href="javascript:void(0)" title="Login">
                <i aria-hidden="true" class="tb-icon tb-icon-user"></i>
              </a>
            <?php } ?>
          </div>
        <?php } ?>
        <!-- End my account icon -->

        <!-- Recently viewed -->
        <?php if ($settings['is_active_recently_viewed'] == 'yes') { ?>
          <div class="product-recently-viewed-header">
            <a href="#" class="btn-compare-icon" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRecentlyViewed" aria-controls="offcanvasRecentlyViewed">
              <i aria-hidden="true" class="tb-icon tb-icon-recently-viewed"></i>
            </a>
          </div>
        <?php } ?>
        <!-- End recently viewed -->

        <!-- Wishlist -->
        <?php if ($settings['is_active_wishlist'] == 'yes') { ?>
          <div class="wishlist">
            <a href="wishlist" class="wishlist" title="wishlist">
              <i aria-hidden="true" class="tb-icon tb-icon-heart"></i>
            </a>
          </div>
        <?php } ?>
        <!-- End wishlist -->

        <!-- Divider -->
        <?php if ($settings['is_active_divider'] == 'yes') { ?>
          <div class="divider"><span></span></div>
        <?php } ?>
        <!-- End divider -->

        <!-- Cart -->
        <?php if ($settings['is_active_cart'] == 'yes') { ?>
          <div class="mini-cart">
            <a class="dropdown-toggle mini-cart position-relative" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWishlistAndMiniCart" aria-controls="offcanvasWishlistAndMiniCart" href="javascript:void(0);" title="View your shopping cart">
              <span class="cart-icon">
                <i class="tb-icon tb-icon-cart"></i>
                <span class="mini-cart-items">
                  <?php if (!is_admin()) {
                    echo WC()->cart->get_cart_contents_count();
                  } ?>
                </span>
              </span>
              <span class="text-cart">
                <span class="subtotal">
                  <?php if (!is_admin()) {
                    echo WC()->cart->get_total();
                  } ?>
                </span>
              </span>
            </a>
          </div>
        <?php } ?>
        <!-- End cart -->
      </div>
    <?php } ?>
<?php
  }
}
