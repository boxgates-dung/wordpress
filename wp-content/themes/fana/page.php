<?php get_header(); ?>

<?php
if (have_posts()) {
  the_post();

  get_template_part('template-part/page', 'header');
?>
  <div class="container pt-lg-4 pb-5">
    <?php the_content(); ?>
  </div>
<?php }
get_footer();
