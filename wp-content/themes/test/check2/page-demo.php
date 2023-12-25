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
            <a class="check-out-back" href="javascript: history.go(-1);" title="Back" rel="nofollow"><i class="arrow-back"></i></a>
            <a class="back-to-cart" href="<?php echo wc_get_cart_url(); ?>" title="CART">CART</a>
            <i class="arrow-right"></i>
            <a href="javascript:void(0);" title="INFORMATION & SHIPPING" rel="nofollow" class="billing-step active">INFORMATION & SHIPPING</a>
            <i class="arrow-right"></i>
            <a href="javascript:void(0);" title="PAYMENT" rel="nofollow" class="payment-step">PAYMENT</a>
          </div>
          <!-- End header -->

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

          <?php do_action('woocommerce_checkout_before_order_review'); ?>

          <div id="order_review" class="woocommerce-checkout-review-order">
            <!-- Table overview -->
            <div class="order-review">
              <h3 id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>
              <table class="shop_table woocommerce-checkout-review-order-table">
                <thead>
                  <tr>
                    <th class="product-name"><?php esc_html_e('Product', 'woocommerce'); ?></th>
                    <th class="product-total"><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  do_action('woocommerce_review_order_before_cart_contents');

                  foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
                  ?>
                      <tr class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                        <td class="product-name">
                          <div class="product-name-wrap d-flex">
                            <div class="product-thumbnail">
                              <?php echo apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);  ?>
                              <?php echo apply_filters('woocommerce_checkout_cart_item_quantity', ' <span class="product-quantity">' . sprintf('%s', $cart_item['quantity']) . '</span>', $cart_item, $cart_item_key); ?>
                            </div>
                            <div class="product-info">
                              <?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) . '&nbsp;'; ?>
                              <?php echo wc_get_formatted_cart_item_data($cart_item); ?>
                            </div>
                          </div>
                        </td>
                        <td class="product-total">
                          <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
                        </td>
                      </tr>
                  <?php
                    }
                  }

                  do_action('woocommerce_review_order_after_cart_contents');
                  ?>
                </tbody>
                <tfoot>

                  <tr class="cart-subtotal">
                    <th><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
                    <td><?php wc_cart_totals_subtotal_html(); ?></td>
                  </tr>

                  <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
                    <tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
                      <th><?php wc_cart_totals_coupon_label($coupon); ?></th>
                      <td><?php wc_cart_totals_coupon_html($coupon); ?></td>
                    </tr>
                  <?php endforeach; ?>

                  <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

                    <?php do_action('woocommerce_review_order_before_shipping'); ?>

                    <?php wc_cart_totals_shipping_html(); ?>

                    <?php do_action('woocommerce_review_order_after_shipping'); ?>

                  <?php endif; ?>

                  <?php foreach (WC()->cart->get_fees() as $fee) : ?>
                    <tr class="fee">
                      <th><?php echo esc_html($fee->name); ?></th>
                      <td><?php wc_cart_totals_fee_html($fee); ?></td>
                    </tr>
                  <?php endforeach; ?>

                  <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
                    <?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
                      <?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited 
                      ?>
                        <tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
                          <th><?php echo esc_html($tax->label); ?></th>
                          <td><?php echo wp_kses_post($tax->formatted_amount); ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr class="tax-total">
                        <th><?php echo esc_html(WC()->countries->tax_or_vat()); ?></th>
                        <td><?php wc_cart_totals_taxes_total_html(); ?></td>
                      </tr>
                    <?php endif; ?>
                  <?php endif; ?>

                  <?php do_action('woocommerce_review_order_before_order_total'); ?>

                  <tr class="order-total">
                    <th><?php esc_html_e('Total', 'woocommerce'); ?></th>
                    <td><?php wc_cart_totals_order_total_html(); ?></td>
                  </tr>

                  <?php do_action('woocommerce_review_order_after_order_total'); ?>

                </tfoot>
              </table>
            </div>
            <!-- Table overview -->

            <!-- Payment -->
            <?php
            if (!wp_doing_ajax()) {
              do_action('woocommerce_review_order_before_payment');
            }

            $available_gateways = WC()->payment_gateways->get_available_payment_gateways();
            ?>
            <div id="payment" class="woocommerce-checkout-payment">
              <h3 id="payment_method_heading"><?php esc_html_e('Payment method', 'woocommerce'); ?></h3>

              <?php if (WC()->cart->needs_payment()) : ?>
                <ul class="wc_payment_methods payment_methods methods">
                  <?php
                  if (!empty($available_gateways)) {
                    foreach ($available_gateways as $gateway) {
                      wc_get_template('checkout/payment-method.php', array('gateway' => $gateway));
                    }
                  } else {
                    echo '<li>';
                    wc_print_notice(apply_filters('woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__('Sorry, it seems that there are no available payment methods. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce') : esc_html__('Please fill in your details above to see available payment methods.', 'woocommerce')), 'notice'); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment
                    echo '</li>';
                  }
                  ?>
                </ul>
              <?php endif; ?>
              <div class="form-row place-order">
                <noscript>
                  <?php
                  /* translators: $1 and $2 opening and closing emphasis tags respectively */
                  printf(esc_html__('Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce'), '<em>', '</em>');
                  ?>
                  <br /><button type="submit" class="button alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e('Update totals', 'woocommerce'); ?>"><?php esc_html_e('Update totals', 'woocommerce'); ?></button>
                </noscript>

                <?php wc_get_template('checkout/terms.php'); ?>

                <?php do_action('woocommerce_review_order_before_submit'); ?>

                <?php echo apply_filters('woocommerce_order_button_html', '<button type="submit" class="button alt' . esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '') . '" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr('$order_button_text') . '" data-value="' . esc_attr('$order_button_text') . '">' . esc_html('$order_button_text') . '</button>'); // @codingStandardsIgnoreLine 
                ?>

                <?php do_action('woocommerce_review_order_after_submit'); ?>

                <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
              </div>
            </div>
            <?php
            if (!wp_doing_ajax()) {
              do_action('woocommerce_review_order_after_payment');
            }
            ?>

            <!-- End payment -->
            <?php // do_action('woocommerce_checkout_order_review'); 
            ?>
          </div>

          <?php do_action('woocommerce_checkout_after_order_review'); ?>
        </div>
      </div>

    </form>

    <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
  </div>

  <script>
    jQuery(document).ready(function() {

    })
  </script>
</body>

</html>