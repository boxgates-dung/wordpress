<footer>
  <!-- Footer info -->
  <div class="footer-info">
    <div class="container ">
      <div class="row">
        <div class="col-12 col-lg-4">
          <div class="footer-menu">
            <h3 class="heading-title">
              <span class="title">Support</span>
            </h3>

            <ul class="menu-vertical">
              <li id="menu-item-3872" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3872"><a href="#">Privacy policy</a></li>
              <li id="menu-item-3871" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3871"><a href="#">Refund policy</a></li>
              <li id="menu-item-3870" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3870"><a href="#">Shipping &amp; Return</a></li>
              <li id="menu-item-3869" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3869"><a href="https://el4.thembaydev.com/fana_bikini/term-of-use/">Term Of Use</a></li>
            </ul>
          </div>
        </div>

        <div class="col-12 col-lg-4">
          <div class="footer-menu">
            <h3 class="heading-title">
              <span class="title">Contact us</span>
            </h3>

            <ul class="menu-vertical">
              <li id="menu-item-3872" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3872"><a href="#">Privacy policy</a></li>
              <li id="menu-item-3871" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3871"><a href="#">Refund policy</a></li>
              <li id="menu-item-3870" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3870"><a href="#">Shipping &amp; Return</a></li>
              <li id="menu-item-3869" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3869"><a href="https://el4.thembaydev.com/fana_bikini/term-of-use/">Term Of Use</a></li>
            </ul>
            
          </div>
        </div>

        <div class="col-12 col-lg-4">
          <div class="footer-menu">
            <h3 class="heading-title">
              <span class="title">Account</span>
            </h3>

            <ul class="menu-vertical">
              <li id="menu-item-3873" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3873"><a href="https://el4.thembaydev.com/fana_bikini/my-account/">My account</a></li>
              <li id="menu-item-3874" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3874"><a href="https://el4.thembaydev.com/fana_bikini/cart/">Cart</a></li>
              <li id="menu-item-3875" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3875"><a href="https://el4.thembaydev.com/fana_bikini/wishlist/">Wishlist</a></li>
              <li id="menu-item-3876" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3876"><a href="https://el4.thembaydev.com/fana_bikini/checkout/">Checkout</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer info -->

  <!-- Copy-right -->
  <div class="copyright">
    <div class="copyright-content d-block text-center">
      <p>Copyright 2023 © <a style="color: #ca6d6f;" href="http://localhost/dev_theme/fana_full/vest-suit/">Fana</a> WordPress Theme. All rights reserved.</p>
    </div>
    <div class="payment-img d-block text-center">
      <img class="" src="https://el4.thembaydev.com/fana_bikini/wp-content/uploads/2022/08/payment.png">
    </div>
  </div>
</footer>

<?php
/* Offcanvas */
get_template_part('template-part/offcanvas/offcanvas', 'mini-cart');
get_template_part('template-part/offcanvas/offcanvas', 'menu');

/*  Modals */
get_template_part('template-part/modals/modal', 'quickview');
get_template_part('template-part/modals/modal', 'login');

get_template_part('template-part/modals/modal', 'aska-question');
get_template_part('template-part/modals/modal', 'delivery-return');
get_template_part('template-part/modals/modal', 'size-guide');

/*  Navs */
get_template_part('template-part/mobile', 'footer-nav');
get_template_part('template-part/mobile', 'quickbuy-nav');

?>

<?php wp_footer(); ?>
</body>

</html>