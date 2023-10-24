<?php
/**
 * The template for displaying the footer.
 *
 * @package latoya
 */

/* Offcanvas */
get_template_part('template-parts/offcanvas/offcanvas', 'menu');
get_template_part('template-parts/offcanvas/offcanvas', 'wishlist-and-mini-cart');

do_action( 'latoya_theme_footer' );
wp_footer();
?>

</body>

</html>