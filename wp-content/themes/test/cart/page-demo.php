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

<body class="woocommerce-cartx">

  <h1 class="page-title">YOUR CART</h1>

  <div class="container">
    <?php do_action('woocommerce_before_cart'); ?>

    <div class="row cart-row">
      <div class="col-12 col-md-8">
        <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
          <?php do_action('woocommerce_before_cart_table'); ?>

          <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
            <thead>
              <tr>
                <th class="product-name" colspan="2"><?php esc_html_e('Product', 'woocommerce'); ?></th>
                <th class="product-price" width="15%"><?php esc_html_e('Price', 'woocommerce'); ?></th>
                <th class="product-quantity" width="18%"><?php esc_html_e('Quantity', 'woocommerce'); ?></th>
                <th class="product-subtotal" width="15%"><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php do_action('woocommerce_before_cart_contents'); ?>

              <?php
              foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                /**
                 * Filter the product name.
                 *
                 * @since 2.1.0
                 * @param string $product_name Name of the product in the cart.
                 * @param array $cart_item The product in the cart.
                 * @param string $cart_item_key Key for the product in the cart.
                 */
                $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);

                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                  $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
              ?>
                  <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

                    <td class="product-thumbnail">
                      <?php
                      $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                      if (!$product_permalink) {
                        echo $thumbnail; // PHPCS: XSS ok.
                      } else {
                        printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                      }
                      ?>
                    </td>

                    <td class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                      <?php
                      if (!$product_permalink) {
                        echo wp_kses_post($product_name . '&nbsp;');
                      } else {
                        /**
                         * This filter is documented above.
                         *
                         * @since 2.1.0
                         */
                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                      }

                      do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                      // Meta data.
                      //echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                      echo '<dl class="variation"> <span><dt class="variation-size">size:</dt> <dd class="variation-size"><p>36 EU – 5 US – 23 Cm – 9.05 In</p> </dd></span> </dl>';

                      // Backorder notification.
                      if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                        echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                      }
                      ?>
                    </td>

                    <td class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                      <?php
                      echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                      ?>
                    </td>

                    <td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
                      <?php
                      if ($_product->is_sold_individually()) {
                        $min_quantity = 1;
                        $max_quantity = 1;
                      } else {
                        $min_quantity = 0;
                        $max_quantity = $_product->get_max_purchase_quantity();
                      }

                      $product_quantity = woocommerce_quantity_input(
                        array(
                          'input_name'   => "cart[{$cart_item_key}][qty]",
                          'input_value'  => $cart_item['quantity'],
                          'max_value'    => $max_quantity,
                          'min_value'    => $min_quantity,
                          'product_name' => $product_name,
                        ),
                        $_product,
                        false
                      );

                      //echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                      ?>


                      <div class="product-remove">
                        <?php
                        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                          'woocommerce_cart_item_remove_link',
                          sprintf(
                            '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove</a>',
                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                            /* translators: %s is the product name */
                            esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
                            esc_attr($product_id),
                            esc_attr($_product->get_sku())
                          ),
                          $cart_item_key
                        );
                        ?>
                      </div>

                    </td>

                    <td class="product-subtotal" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
                      <?php
                      echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                      ?>
                    </td>
                  </tr>
              <?php
                }
              }
              ?>

              <?php do_action('woocommerce_cart_contents'); ?>

              <tr>
                <td colspan="6" class="actions">

                  <?php if (wc_coupons_enabled()) { ?>
                    <div class="coupon">
                      <label for="coupon_code" class="screen-reader-text"><?php esc_html_e('Coupon:', 'woocommerce'); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" /> <button type="submit" class="button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_html_e('Apply coupon', 'woocommerce'); ?></button>
                      <?php do_action('woocommerce_cart_coupon'); ?>
                    </div>
                  <?php } ?>

                  <button type="submit" class="button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>

                  <?php do_action('woocommerce_cart_actions'); ?>

                  <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                </td>
              </tr>

              <?php do_action('woocommerce_after_cart_contents'); ?>
            </tbody>
          </table>
          <?php do_action('woocommerce_after_cart_table'); ?>
        </form>
      </div>

      <div class="col-12 col-md-4">
        <?php do_action('woocommerce_before_cart_collaterals'); ?>
        <div class="cart-collaterals">
          <?php
          /**
           * Cart collaterals hook.
           *
           * @hooked woocommerce_cross_sell_display
           * @hooked woocommerce_cart_totals - 10
           */
          do_action('woocommerce_cart_collaterals');
          ?>
        </div>
      </div>
    </div>

    <?php do_action('woocommerce_after_cart'); ?>
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