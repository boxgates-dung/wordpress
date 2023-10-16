<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMiniCart" aria-labelledby="offcanvasMiniCartLabel">
  <div class="offcanvas-header widget-header-cart">
    <div class="header-cart-content">
      <h5 id="offcanvasMiniCartLabel" class="d-block w-100"><?php echo __('Shopping cart', THEME_DOMAIN); ?></h5>
      <a href="javascript:;" class="offcanvas-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="tb-icon tb-icon-cross"></i></a>
    </div>
  </div>
  <div class="offcanvas-body">
    <!-- Render shopping cart content -->
    <div class="widget_shopping_cart_content">
      <?php woocommerce_mini_cart(); ?>
    </div>
    <!-- End render shopping cart content -->
  </div>
</div>