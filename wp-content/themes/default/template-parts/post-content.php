<article id="post-<?php the_ID(); ?>" class="post post-<?php the_ID(); ?>">
  <div class="entry-featureds mb-4">
    <?php the_post_thumbnail('post-thumbnail', ['class' => 'img-fluid']); ?>
  </div>

  <div class="entry-body">
    <ul class="entry-meta">
      <li class="item-author"> <i class="fa-regular fa-user"></i> <?php the_author_posts_link(); ?></li>
      <li class="item-category"> </i> <?php echo get_the_category_list(); ?></li>
    </ul>

    <div class="entry-content">
      <?php the_content(); ?>
    </div>

  </div>
</article>