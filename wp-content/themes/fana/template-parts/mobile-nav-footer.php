<?php if (class_exists('WooCommerce')) { ?>
  <div class="mobile-nav-footer d-lg-none position-fixed start-0 w-100 bg-white clearfix">
    <div class="list-menu-icon d-flex align-items-center w-100">
      <div class="menu-icon text-center w-100">
        <a title="Home" class="home position-relative d-block <?php echo is_front_page() ? 'active' : ''; ?>" href="<?php echo get_home_url(); ?>">
          <span class="menu-icon-child d-inline-block position-relative">
            <i class="tb-icon tb-icon-home3"></i>
            <span><?php echo __('Home', THEME_DOMAIN); ?></span>
          </span>
        </a>
      </div>
      <div class="menu-icon text-center w-100">
        <a title="Shop" class="shop position-relative d-block <?php echo is_shop() ? 'active' : ''; ?>" href="<?php echo wc_get_page_permalink('shop'); ?>">
          <span class="menu-icon-child d-inline-block position-relative">
            <i class="tb-icon tb-icon-store"></i>
            <span><?php echo __('Shop', THEME_DOMAIN); ?></span>
          </span>
        </a>
      </div>
      <div class="menu-icon text-center w-100">
        <a title="Checkout" class="checkout position-relative d-block <?php echo is_checkout() ? 'active' : ''; ?>" href="<?php echo wc_get_checkout_url(); ?>">
          <span class="menu-icon-child d-inline-block position-relative">
            <i class="icon- icon-credit-card"></i>
            <span><?php echo __('Checkout', THEME_DOMAIN); ?></span>
          </span>
        </a>
      </div>
      <div class="menu-icon text-center w-100">
        <a title="Wishlist" class="wishlist position-relative d-block <?php echo is_page('wishlist') ? 'active' : ''; ?>" href="<?php echo get_permalink( get_page_by_path( 'wishlist' ) ); ?>">
          <span class="menu-icon-child d-inline-block position-relative">
            <i class="icon- icon-heart"></i>
            <span class="badge count_wishlist position-absolute text-center rounded-circle font-weight-normal text-light">
              0
            </span>
            <span><?php echo __('Wishlist', THEME_DOMAIN); ?></span>
          </span>
        </a>
      </div>
      <div class="menu-icon text-center w-100">
        <a title="My account" class="my-account position-relative d-block <?php echo is_account_page() ? 'active' : ''; ?>" href="<?php echo is_user_logged_in() ? wc_get_account_endpoint_url('dashboard') : 'javascript:void(0)'; ?>" data-toggle="modal" data-target="#loginModal">
          <span class="menu-icon-child d-inline-block position-relative">
            <i class="tb-icon tb-icon-account"></i>
            <span><?php echo __('Account', THEME_DOMAIN); ?></span>
          </span>
        </a>
      </div>
    </div>
  </div>
<?php } ?>