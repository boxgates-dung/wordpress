<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
  return;
}

$colNumb = 12 / wc_get_loop_prop('columns');
?>
<div class="col-6 col-lg-<?php echo esc_attr($colNumb); ?> col-md-4">
  <div <?php wc_product_class('', $product); ?>>

    <div class="product-card v2 p-1 h-100 p-lg-0" data-product-id="13">
      <!-- Product card -->
      <div class="product-content position-relative">
        <div class="block-inner position-relative overflow-hidden">
          <!-- Images -->
          <figure class="image position-relative overflow-hidden m-0 p-0">
            <a title="<?php echo get_the_title(); ?>" href="<?php echo get_permalink(); ?>" class="product-image d-block text-center">
              <?php
              /**
               * Hook: woocommerce_before_shop_loop_item_title.
               *
               * @hooked woocommerce_show_product_loop_sale_flash - 10
               * @hooked woocommerce_template_loop_product_thumbnail - 10
               */
              do_action('woocommerce_before_shop_loop_item_title');
              ?>
            </a>
          </figure>
          <!-- End images -->

          <!-- Group button -->
          <div class="group-buttons">
            <div class="quick-view d-none d-lg-inline-block">
              <a href="#" data-toggle="modal" data-target="#quickviewModal" class="qview-button" title="Quick View" data-product_id="13">
                <i class="tb-icon tb-icon-search-normal"></i>
                <span>Quick View</span>
              </a>
            </div>

            <div class="button-wishlist shown-mobile" title="Wishlist">
              <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
            </div>

            <div class="yith-compare d-none d-lg-inline-block">
              <a href="/fana_bikini/?action=yith-woocompare-add-product&amp;id=13&amp;_wpnonce=006b0406a5" title="Compare" class="compare" data-product_id="13">
                <span>Add to compare</span>
              </a>
            </div>
          </div>
          <!-- End group button -->

          <!-- Group add to cart -->
          <div class="group-add-to-cart justify-content-center d-flex w-100">
            <?php
            /**
             * Hook: woocommerce_after_shop_loop_item.
             *
             * @hooked woocommerce_template_loop_product_link_close - 5
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            do_action('woocommerce_after_shop_loop_item');
            ?>
          </div>
          <!-- End group add to cart -->
        </div>
        <div class="caption">
          <a title="<?php echo get_the_title(); ?>" href="<?php echo get_permalink(); ?>" class="name d-block text-center">
            <?php
            /**
             * Hook: woocommerce_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action('woocommerce_shop_loop_item_title');
            ?>
          </a>

          <?php
          /**
           * Hook: woocommerce_after_shop_loop_item_title.
           *
           * @hooked woocommerce_template_loop_rating - 5
           * @hooked woocommerce_template_loop_price - 10
           */
          do_action('woocommerce_after_shop_loop_item_title');
          ?>

          <!-- Variation -->
          <?php
          if ($product->is_type('variable')) {
          ?>
            <div class="swatches-wrapper">

              <ul data-attribute_name="attribute_pa_color" class="active">
                <li class="swatch-item variable-item-color">
                  <div class="variable-item-contents">
                    <a href="javascript:void(0)" class="swatch-has-image variable-item-span-color" style="background-color:#000000" data-image-src="https://el4.thembaydev.com/fana_dokan/wp-content/uploads/2022/01/product-02-480x638.jpg" title="Black">Black</a>
                  </div>
                </li>
                <li class="swatch-item variable-item-color">
                  <div class="variable-item-contents">
                    <a href="javascript:void(0)" class="swatch-has-image variable-item-span-color selected" style="background-color:#c4743f" data-image-src="https://el4.thembaydev.com/fana_dokan/wp-content/uploads/2022/01/product-08-480x638.jpg" title="Brown">Brown</a>
                  </div>
                </li>
                <li class="swatch-item variable-item-color">
                  <div class="variable-item-contents">
                    <a href="javascript:void(0)" class="swatch-has-image variable-item-span-color" style="background-color:#fe4037" data-image-src="https://el4.thembaydev.com/fana_dokan/wp-content/uploads/2022/01/product-12-480x638.jpg" title="Pink">Pink</a>
                  </div>
                </li>
              </ul>

            </div>
          <?php
          };
          ?>
          <!-- End Variation -->
        </div>
      </div>
      <!-- End Product card -->
    </div>
  </div>
</div>