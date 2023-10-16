<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

use Nextend\SmartSlider3\Platform\WordPress\Shortcode\Shortcode;

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');

get_template_part('template-parts/page', 'header');
?>

<div class="woocommerce-products-header">
  <?php
  /**
   * Hook: woocommerce_archive_description.
   *
   * @hooked woocommerce_taxonomy_archive_description - 10
   * @hooked woocommerce_product_archive_description - 10
   */
  do_action('woocommerce_archive_description');
  ?>
</div>

<div class="container">

  <!-- shopbanner -->
  <div class="mt-4 d-none d-lg-block">
    <div class="main-wrapp-img">
      <div class="banner-image">
        <img width="1400" height="150" src="https://el4.thembaydev.com/fana_bikini/wp-content/uploads/2022/09/banner-07.jpg" class="w-100 h-auto">
      </div>
    </div>
    <div class="wrapper-content-banner d-none">
      <div class="content-banner">
        <h3 class="banner-tbay-title">
          <span class="title">Green Oceans</span>
          <span class="subtitle">Up to -50%</span>
        </h3>
      </div>
    </div>
  </div>
  <!-- End shop banner -->

  <?php echo do_shortcode('[yith_wcan_filters slug="default-preset"]');?>

  <?php
  if (woocommerce_product_loop()) {
  ?>
    <div class="top-filter">
      <div class="filter-btn-wrapper d-lg-none">
        <a id="button-filter-btn" class="button-filter-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasShopSidebar">
          <i class="tb-icon tb-icon-filter" aria-hidden="true"></i>
          Filter
        </a>
      </div>

      <?php
      /**
       * Hook: woocommerce_before_shop_loop.
       *
       * @hooked woocommerce_output_all_notices - 10
       * @hooked woocommerce_result_count - 20
       * @hooked woocommerce_catalog_ordering - 30
       */

      do_action('woocommerce_before_shop_loop');
      ?>
    </div>
    <div class="row">
      <div class="col-12 col-lg-3">
        <div class="sidebar-shop d-lg-block">
          <!-- offcanvas -->
          <div class="offcanvas offcanvas-start d-lg-block" tabindex="-1" id="offcanvasShopSidebar" aria-labelledby="offcanvasShopSidebarLabel">
            <div class="offcanvas-header d-lg-none">
              <a href="javascript:;" class="offcanvas-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="tb-icon tb-icon-cross"></i></a>
            </div>
            <div class="offcanvas-body p-lg-0">
              <?php do_action('woocommerce_sidebar'); ?>
            </div>
          </div>
          <!-- End offcanvas -->
        </div>
      </div>
      <div class="col-12 col-lg-9">
        <?php
        woocommerce_product_loop_start();

        if (wc_get_loop_prop('total')) {
          while (have_posts()) {
            the_post();

            /**
             * Hook: woocommerce_shop_loop.
             */
            do_action('woocommerce_shop_loop');

            wc_get_template_part('content', 'product');
          }
        }

        woocommerce_product_loop_end();

        /**
         * Hook: woocommerce_after_shop_loop.
         *
         * @hooked woocommerce_pagination - 10
         */
        do_action('woocommerce_after_shop_loop');

        ?>
      </div>

    </div>

  <?php
  } else {
    /**
     * Hook: woocommerce_no_products_found.
     *
     * @hooked wc_no_products_found - 10
     */
    do_action('woocommerce_no_products_found');
  }
  ?>
</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
// do_action('woocommerce_sidebar');

get_footer('shop');
