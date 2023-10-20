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
// get_template_part('template-parts/offcanvas/offcanvas', 'mini-cart');
?>
<a href="#" class="btn-scroll-top"><i class="fa-solid fa-chevron-up"></i></a>
<?php wp_footer(); ?>
</body>

</html>