<?php

/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart'); ?>

<?php if (!WC()->cart->is_empty()) : ?>

  <ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?> d-block h-100 m-0">
    <?php
    do_action('woocommerce_before_mini_cart_contents');

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
      $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
      $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

      if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
        /**
         * This filter is documented in woocommerce/templates/cart/cart.php.
         *
         * @since 2.1.0
         */
        $product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
        $thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
        $product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
    ?>
        <li class="woocommerce-mini-cart-item <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">
          <div class="d-flex flex-nowrap position-relative text-left w-100 m-0">
            <!-- Product images -->
            <div class="product-image position-relative">
              <?php if (empty($product_permalink)) : ?>
                <?php echo $thumbnail; ?>
              <?php else : ?>
                <a href="<?php echo esc_url($product_permalink); ?>">
                  <?php echo $thumbnail; ?>
                </a>
              <?php endif; ?>
            </div>

            <!-- Product details -->
            <div class="product-details position-relative overflow-hidden flex-fill">
              <a class="product-name" href="<?php echo esc_url($product_permalink); ?>">
                <span><?php echo wp_kses_post($product_name); ?></span>
              </a>

              <!-- Group input -->
              <div class="group-quantity mt-2">
                <?php echo woocommerce_quantity_input(
                  array(
                    'input_name'  => "cart[{$cart_item_key}][qty]",
                    'input_value' => $cart_item['quantity'],
                    'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                    'min_value'   => '0',
                    'id'          => $product_id,
                  ),
                  $_product,
                  false
                ); ?>

                <?php echo $product_price; ?>
              </div>

              <?php echo wc_get_formatted_cart_item_data($cart_item); ?>

              <!-- Remove -->
              <?php
              echo apply_filters(
                'woocommerce_cart_item_remove_link',
                sprintf(
                  '<a href="%s" class="remove remove_from_cart_button position-absolute bg-transparent top-50 end-0" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">
                  <i class="tb-icon tb-icon-trash"></i>
                </a>',
                  esc_url(wc_get_cart_remove_url($cart_item_key)),
                  /* translators: %s is the product name */
                  esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
                  esc_attr($product_id),
                  esc_attr($cart_item_key),
                  esc_attr($_product->get_sku())
                ),
                $cart_item_key
              );
              ?>
            </div>
          </div>
        </li>
    <?php
      }
    }

    do_action('woocommerce_mini_cart_contents');
    ?>
  </ul>

  <p class="woocommerce-mini-cart__total total d-flex align-items-center justify-content-between pt-3">
    <?php
    /**
     * Hook: woocommerce_widget_shopping_cart_total.
     *
     * @hooked woocommerce_widget_shopping_cart_subtotal - 10
     */
    do_action('woocommerce_widget_shopping_cart_total');
    ?>
  </p>

  <!-- Conditional total free -->
  <?php echo get_template_part('template-parts/bulk', 'saving'); ?>
  <!-- End conditional total free -->

  <?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

  <p class="woocommerce-mini-cart__buttons buttons"><?php do_action('woocommerce_widget_shopping_cart_buttons'); ?></p>

  <?php do_action('woocommerce_widget_shopping_cart_after_buttons'); ?>

<?php else : ?>

  <!-- Render empty cart -->
  <div class="mini_cart_content">
    <div class="mini_cart_inner">

      <div class="row">
        <div class="col-12 col-lg-4 text-center">
          <img src="<?php echo THEME_URI . '/assets/images/image-empty-cart.jpg'; ?>" alt="Empty cart">
        </div>
        <div class="col-12 col-lg-8 d-flex align-items-center justify-content-center justify-content-lg-start">
          <div class="inner-empty text-center text-lg-left">
            <div class="empty-heading"><?php echo __('Your cart is empty', THEME_DOMAIN); ?></div>
            <a class="wc-continue" href="<?php echo wc_get_page_permalink('shop'); ?>">
              <?php echo __('Continue Shopping', THEME_DOMAIN); ?>
              <i class="tb-icon tb-icon-angle-right"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="clearfix"></div>

    </div>
  </div>
  <!-- End empty cart -->

<?php endif; ?>

<?php do_action('woocommerce_after_mini_cart'); ?>