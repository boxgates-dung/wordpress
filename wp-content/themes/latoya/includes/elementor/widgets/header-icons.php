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
      'content_section',
      [
        'label' => __('Setting', LATOYA_THEME_DOMAIN),
        'tab'   => Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->end_controls_section();
    // End Style slide
  }

  protected function render()
  {
    $settings = $this->get_settings_for_display();
?>
    <div class="row header-icons">
      <div class="search-offcanvas">
        <a href="#" class="btn-search-icon search-open" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch" aria-controls="offcanvasSearch">
          <i aria-hidden="true" class="tb-icon tb-icon-search-normal"></i>
        </a>
      </div>

      <div class="account header-icon">
        <a data-bs-toggle="modal" data-bs-target="#loginModal" href="javascript:void(0)">
          <i aria-hidden="true" class="tb-icon tb-icon-user"></i>
        </a>
      </div>

      <div class="product-recently-viewed-header">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
          <i aria-hidden="true" class="tb-icon tb-icon-recently-viewed"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-start" aria-labelledby="dropdownMenuLink">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </div>
      </div>

      <div class="wishlist">
        <a href="https://el4.thembaydev.com/fana/wishlist" class="wishlist">
          <i aria-hidden="true" class="tb-icon tb-icon-heart"></i>
        </a>
      </div>

      <div class="divider"><span></span></div>

      <div class="mini-cart">
        <a class="dropdown-toggle mini-cart position-relative" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWishlistAndMiniCart" aria-controls="offcanvasWishlistAndMiniCart" href="javascript:void(0);" title="View your shopping cart">
          <span class="cart-icon">
            <i class="tb-icon tb-icon-cart"></i>
            <span class="mini-cart-items">0</span>
          </span>
          <span class="text-cart">
            <span class="subtotal">
              <?php //echo WC()->cart->get_total(); 
              ?>
            </span>
          </span>
        </a>
      </div>
    </div>

<?php
  }
}
