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
          echo '<a href="' . get_home_url() . '" class="custom-logo-link"><span>' . esc_html__(get_bloginfo('name'), LATOYA_THEME_DOMAIN) . '</span></a>';
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
      <form action="<?php echo get_home_url(); ?>" data-ajax_action="<?php echo admin_url('admin-ajax.php'); ?>" method="get" class="search-form ajax-search show-category">

        <div class="form-group">
          <div class="input-group">

            <div class="select-category order-3 w-100">
              <select name="product_cat" id="product-cat-EzxqJ" class="dropdown_product_cat border-0 rounded-0 position-relative">
                <option value="" selected="selected">All</option>
                <option class="level-0" value="accessories">Accessories&nbsp;&nbsp;(6)</option>
                <option class="level-0" value="bags">Bags&nbsp;&nbsp;(4)</option>
                <option class="level-0" value="bathing-dress">Bathing dress&nbsp;&nbsp;(10)</option>
                <option class="level-0" value="pants">Pants&nbsp;&nbsp;(9)</option>
                <option class="level-0" value="shoes">Shoes&nbsp;&nbsp;(7)</option>
                <option class="level-0" value="swimsuit">Swimsuit&nbsp;&nbsp;(10)</option>
                <option class="level-0" value="tankini">Tankini&nbsp;&nbsp;(11)</option>
                <option class="level-0" value="vintage">Vintage&nbsp;&nbsp;(8)</option>
              </select>
            </div>

            <button type="submit" class="button-search btn btn-sm border-0 shadow-none>">
              <i class="tb-icon tb-icon-search-normal"></i>
            </button>

            <input type="text" placeholder="Search in 20.000+ products..." name="s" required="" class="form-control input-sm border-0 px-1 shadow-none" autocomplete="off">
            <input type="hidden" name="post_type" value="product" class="post_type">

            <!-- Search result -->
            <div class="search-results-wrapper">
              <div class="search-results position-absolute bg-white d-none">
                <!-- <div class="suggestion-title no-found-msg">No products found.</div> -->
              </div>
            </div>


          </div>
        </div>

      </form>
      <div id="search-mobile-nav-cover"></div>
    </div>
  </div>
  <!-- End mobile form search -->
</div>