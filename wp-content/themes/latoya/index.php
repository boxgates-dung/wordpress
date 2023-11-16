<?php get_header(); ?>
<?php get_template_part('template-parts/page', 'header'); ?>


<?php

echo '?blog_archive_layout=main-right&blog_columns=2';
echo '<br />';

$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);

print_r($queries['blog_archive_layout']);



?>
<div class="container pt-5">
  <div class="row">

  

    <?php if (get_theme_mod('latoya_blog_layout', 'right-sidebar') == 'left-sidebar') { ?>
      <div class="col-12 col-md-3">
        <?php get_sidebar(); ?>
      </div>

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
    <?php } elseif (get_theme_mod('latoya_blog_layout', 'right-sidebar') == 'full-width') { ?>
      <div class="col-12 post-list">
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
    <?php } else { ?>
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

      <div class="col-12 col-md-3">
        <?php get_sidebar(); ?>
      </div>
    <?php } ?>

  </div>
</div>
<?php get_footer(); ?>