<div class="mobile-nav-topbar d-lg-none position-fixed top-0 start-0 w-100 bg-white shadow-sm clearfix">
  <!-- Top notification -->
  <div class="topbar-device-mobile p-1 text-center text-light bg-success d-none">
    Background gradient
  </div>
  <!-- End top notification -->

  <!-- Main nav -->
  <div class="navbar-device-mobile d-flex flex-wrap align-items-center w-100">
    <div class="mobile-hamburger-btn">
      <a class="btn btn-sm p-0 border-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu" href="javascript:void(0);">
        <i class="tb-icon tb-icon-menu"></i>
      </a>
    </div>

    <div class="mobile-logo flex-fill text-center">
      <div class="logo-theme">
        <?php if (get_custom_logo()) { ?>
          <?php echo get_custom_logo(); ?>
        <?php } else { ?>
          <a href="<?php echo get_home_url() ?>" class="custom-logo-link">
            <span>
              <?php echo get_bloginfo('name'); ?>
            </span>
          </a>
        <?php } ?>
      </div>
    </div>

    <div class="mobile-mini-cart top-cart">
      <a class="mini-cart position-relative d-block" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMiniCart" aria-controls="offcanvasMiniCart" href="javascript:void(0);">
        <i class="tb-icon tb-icon-cart"></i>
        <span class="badge count_cart position-absolute text-center rounded-circle font-weight-normal text-light">
          <?php
          if (class_exists('WooCommerce')) {
            echo WC()->cart->get_cart_contents_count();
          }
          ?>
        </span>
      </a>
    </div>
  </div>
  <!-- End main nav -->

  <!-- Mobile form search -->
  <div class="bottombar-device-mobile">
    <div class="search-form search-mobile">
      <form action="<?php echo get_home_url() ?>" method="get" class="search-form show-category">

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

            <button type="submit" class="button-search btn btn-sm border-0>">
              <i class="tb-icon tb-icon-search-normal"></i>
            </button>

            <input type="text" placeholder="Search in 20.000+ products..." name="s" required="" class="form-control input-sm border-0 shadow-none" autocomplete="off">
            <input type="hidden" name="post_type" value="product" class="post_type">

            <!-- Search result -->
            <div class="search-results-wrapper d-none">
              <div class="search-results position-static">
                <div class="autocomplete-suggestions position-absolute bg-white">
                  <!-- Render -->
                  <div class="suggestion-title no-found-msg">No products found.</div>
                  <!-- End render -->
                </div>
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