<div class="mobile-nav d-lg-none position-fixed top-0 start-0 w-100 bg-white shadow-sm clearfix">
  <!-- Top notification -->
  <div class="topbar-device-mobile p-1 text-center text-light bg-success d-none">
    Background gradient
  </div>
  <!-- End top notification -->

  <!-- Main nav -->
  <div class="navbar-device-mobile d-flex flex-wrap align-items-center w-100">
    <div class="mobile-left-nav">
      <a class="btn btn-sm p-0 border-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu" href="javascript:void(0);">
        <i class="tb-icon tb-icon-menu"></i>
      </a>
    </div>

    <div class="mobile-logo flex-fill text-center">
      <div class="logo-theme">
        <?php if (get_custom_logo()) {
          echo get_custom_logo();
        } else {
          echo '<a href="' . esc_url(get_home_url()) . '" class="custom-logo-link"><span>' . esc_html__(get_bloginfo('name'), LATOYA_THEME_DOMAIN) . '</span></a>';
        }; ?>
      </div>
    </div>

    <div class="mobile-left-icons d-flex justify-content-between">
      <a class="mini-cart position-relative d-flex align-items-center" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWishlistAndMiniCart" aria-controls="offcanvasWishlistAndMiniCart" href="javascript:void(0);">
        <i class="tb-icon tb-icon-cart"></i>
        <span class="badge count_cart position-absolute text-center rounded-circle font-weight-normal text-light">
          <?php if (class_exists('WooCommerce')) esc_html_e(WC()->cart->get_cart_contents_count(), LATOYA_THEME_DOMAIN); ?>
        </span>
      </a>
    </div>
  </div>
  <!-- End main nav -->

  <!-- Mobile form search -->
  <div class="bottombar-device-mobile">
    <div class="search-form search-mobile">
      <?php do_action('latoya_product_search_form'); ?>
    </div>
  </div>
  <!-- End mobile form search -->
</div>