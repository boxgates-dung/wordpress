<?php if (post_password_required())  return; ?>

<div id="comments" class="comments-area">

  <?php if (have_comments()) : ?>
    <h2 class="comments-title"> <?php esc_html_e('Comments (' . get_comments_number() . ')'); ?> </h2>

    <ul class="comment-list">
      <?php
      wp_list_comments(array(
        'style'       => 'li',
        'short_ping'  => true,
        'avatar_size' => 74,
      ));
      ?>
    </ul>
    <!-- .comment-list -->

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
      <nav class="navigation comment-navigation" role="navigation">

        <h1 class="screen-reader-text section-heading"><?php _e('Comment navigation', 'twentythirteen'); ?></h1>
        <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'twentythirteen')); ?></div>
        <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'twentythirteen')); ?></div>
      </nav><!-- .comment-navigation -->
    <?php endif; // Check for comment navigation 
    ?>

    <?php if (!comments_open() && get_comments_number()) : ?>
      <p class="no-comments"><?php _e('Comments are closed.', 'twentythirteen'); ?></p>
    <?php endif; ?>

  <?php endif; ?>

  <?php
  // comment_form($comments_args);


  add_filter('comment_form_default_fields', function ($fields) {
    $commenter = wp_get_current_commenter();
    $required = get_option('require_name_email');

    $fields['author']   = sprintf(
      '<div class="row"> <div class="col-lg-4 col-md-4 col-sm-12"><input placeholder="%1$s%3$s" id="author" name="author" type="text" value="%2$s" size="30" /></div>',
      esc_html__('Name', THEME_DOMAIN),
      esc_attr($commenter['comment_author']),
      $required ? ' *' : ''
    );

    $fields['email']    = sprintf(
      '<div class="col-lg-4 col-md-4 col-sm-12"><input placeholder="%1$s%3$s" id="email" name="email" type="email" value="%2$s" size="30" /></div>',
      esc_html__('Email', THEME_DOMAIN),
      esc_attr($commenter['comment_author_email']),
      $required ? ' *' : ''
    );

    $fields['url']      = sprintf(
      '<div class="col-lg-4 col-md-4 col-sm-12"><input placeholder="%1$s" id="url" name="url" type="url" value="%2$s" size="30" /></div> 
      </div>
      ',
      esc_html__('Website', THEME_DOMAIN),
      esc_attr($commenter['comment_author_url'])
    );

    $consent            = empty($commenter['comment_author_email']) ? '' : ' checked="checked"';
    $fields['cookies']  = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent">
    Save my name, email, and website in this browser for the next time I comment.
    </label></p>';

    return $fields;
  }, 15, 1);

  $comments_args = array(
    // Change the title of send button 
    // 'label_submit' => __('Send', 'textdomain'),
    // // Change the title of the reply section
    // 'title_reply' => __('Write a Reply or Comment', 'textdomain'),
    // // Remove "Text or HTML to be displayed after the set of comment fields".
    // 'comment_notes_after' => '',
    // Redefine your own textarea (the comment body).
    'comment_field' => '<p class="comment-form-comment"><br /><textarea id="comment" name="comment" placeholder="Comment*" aria-required="true"></textarea></p>',
  );


  comment_form($comments_args);
  ?>






</div><!-- #comments -->