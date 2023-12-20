<?php
function parent_menu_dropdown($item_output, $item, $depth, $args)
{
  if (!empty($item->classes) && in_array('menu-item-has-children', $item->classes)) {
    return '<a href="javascript:void(0);" class="accordion"></a>' . $item_output;
  }

  return $item_output;
}
add_filter('walker_nav_menu_start_el', 'parent_menu_dropdown', 10, 4);

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
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script> -->

  <!-- <link rel="stylesheet" href="//avon-demo.myshopify.com/cdn/shop/t/169/assets/theme.css?v=138044047921281506061697549192" type="text/css" media="all"> -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="<?php echo THEME_URL . "/assets/public/js/app.min.js"; ?>"></script>
</head>

<body class="single-product">

  <div class="container">
    <?php
    $args = array(
      'post_type'      => 'product',
      'posts_per_page' => 1,
      // 'product_cat'    => 'hoodies'
      'p' => 74309,
    );

    $loop = new WP_Query($args);

    while ($loop->have_posts()) {
      $loop->the_post();
      global $product;
    ?>

      <div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

        <div class="row product-inner">
          <div class="col-12 col-md-6">
            <?php
            /**
             * Hook: woocommerce_before_single_product_summary.
             *
             * @hooked woocommerce_show_product_sale_flash - 10
             * @hooked woocommerce_show_product_images - 20
             */
            // do_action('woocommerce_before_single_product_summary');

            // woocommerce_show_product_images();

            $columns           = apply_filters('woocommerce_product_thumbnails_columns', 4);
            $post_thumbnail_id = $product->get_image_id();
            $wrapper_classes   = apply_filters(
              'woocommerce_single_product_image_gallery_classes',
              array(
                'woocommerce-product-gallery',
                'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
                'woocommerce-product-gallery--columns-' . absint($columns),
                'images',
              )
            );

            $attachment_ids = $product->get_gallery_image_ids();
            array_unshift($attachment_ids, get_post_thumbnail_id($product->get_id()));

            ?>



            <div class="product-gallery <?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>">
              <?php if (!empty($attachment_ids) && count($attachment_ids) > 2) { ?>
                <?php //do_action('woocommerce_product_thumbnails'); 
                ?>
                <div class="product-main-image-wrap">
                  <div class="swiper-wrapper">
                    <?php
                    foreach ($attachment_ids as $index => $attachment_id) {
                      printf(
                        '<div class="swiper-slide" data-key="%s"><a href="%s" data-fancybox="images"><img src="%s" alt="%s"></a></div>',
                        esc_attr($index),
                        esc_url(wp_get_attachment_image_url($attachment_id, 'full')),
                        esc_url(wp_get_attachment_image_url($attachment_id, 'full')),
                        esc_attr($product->get_name())
                      );
                    }
                    ?>
                  </div>
                  <?php if (count($attachment_ids) > 1) { ?>
                    <div class="button-next"></div>
                    <div class="button-prev"></div>
                  <?php } ?>
                  <div class="swiper-pagination"></div>

                  <!-- Add to wishlist -->


                  <?php //get_template_part('template-parts/sale', 'flash', ['product' => $product]); 
                  ?>
                </div>
              <?php } else { ?>
                <a class="empty-colections" href="<?php echo get_the_post_thumbnail_url($product->get_id(), 'full') ?>" data-fancybox="images">
                  <img src="<?php echo get_the_post_thumbnail_url($product->get_id(), 'full') ?>" alt="<?php esc_attr_e($product->get_name()) ?>" class="img-fluid">
                </a>
              <?php } ?>
            </div>












          </div>
          <div class="col-12 col-md-6">
            <div class="summary entry-summary">
              <?php woocommerce_template_single_title(); ?>
              <!-- Product brand -->
              <?php
              $brands = get_the_terms($product->get_ID(), 'product_brand');
              if (!is_wp_error($brands) && !empty($brands)) {
                echo '<div class="product-brands">';
                foreach ($brands as $brand) {
                  $brandThumbnail = wp_get_attachment_image(get_term_meta($brand->term_id, 'product_brand_thumbnail', true), 'full');
                  printf(
                    '<a class="brand-item" title="%s" href="%s" rel="tag">%s</a>',
                    $brand->name,
                    get_term_link($brand->term_id, 'product_brand'),
                    $brandThumbnail ? $brandThumbnail : '<span>' . $brand->name . '</span>',
                  );
                }
                echo '</div>';
              }
              ?>
              <!-- End product brand -->
              <?php
              woocommerce_template_single_rating();
              echo '<div class="product-sku">SKU: <span class="variant-sku">' . $product->get_sku() . '</span></div>';
              woocommerce_template_single_price();
              ?>

              <label style="color:#000000;" class="mb-2">Hurry up! Sales End In</label>
              <div id="countdown" class="countdown" data-date="2024-07-01T21:00:00Z">
                <span><span class="tm days">194</span>Days</span>
                <span><span class="tm hours">10</span>Hrs</span>
                <span><span class="tm minutes">31</span>Min</span>
                <span><span class="tm seconds">59</span>Sec</span>
              </div>

              <?php
              woocommerce_template_single_excerpt();
              ?>

              <!-- Bulk saving -->


              <!-- Product count downt -->
              <!-- <div class="detail-product-deal-countdown">
                <div class="countdown-label">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20" height="20" viewBox="0 0 32 32" fill="currentColor">
                    <path d="M15.992 5.872c-6.479 0-11.729 5.251-11.729 11.729 0 2.939 1.084 5.625 2.872 7.683l-2.744 3.363 0.826 0.674 2.659-3.258c2.107 2.021 4.965 3.265 8.116 3.265 3.158 0 6.023-1.251 8.132-3.281l2.657 3.278 0.829-0.672-2.746-3.387c1.778-2.056 2.857-4.735 2.857-7.666 0-6.478-5.252-11.729-11.729-11.729zM15.992 28.262c-5.88 0-10.662-4.782-10.662-10.661 0-5.88 4.783-10.662 10.662-10.662s10.663 4.783 10.663 10.662c0 5.879-4.783 10.661-10.662 10.661z"></path>
                    <path d="M11.171 2.672h-3.168c-2.945 0-5.331 2.387-5.331 5.331v3.208h1.516l6.983-7.022v-1.517zM10.104 3.75l-6.366 6.395v-2.142c0-2.351 1.913-4.265 4.265-4.265h2.101v0.011z"></path>
                    <path d="M23.997 2.672h-3.17v1.517l6.984 7.022h1.517v-3.208c-0-2.945-2.388-5.331-5.331-5.331zM28.262 10.145h-0.007l-6.361-6.395v-0.011h2.103c2.352 0 4.265 1.914 4.265 4.265v2.142z"></path>
                    <path d="M15.467 17.599h-5.878v1.066h6.944v-9.596h-1.066z"></path>
                  </svg>
                  &nbsp;&nbsp;Hurry up! Sale end in:
                </div>

                <div class="product-deal-countdown">
                  <span class="countdown is-countdown countdown-rtl countdown-loaded" data-countdown="Dec 31 2024 06:00:00 +0700">
                    <span class="countdown-row countdown-show4">
                      <span class="countdown-section days"><span class="countdown-amount">398</span><span class="countdown-period">Days</span></span>
                      <span class="countdown-section hours"><span class="countdown-amount">15</span><span class="countdown-period">Hours</span></span>
                      <span class="countdown-section minus"><span class="countdown-amount">21</span><span class="countdown-period">Mins</span></span>
                      <span class="countdown-section secount"><span class="countdown-amount">39</span><span class="countdown-period">Secs</span></span>
                    </span>
                  </span>
                </div>
              </div> -->

              <?php
              woocommerce_template_single_add_to_cart();
              woocommerce_template_single_sharing();
              ?>

              <div class="utils">
                <div class="infolinks">
                  <a class="inLink wishlist addto-wishlist m-0" href="/pages/wishlist" rel="innerbloom-puffer-jacket"><i class="at at-heart-l me-0"></i><span class="msg">Add to Wishlist</span></a>
                  <a href="#ShippingInfo" data-effect="mfp-zoom-in" class="inLink mfp m-0"><i class="at at-paper-l-plane"></i> Delivery &amp; Returns</a>
                  <a href="#productInquiry" data-effect="mfp-zoom-in" class="mfp inLink"><i class="at at-envelope-l"></i> Enquiry</a>
                </div>

                <div class="free_ship_msg">
                  <i class="at at-truck-l"></i> Spent <b>$199.00</b>
                  more for free shipping
                </div>

                <p class="shipping_msg">
                  <i class="at at-clock-r"></i>
                  Estimated delivery between
                  <b><time datetime="2023-12-26T05:18:47Z">Monday 25 December</time></b>
                  -
                  <b><time datetime="2023-12-31T05:18:47Z">Saturday 30 December</time></b>.
                </p>

                <div class="trust-badge">
                  <span class="trust-badge-title">Guaranteed safe checkout:</span>
                  <img class="img" src="//avon-demo.myshopify.com/cdn/shop/files/checkout.png" width="551" height="75" alt="">
                </div>
              </div>

            </div>
          </div>
        </div>

        <?php
        /**
         * Hook: woocommerce_after_single_product_summary.
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        // do_action('woocommerce_after_single_product_summary');

        // woocommerce_output_product_data_tabs();

        $product_tabs = apply_filters('woocommerce_product_tabs', array());

        if (!empty($product_tabs)) : ?>

          <div class="woocommerce-tabs wc-tabs-wrapper">
            <!-- header tab -->
            <ul class="tabs wc-tabs d-none d-md-flex" role="tablist">
              <?php foreach ($product_tabs as $key => $product_tab) : ?>
                <li class="<?php echo esc_attr($key); ?>_tab" id="tab-title-<?php echo esc_attr($key); ?>" role="tab" aria-controls="tab-<?php echo esc_attr($key); ?>">
                  <a href="#tab-<?php echo esc_attr($key); ?>">
                    <?php echo wp_kses_post(apply_filters('woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key)); ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
            <!-- End header tab -->

            <?php foreach ($product_tabs as $key => $product_tab) : ?>
              <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr($key); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr($key); ?>">
                <?php
                if (isset($product_tab['callback'])) {
                  call_user_func($product_tab['callback'], $key, $product_tab);
                }
                ?>
              </div>
            <?php endforeach; ?>

            <?php do_action('woocommerce_product_after_tabs'); ?>
          </div>

        <?php endif;

        woocommerce_template_single_meta();
        woocommerce_upsell_display();
        woocommerce_output_related_products();
        ?>
      </div>

    <?php
    };

    wp_reset_query();
    ?>
  </div>


  <!-- Offcanvas  menu-->
  <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">
    Button with data-bs-target
  </button>

  <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
    <div class="offcanvas-body">
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>

      <div class="mm-sidebar-head d-flex align-items-center">
        <div class="wishlist-link w-50">
          <a href="#">
            <i class="at at-user-expand"></i>

            Wishlist
          </a>
        </div>
        <div class="account-link w-50">
          <a href="#">
            <i class="at at-user-expand"></i>

            Account
          </a>
        </div>
      </div>

      <div class="mm-nav">
        <?php wp_nav_menu([
          'menu_id'         => 'mm-sidebar',
          'menu_class'      => 'mm-sidebar',
          'theme_location'  => 'primary',
          'container'       => '',
        ]); ?>
      </div>
    </div>
  </div>
  <!-- End offcanvas -->


  <!-- Offcanvas bottom -->
  <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Toggle bottom offcanvas</button>

  <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasBottomLabel">Offcanvas bottom</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small">
      ...
    </div>
  </div>
  <!-- End offcanvas bottom -->

  <script>
    jQuery(document).ready(function() {

      $('.mm-sidebar a.accordion').click(function() {
        const _parent = $(this).parent()

        if (_parent.hasClass('active') || _parent.hasClass('current-menu-item') || _parent.hasClass('current-menu-ancestor') || _parent.hasClass('current-menu-parent')) {
          _parent.removeClass('current-menu-item')
          _parent.removeClass('current-menu-ancestor')
          _parent.removeClass('current-menu-parent')
          _parent.removeClass('active')
        } else {
          _parent.addClass('active')
        }
      })


      const swiper = new Swiper('.product-main-image-wrap', {
        // Optional parameters
        // direction: 'vertical',
        loop: true,

        // If we need pagination
        // pagination: {
        //   el: '.swiper-pagination',
        // },

        // Navigation arrows
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },

        // And if we need scrollbar
        // scrollbar: {
        //   el: '.swiper-scrollbar',
        // },
      })

    })
  </script>
</body>

</html>