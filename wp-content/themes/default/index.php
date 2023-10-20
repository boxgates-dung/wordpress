<?php get_header(); ?>
<?php get_template_part('template-parts/page', 'header'); ?>
<div class="container pt-5">
  <div class="row">
    <div class="col-12 col-md-8 mx-auto post-list">
      <?php
      if (have_posts()) {
        while (have_posts()) {
          the_post();
          get_template_part('template-parts/post', 'card');
        }
      };
      if (function_exists('_pagenavi_init')) wp_pagenavi('<div id="wp_pagenavi">', '</div>');
      ?>
    </div>
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>