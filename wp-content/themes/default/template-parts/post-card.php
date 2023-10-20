<article id="post-<?php the_ID(); ?>" class="post single-hentry post-<?php the_ID(); ?>">
  <div class="entry-featured image-effect-white">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" style="background-image: url(<?php the_post_thumbnail_url(null, 'full'); ?>);">
      <?php the_post_thumbnail('post-thumbnail', ['class' => 'img-fluid']); ?>
    </a>
    <div class="entry-date"> <span><?php echo get_post_time('d'); ?></span> <span><?php echo get_post_time('M, y'); ?></span></div>
  </div>

  <div class="entry-body">
    <ul class="entry-meta">
      <li class="item-author"><i class="fa-regular fa-user"></i> <?php the_author_posts_link(); ?></li>
      <li class="item-category"><i class="fa-regular fa-folder"></i><?php echo get_the_category_list(', '); ?></li>
    </ul>
    <h2 class="entry-title">
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <?php the_title() ?>
      </a>
    </h2>
    <div class="entry-excerpt">
      <?php the_excerpt(); ?>
    </div>
    <div class="entry-holder">
      <div class="entry-readmore">
        <a class="btn btn-plus icon-right" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
          <?php echo _e('Read more', THEME_DOMAIN); ?>
          <span class="icon-abs"><i class="fa-solid fa-plus"></i></span>
        </a>
      </div>
      <div class="entry-social-share"> <i class="fa-solid fa-share-nodes"></i>
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
          <a class="lin-social" title="LinkedIn" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title() ;?>">
            <i class="fa-brands fa-instagram"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</article>