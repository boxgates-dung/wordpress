<article id="post-<?php the_ID(); ?>" <?php echo post_class(array('post-card')); ?>>
  <figure class="entry-thumb">
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
      <?php
      if (has_post_thumbnail() && get_the_post_thumbnail_url()) {
        the_post_thumbnail('post-thumbnail', ['class' => 'img-fluid']);
      } else {
        echo '<img src="' . esc_url(LATOYA_THEME_URI . '/assets/images/empty-image.png') . '" alt="Post Thumbnail" />';
      }
      ?>
    </a>
  </figure>

  <div class="entry-content">
    <div class="entry-header">
      <!-- Post Categories -->
      <?php if (has_category()) { ?>
        <div class="entry-category">
          <?php the_category(','); ?>
        </div>
      <?php } ?>

      <!-- Post Title -->
      <h3 class="entry-title">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title() ?></a>
      </h3>

      <!-- Post Meta -->
      <ul class="entry-meta-list">
        <li class="entry-author">
          <i class="tb-icon tb-icon-profile"></i>
          <span><?php esc_html_e('By', LATOYA_THEME_DOMAIN); ?> </span> <?php the_author_posts_link(); ?>
        </li>
        <li class="comments-link">
          <i class="tb-icon tb-icon-message"></i>
          <a href="<?php echo esc_url(get_the_permalink() . (get_comments_number() > 0 ? '#comments' : '#respond')); ?>"><?php echo get_comments_number(); ?>
            <span> <?php esc_html_e('Comment', LATOYA_THEME_DOMAIN); ?></span>
          </a>
        </li>
        <li class="entry-date">
          <i class="tb-icon tb-icon-clock"></i>
          <span class="screen-reader-text"><?php esc_html_e('Posted on', LATOYA_THEME_DOMAIN); ?></span>
          <a href="<?php the_permalink(); ?>" rel="bookmark"><span><?php echo get_post_time('M d, Y'); ?></span></a>
        </li>
      </ul>

      <!-- Post Short description -->
      <div class="entry-description">
        <?php the_excerpt(); ?>
      </div>

      <!-- Post Readmore -->
      <div class="more">
        <a href="<?php the_permalink(); ?>" class="readmore" title="<?php esc_html_e('Read more', LATOYA_THEME_DOMAIN); ?>">
          <?php esc_html_e('Read more', LATOYA_THEME_DOMAIN); ?>
        </a>
      </div>
    </div>
  </div>
</article>