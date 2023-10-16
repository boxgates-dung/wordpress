<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

$productPrev = wc_get_product(get_previous_post()->ID);
$productNext = wc_get_product(get_next_post()->ID);
?>

<div class="single-header-page">
  <div class="container">
    <div class="d-flex align-items-center">
      <div class="breadscrumb-inner">
        <?php
        woocommerce_breadcrumb(array(
          'delimiter' => '<i class="tb-icon tb-icon-arrow-next"></i>',
        ));
        ?>
      </div>

      <div class="product-nav-icon position-relative text-end">
        <div class="link-icons position-relative">
          <?php if ($productPrev) { ?>
            <div class="left-icon icon-wrapper d-inline-block">
              <div class="text">
                <a class="img-link left" href="<?php echo $productPrev->get_permalink(); ?>"><span class="product-btn-icon"></span>Previous</a>
              </div>
              <div class="product-nav-card text-start">
                <a class="img-link" href="<?php echo $productPrev->get_permalink(); ?>">
                  <?php echo $productPrev->get_image('thumbnail') ?>
                </a>
                <div class="product_single_nav_inner single_nav">
                  <a href="<?php echo $productPrev->get_permalink(); ?>">
                    <span class="name-pr"><?php echo $productPrev->get_title(); ?></span>
                    <span class="price"> <?php echo $productPrev->get_price_html(); ?> </span>
                  </a>
                </div>
              </div>
            </div>
          <?php } ?>

          <?php if ($productNext) { ?>
            <div class="right-icon icon-wrapper d-inline-block">
              <div class="text">
                <a class="img-link right" href="<?php echo $productNext->get_permalink(); ?>">Next<span class="product-btn-icon"></span></a>
              </div>
              <div class="product-nav-card text-end">
                <div class="product_single_nav_inner single_nav">
                  <a href="<?php echo $productNext->get_permalink(); ?>">
                    <span class="name-pr"><?php echo $productNext->get_title(); ?></span>
                    <span class="price"> <?php echo $productNext->get_price_html(); ?> </span>
                  </a>
                </div>
                <a class="img-link" href="<?php echo $productNext->get_permalink(); ?>">
                  <?php echo $productNext->get_image('thumbnail') ?>
                </a>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <?php
  /**
   * Hook: woocommerce_before_single_product.
   *
   * @hooked woocommerce_output_all_notices - 10
   */
  do_action('woocommerce_before_single_product');

  if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
  }
  ?>

  <div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

    <?php
    /**
     * Hook: woocommerce_before_single_product_summary.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    do_action('woocommerce_before_single_product_summary');
    ?>

    <div class="summary entry-summary">
      <?php
      /**
       * Hook: woocommerce_single_product_summary.
       *
       * @hooked woocommerce_template_single_title - 5
       * @hooked woocommerce_template_single_rating - 10
       * @hooked woocommerce_template_single_price - 10
       * @hooked woocommerce_template_single_excerpt - 20
       * @hooked woocommerce_template_single_add_to_cart - 30
       * @hooked woocommerce_template_single_meta - 40
       * @hooked woocommerce_template_single_sharing - 50
       * @hooked WC_Structured_Data::generate_product_data() - 60
       */
      do_action('woocommerce_single_product_summary');
      ?>
    </div>

    <?php
    /**
     * Hook: woocommerce_after_single_product_summary.
     *
     * @hooked woocommerce_output_product_data_tabs - 10
     * @hooked woocommerce_upsell_display - 15
     * @hooked woocommerce_output_related_products - 20
     */
    do_action('woocommerce_after_single_product_summary');
    ?>
  </div>

  <?php do_action('woocommerce_after_single_product'); ?>
</div>