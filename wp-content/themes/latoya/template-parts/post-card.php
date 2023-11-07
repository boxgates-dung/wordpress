<?php
$thumbnail = get_the_post_thumbnail_url();
if (!$thumbnail) $thumbnail = LATOYA_THEME_URI . '/assets/images/empty-image.png';
?>

<article id="post-<?php the_ID(); ?>" class="post single-hentry post-<?php the_ID(); ?> d-none">
  <div class="entry-featured image-effect-white">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" style="background-image: url(<?php echo $thumbnail; ?>);">
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
          <?php esc_html_e('Read more', LATOYA_THEME_DOMAIN); ?>
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
          <a class="lin-social" title="LinkedIn" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>">
            <i class="fa-brands fa-instagram"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</article>

<article id="post-384" class="post-card post-384 post type-post status-publish format-standard has-post-thumbnail hentry category-backpack category-shorts tag-accessories tag-earrings tag-men">
  <figure class="entry-thumb">
    <a class="post-full" href="https://el4.thembaydev.com/fana/2022/12/04/how-to-choose-the-right-customer-for-your-photo/" aria-hidden="true">
      <img width="1536" height="1024" src="https://el4.thembaydev.com/fana/wp-content/uploads/2022/01/blog-07.jpg" class="attachment-full size-full wp-post-image lazyloaded" alt="How to choose the right customer for your photo?" decoding="async" fetchpriority="high" data-ll-status="loaded">
    </a>
  </figure>
  <div class="entry-content  ">
    <div class="entry-header">
      <div class="entry-category"><a href="https://el4.thembaydev.com/fana/category/backpack/" title="View all posts in Backpack">Backpack</a>,<a href="https://el4.thembaydev.com/fana/category/shorts/" title="View all posts in Shorts">Shorts</a></div>
      <h3 class="entry-title">
        <a href="https://el4.thembaydev.com/fana/2022/12/04/how-to-choose-the-right-customer-for-your-photo/">How to choose the right customer for your photo?</a>
      </h3>
      <ul class="entry-meta-list">
        <li class="entry-author">
          <i class="tb-icon tb-icon-profile"></i>
          <span>By </span> <a href="https://el4.thembaydev.com/fana/author/admin/" title="Posts by admin" rel="author">admin</a>
        </li>
        <li class="comments-link">
          <i class="tb-icon tb-icon-message"></i>
          <a href="https://el4.thembaydev.com/fana/2022/12/04/how-to-choose-the-right-customer-for-your-photo/#comments">1<span> Comment</span></a>
        </li>
        <li class="entry-date"><i class="tb-icon tb-icon-clock"></i><span class="screen-reader-text">Posted on</span> <a href="https://el4.thembaydev.com/fana/2022/12/04/how-to-choose-the-right-customer-for-your-photo/" rel="bookmark"><time class="entry-date published updated" datetime="2022-12-04T01:56:17+00:00">December 4, 2022</time></a></li>
      </ul>
      <div class="entry-description">
        The About Love film by acclaimed director Emmanuel Adjei features a soulful musical performance of the nunc interdum lacus sit ame... </div>
      <div class="more">
        <a href="https://el4.thembaydev.com/fana/2022/12/04/how-to-choose-the-right-customer-for-your-photo/" class="readmore" title="Read more">Read more</a>
      </div>
    </div>
  </div>
</article>