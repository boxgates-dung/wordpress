<?php 
$footer_static_id = get_static_template('theme_footer_part');
if ($footer_static_id) {
  $ele = Elementor\Plugin::instance();
  echo '<footer class="footer">' . $ele->frontend->get_builder_content_for_display($footer_static_id) . '</footer>';
} 

get_template_part('template-parts/offcanvas');

wp_footer();
?>
<a href="#" class="btn-scroll-top d-none"><i class="fa-solid fa-chevron-up"></i></a>
</body>

</html>