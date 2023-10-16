<?php
get_header();

if (class_exists('WooCommerce') && have_posts()) {
  the_post();

get_template_part('template-parts/page', 'header');
echo  do_shortcode('[yith_wcwl_wishlist]');
?>

<?php
}
get_footer();
