<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?php echo THEME_URL . "/assets/public/css/vendors.css"; ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <!-- <link rel="stylesheet" href="//avon-demo.myshopify.com/cdn/shop/t/169/assets/theme.css?v=138044047921281506061697549192" type="text/css" media="all"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="<?php echo THEME_URL . "/assets/public/js/app.min.js"; ?>"></script>
</head>

<body class="woocommerce-singlex woocommerce-singles">

  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <?php
        $args = array(
          'post_type'       => 'post',
          'orderby'         => 'ID',
          'post_status'     => 'publish',
          'order'           => 'DESC',
          'posts_per_page'  => 1
        );

        $result = new WP_Query($args);

        if ($result->have_posts()) {
          while ($result->have_posts()) {
            $result->the_post();
            $img_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
            $img_url = empty($img_url) ? THEME_URL . '/assets/images/empty.jpg' : $img_url[0];
        ?>
            <div class="article">
              <!-- Title -->
              <h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
              <!-- Meta -->
              <ul class="entry-meta">
                <li class="p-date">
                  <i class="fa-regular fa-clock"></i>
                  <a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'));  ?>" title="">
                    <?php echo get_the_date(); ?>
                  </a>
                </li>
                <li class="p-auth">
                  <i class="fa-regular fa-user"></i> Posted by
                  <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="<?php the_author(); ?>">
                    <?php the_author(); ?>
                  </a>
                </li>
              </ul>
              <!-- Thumbnail -->
              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="entry-image">
                <img src="<?php echo $img_url; ?>" class="wp-post-image" decoding="async" />
              </a>
              <!-- Excerpt -->
              <div class="entry-content"><?php the_content(); ?></div>

              <!-- Categories -->
              <div class="entry-cats text-center">
                Posted in
                <?php the_category(', '); ?>
              </div>

              <!-- Social share -->
              <div class="social-sharing text-center">
                <a href="//www.facebook.com/sharer.php?u=https://avon-demo.myshopify.com/blogs/news/dress-of-the-day" class="btn--share share-facebook" title="Share on Facebook" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=380,width=660');return false;">
                  <i class="fa-brands fa-facebook-f"></i> <i class="at at-facebook" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Share</span>
                </a>

                <a href="//twitter.com/share?text=Our%20development%20is%20your%20success&amp;url=https://avon-demo.myshopify.com/blogs/news/dress-of-the-day" class="btn--share share-twitter" title="Tweet on Twitter" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=380,width=660');return false;">
                  <i class="fa-brands fa-twitter"></i> <i class="at at-twitter" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Tweet</span>
                </a>

                <a href="//pinterest.com/pin/create/button/?url=https://avon-demo.myshopify.com/blogs/news/dress-of-the-day&amp;media=//avon-demo.myshopify.com/cdn/shop/articles/1_c3186544-e696-4d36-9b64-d566dd65d670_1024x1024.jpg?v=1561015924&amp;description=Our%20development%20is%20your%20success" class="btn--share share-pinterest" title="Pin on Pinterest" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=380,width=660');return false;">
                  <i class="fa-brands fa-pinterest"></i> <i class="at at-pinterest-p" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Pin it</span>
                </a>

                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=https://avon-demo.myshopify.com/blogs/news/dress-of-the-day&amp;title=Our%20development%20is%20your%20success&amp;source=Avone - Multipurpose Shopify Theme" class="btn--share share-pinterest" title="Share on Linked In" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=380,width=660');return false;">
                  <i class="fa-brands fa-linkedin"></i> <i class="at at-linkedin" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Share</span>
                </a>

                <a href="whatsapp://send?text=https://avon-demo.myshopify.com/blogs/news/dress-of-the-day" class="btn--share share-whatsapp hide-lg" title="Share on Whatsapp" target="_blank">
                  <i class="fa-brands fa-whatsapp"></i> <i class="at at-whatsapp"></i> <span class="share-title" aria-hidden="true">Whatsapp</span>
                </a>

                <a href="mailto:?subject=Check this https://avon-demo.myshopify.com/blogs/news/dress-of-the-day" class="btn--share share-pinterest" title="Share by Email" target="_blank">
                <i class="fa-regular fa-envelope"></i> <i class="at at-envelope-l"></i> <span class="share-title" aria-hidden="true">Email</span>
                </a>
              </div>

              <!-- Blog nav -->
              <div class="blog-nav d-flex justify-content-between">
                <span class="previous"><?php previous_post_link('%link', 'previous'); ?></span>
                <span class="next"><?php next_post_link('%link;', 'next'); ?></span>
              </div>
            </div>
        <?php
          }
        }
        ?>
      </div>
    </div>

    <div class="text-center d-flex justify-content-around blog-pagination-pages">
      <?php if (function_exists('_pagenavi_init')) wp_pagenavi('<div id="wp_pagenavi">', '</div>'); ?>
    </div>
  </div>

  <script>
    jQuery(document).ready(function() {

      $('.switch-register, .switch-login').click(function() {
        $('.user-auth').toggleClass('active')
      })

    })
  </script>
</body>

</html>