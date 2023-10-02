<?php get_header(); ?>
<?php get_template_part('template-parts/page', 'header'); ?>

<div class="container m-auto pt-12 pb-20">
  <?php
  if (have_posts()) {
    the_post();
    the_content();
  }
  ?>
</div>

<?php get_footer();
