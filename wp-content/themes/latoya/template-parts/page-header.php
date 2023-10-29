<?php

if (is_shop() || is_product_category() || is_product_tag()) {
  $pageId = wc_get_page_id('shop');
} else {
  $pageId = get_the_ID();
}

$pageThumbnailUrl = wp_get_attachment_image_src(get_post_thumbnail_id($pageId), 'full');

if ($pageThumbnailUrl) {
  $pageThumbnailUrl = $pageThumbnailUrl[0];
} else {
  $pageThumbnailUrl = LATOYA_THEME_URI . '/assets/images/breadcrumbs-woo-scaled.jpg';
}
?>

<div class="shop-header-page position-relative p-0 m-0 d-none">
  <div class="breadcrumbs-image position-absolute w-100 h-100 top-0 start-0">
    <img src="<?php echo $pageThumbnailUrl; ?>" alt="Breadcrumb Img" class="lazyloaded object-fit-cover w-100 h-100">
  </div>

  <div class="container p-0">
    <div class="breadscrumb-inner d-flex flex-wrap text-left flex-column justify-content-center position-absolute top-0 h-100 m-0 mw-100">
      <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
        <h1 class="woocommerce-products-header__title page-title">
          <?php
          if (is_shop() || is_product_category() || is_product_tag()) {
            woocommerce_page_title();
          } else {
            echo get_the_title();
          }
          ?>
        </h1>
      <?php endif; ?>
      <?php woocommerce_breadcrumb(array('delimiter' => '<i class="tb-icon tb-icon-arrow-next"></i>')); ?>
    </div>
  </div>
</div>