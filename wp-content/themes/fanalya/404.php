<?php get_header(); ?>
<div class="container mx-auto my-8">
  <div class="max-w-3xl mx-auto text-center py-12">

    <img src="<?php echo THEME_URI . '/assets/images/404.png' ?>" alt="" class="w-96 h-auto mx-auto mb-14" />

    <p class="return-to-shop">
      <a class="button wc-backward<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>">
        <?php echo esc_html(apply_filters('woocommerce_return_to_shop_text', __('Return to shop', 'woocommerce'))); ?>
      </a>
    </p>

  </div>
</div>
<?php
get_footer();
