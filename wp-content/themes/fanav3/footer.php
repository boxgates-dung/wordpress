<footer class="footer">
  <?php
  $footer_static_id = get_static_template('theme_footer_part');
  if ($footer_static_id) {
    $ele = Elementor\Plugin::instance();
    echo $ele->frontend->get_builder_content_for_display($footer_static_id);
  }
  ?>
</footer>

<?php
/* Offcanvas */
get_template_part('template-parts/offcanvas/offcanvas', 'mini-cart');
get_template_part('template-parts/offcanvas/offcanvas', 'menu');

/*  Modals */
get_template_part('template-parts/modals/modal', 'quickview');
get_template_part('template-parts/modals/modal', 'login');
get_template_part('template-parts/modals/modal', 'register');
get_template_part('template-parts/modals/modal', 'aska-question');
get_template_part('template-parts/modals/modal', 'delivery-return');
get_template_part('template-parts/modals/modal', 'size-guide');

/*  Navs */
get_template_part('template-parts/mobile', 'footer-nav');
get_template_part('template-parts/mobile', 'quickbuy-nav');
?>

<?php wp_footer(); ?>
</body>

</html>