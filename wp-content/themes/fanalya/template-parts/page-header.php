<?php if (class_exists('WooCommerce')) : ?>
  <?php if (is_cart() || is_page('wishlist') || is_account_page()) : ?>
    <div class="page-header h-20 bg-[#f1f2f4] text-[#909097] overflow-y-scroll md:overflow-hidden">
      <div class="container h-full m-auto text-center">
        <!-- Breacrum -->
        <ul class="whitespace-nowrap">
          <li class="shopping-cart-link <?php echo is_cart() ? 'active' : ''; ?> inline-block relative h-20 px-[20px] py-0 font-medium text-base w-max">
            <a href="<?php echo wc_get_cart_url(); ?>" class="flex h-full items-center justify-center relative">
              <?php echo __('Shopping Cart', THEME_DOMAIN); ?>
              <span class="count cart-counter ml-2 text-white bg-slate-300 rounded-full text-xs h-5 min-w-[20px] inline-flex justify-center items-center">
                <?php echo __(WC()->cart->get_cart_contents_count(), THEME_DOMAIN); ?>
              </span>
            </a>
          </li>
          <li class="wishlist-link <?php echo is_page('wishlist') ? 'active' : ''; ?> shopping-cart-link inline-block relative h-20 px-[20px] py-0 font-medium text-base w-max">
            <a href="/wishlist" class="flex h-full items-center justify-center relative">
              <?php echo __('Wishlist', THEME_DOMAIN); ?>
              <span class="count wishlist-counter ml-2 text-white bg-slate-300 rounded-full text-xs h-5 min-w-[20px] inline-flex justify-center items-center">
                <?php echo __(yith_wcwl_count_all_products()); ?>
              </span>
            </a>
          </li>
          <li class="order-tracking-link <?php echo is_page('order') ? 'active' : '' ?> shopping-cart-link inline-block relative h-20 px-[20px] py-0 font-medium text-base w-max">
            <a href="/" class="flex h-full items-center justify-center relative">
              <?php echo __('Order Tracking', THEME_DOMAIN); ?>
            </a>
          </li>
          <li class="login-link <?php echo is_account_page() ? 'active' : ''; ?> shopping-cart-link inline-block relative h-20 px-[20px] py-0 font-medium text-base w-max">
            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="flex h-full items-center justify-center relative">
              <?php
              if (is_user_logged_in()) {
                echo __('My account', THEME_DOMAIN);
              } else {
                echo __('Login', THEME_DOMAIN);
              }
              ?>
            </a>
          </li>
        </ul>
        <!-- Breakcrum -->
      </div>
    </div>
  <?php endif; ?>
  <?php if (is_checkout()) : ?>
    <div class="page-header bg-gray-100 py-4 md:py-8">
      <div class="container mx-auto text-center">
        <h1 class="page-title text-2xl text-gray-900"><?php single_post_title(); ?></h1>
      </div>
    </div>
  <?php endif; ?>
<?php endif ?>