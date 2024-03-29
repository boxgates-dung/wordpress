<?php get_header(); ?>
<?php if (true) : ?>
  <div class="h-20 bg-[#f1f2f4] text-[#909097] overflow-y-scroll md:overflow-hidden">
    <div class="container h-full m-auto text-center">
      <!-- Breacrum -->
      <ul class="whitespace-nowrap">
        <li class="shopping-cart-link inline-block relative h-20 px-[20px] py-0 font-medium text-base w-max">
          <a href="<?php echo wc_get_cart_url();?>" class="flex h-full items-center justify-center">Shopping Cart
            <span class="count cart-counter ml-2 text-white bg-slate-900 rounded-full text-xs h-5 min-w-[20px] inline-flex justify-center items-center">4</span>
          </a>
        </li>
        <li class="wishlist-link shopping-cart-link inline-block relative h-20 px-[20px] py-0 font-medium text-base w-max">
          <a href="/wishlist" class="flex h-full items-center justify-center">Wishlist
            <span class="count wishlist-counter ml-2 text-white bg-slate-900 rounded-full text-xs h-5 min-w-[20px] inline-flex justify-center items-center">3</span>
          </a>
        </li>
        <li class="order-tracking-link shopping-cart-link inline-block relative h-20 px-[20px] py-0 font-medium text-base w-max">
          <a href="https://demo.uix.store/sober/order-tracking/" class="flex h-full items-center justify-center">Order Tracking</a>
        </li>
        <li class="login-link shopping-cart-link inline-block relative h-20 px-[20px] py-0 font-medium text-base w-max">
          <a href="https://demo.uix.store/sober/my-account/" class="flex h-full items-center justify-center">Login</a>
        </li>
      </ul>
      <!-- Breakcrum -->
    </div>
  </div>
<?php endif; ?>

<div class="container m-auto">
  <?php
  if (have_posts()) {
    the_post();
    if (is_account_page() || is_cart() || is_checkout()) {
      if (is_cart() || is_checkout()) {
        get_template_part('template-part/checkout', 'stepper');
      }
      echo '<div class="container">';
      the_content();
      echo '</div>';
    } else {
      the_content();
    }
  }
  ?>
</div>

<?php get_footer();
