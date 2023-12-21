<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?php echo THEME_URL . "/assets/public/css/vendors.css"; ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <!-- <link rel="stylesheet" href="//avon-demo.myshopify.com/cdn/shop/t/169/assets/theme.css?v=138044047921281506061697549192" type="text/css" media="all"> -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="<?php echo THEME_URL . "/assets/public/js/app.min.js"; ?>"></script>
</head>

<body class="woocommerce-checkoutx">

  <div class="containers">
    <?php
    $checkout =  WC()->checkout();

    //do_action('woocommerce_before_checkout_form', $checkout);

    // If checkout registration is disabled and not logged in, the user cannot checkout.
    if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
      //echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
      return;
    }
    ?>

    <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

      <div class="checkout-modern-bg">
        <div class="checkout-modern-bg-left"></div>
        <div class="checkout-modern-bg-right"></div>
      </div>

      <div class="row checkout-modern-wrap">
        <div class="col-md-7 checkout-modern-left-wrap">

          <!-- header -->
          <div class="bc-modern">

            <a class="nasa-icon ns-check-out-back nasa-flex" href="javascript: history.go(-1);" title="Back" rel="nofollow">
              <svg fill="currentColor" height="25" width="25" viewBox="0 0 32 32">
                <path d="M 13.811 6.077 L 4.384 15.507 C 4.117 15.773 4.081 16.044 4.348 16.31 L 13.887 26.01 C 14.153 26.277 14.465 26.222 14.732 25.955 C 14.998 25.689 14.602 25.292 14.336 25.026 L 5.776 16.392 L 27.151 16.392 C 27.527 16.392 27.835 16.249 27.835 15.873 C 27.835 15.496 27.527 15.351 27.151 15.351 L 5.96 15.351 L 14.336 6.953 C 14.469 6.82 14.734 6.558 14.734 6.383 C 14.734 6.209 14.693 6.1 14.56 5.967 C 14.293 5.702 14.077 5.812 13.811 6.077 Z"></path>
              </svg>
            </a>


            <div class="modern-wrap">
              <div class="flex-nowrap">
                <a class="back_to_cart" href="https://elessi.nasatheme.com/shopping-cart/" title="CART">CART</a>
                <svg class="d-ltr" width="20" height="20" viewBox="0 0 32 32" fill="currentColor">
                  <path d="M19.159 16.767l0.754-0.754-6.035-6.035-0.754 0.754 5.281 5.281-5.256 5.256 0.754 0.754 3.013-3.013z"></path>
                </svg>
                <a href="javascript:void(0);" title="INFORMATION" rel="nofollow" class="billing-step active">INFORMATION</a>
                <svg class="d-ltr" width="20" height="20" viewBox="0 0 32 32" fill="currentColor">
                  <path d="M19.159 16.767l0.754-0.754-6.035-6.035-0.754 0.754 5.281 5.281-5.256 5.256 0.754 0.754 3.013-3.013z"></path>
                </svg>
                <a href="javascript:void(0);" title="SHIPPING" rel="nofollow" class="shipping-step">SHIPPING</a>
                <svg class="d-ltr" width="20" height="20" viewBox="0 0 32 32" fill="currentColor">
                  <path d="M19.159 16.767l0.754-0.754-6.035-6.035-0.754 0.754 5.281 5.281-5.256 5.256 0.754 0.754 3.013-3.013z"></path>
                </svg>
                <a href="javascript:void(0);" title="PAYMENT" rel="nofollow" class="payment-step">PAYMENT</a>
              </div>
            </div>
          </div>

          <!-- End headr -->

          <?php if ($checkout->get_checkout_fields()) : ?>

            <?php do_action('woocommerce_checkout_before_customer_details'); ?>
            <div class="col2-set" id="customer_details">
              <div class="col-1">
                <?php do_action('woocommerce_checkout_billing'); ?>
              </div>

              <div class="col-2">
                <?php do_action('woocommerce_checkout_shipping'); ?>
              </div>
            </div>
            <?php do_action('woocommerce_checkout_after_customer_details'); ?>

          <?php endif; ?>
        </div>

        <div class="col-md-5 checkout-modern-right-wrap">
          <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

          <h3 id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>

          <?php do_action('woocommerce_checkout_before_order_review'); ?>

          <div id="order_review" class="woocommerce-checkout-review-order">
            <?php do_action('woocommerce_checkout_order_review'); ?>
          </div>

          <?php do_action('woocommerce_checkout_after_order_review'); ?>
        </div>
      </div>

    </form>

    <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
  </div>

  <script>
    jQuery(document).ready(function() {

      const swiper = new Swiper('.product-main-image-wrap', {
        loop: true,
        // Navigation arrows
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      })

    })
  </script>
</body>

</html>