<?php get_header(); ?>
<?php get_template_part('template-parts/page', 'header'); ?>
<div class="container pt-5">
  <div class="row">

    <?php if (get_theme_mod('latoya_blog_layout', 'right-sidebar') == 'left-sidebar') { ?>
      leffff
    <?php } elseif (get_theme_mod('latoya_blog_layout', 'right-sidebar') == 'full-width') { ?>
      fullll
    <?php } else { ?>
      rightttt
    <?php } ?>

    <div class="col-12 col-md-9 post-list">



      <?php
      if (have_posts()) {
        echo '<div class="row">';
        while (have_posts()) {
          the_post();

          echo '<div class="col-12 col-md-12">';
          get_template_part('template-parts/post/content');
          echo '</div>';
        }
        echo '</div>';
      };

      posts_pagination();
      ?>
    </div>
    <?php get_sidebar(); ?>
  </div>
</div>
<?php get_footer(); ?>