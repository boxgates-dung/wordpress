<article id="post-<?php the_ID(); ?>" class="post post-<?php the_ID(); ?>">
  <div class="entry-featured mb-4">
    <?php the_post_thumbnail('post-thumbnail', ['class' => 'img-fluid']); ?>
  </div>

  <div class="entry-body">
    <ul class="entry-meta">
      <li class="item-date"><i class="fa-regular fa-calendar"></i><?php echo get_post_time('M d, Y'); ?></li>
      <li class="item-author"><i class="fa-regular fa-user"></i><?php the_author_posts_link(); ?></li>
      <li class="item-category"><i class="fa-regular fa-folder"></i><?php echo get_the_category_list(', '); ?></li>
    </ul>

    <div class="entry-content">
      <?php the_content(); ?>
    </div>
  </div>

  <div class="entry-footer">
    <div class="entry-tags">
      <?php the_tags('<label class="label">Tags:</label>', ''); ?>
    </div>
    <div class="entry-social">
      <a class="fb-social" title="Facebook" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
        <i class="fa-brands fa-facebook-f"></i>
      </a>
      <a class="tw-social" title="Twitter" target="_blank" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&amp;text=<?php the_title() ?>">
        <i class="fa-brands fa-twitter"></i>
      </a>
      <a class="pin-social" title="Pinterest" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php the_post_thumbnail_url(null, 'full'); ?>&amp;description=<?php the_title() ?>">
        <i class="fa-brands fa-linkedin-in"></i>
      </a>
      <a class="lin-social" title="LinkedIn" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>">
        <i class="fa-brands fa-instagram"></i>
      </a>
    </div>
  </div>

  <div class="post-previous-next">
    <?php if (!empty(get_adjacent_post(false, '', true))) { ?>
      <div class="post-previous">
        <a href="<?php echo esc_url(get_permalink(get_adjacent_post(false, '', true)->ID)); ?>">
          <span> <i class="fa-solid fa-angles-left"></i> <?php esc_html_e('Previous Post', THEME_DOMAIN); ?> </span>
        </a>
      </div>
    <?php } ?>
    <?php if (!empty(get_adjacent_post(false, '', false))) { ?>
      <div class="post-next">
        <a href="<?php echo esc_url(get_permalink(get_adjacent_post(false, '', false)->ID)); ?>">
          <span><?php esc_html_e('Newer Post', THEME_DOMAIN); ?> <i class="fa-solid fa-angles-right"></i></span>
        </a>
      </div>
    <?php } ?>
  </div>
</article>