<?php get_header(); ?>

<?php
if (have_posts()) {
  the_post();

  get_template_part('template-parts/page', 'header');
?>
  <div class="containerd">
    <?php the_content(); ?>
  </div>
<?php }
get_footer();
