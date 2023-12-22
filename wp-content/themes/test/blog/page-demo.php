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

<body class="woocommerce-blogx">

  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <?php
        $args = array(
          'post_type'       => 'post',
          'orderby'         => 'ID',
          'post_status'     => 'publish',
          'order'           => 'DESC',
          'posts_per_page'  => -1
        );

        $result = new WP_Query($args);

        if ($result->have_posts()) {
          while ($result->have_posts()) {
            $result->the_post();
            $img_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
            $img_url = empty($img_url) ? THEME_URL . '/assets/images/empty.jpg' : $img_url[0];
        ?>
            <div class="article">
              <!-- Thumbnail -->
              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="entry-image">
                <img src="<?php echo $img_url; ?>" class="wp-post-image" decoding="async" />
              </a>
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
                <li class="p-cat">
                  <i class="fa-solid fa-tag"></i>
                  Posted in
                  <?php the_category(', '); ?>
                </li>
              </ul>
              <!-- Excerpt -->
              <div class="entry-excerpt"><?php the_excerpt(); ?></div>
              <!-- Readmore -->
              <p class="readmore"><a href="<?php the_permalink(); ?>" class="btn btn-readmore" title="<?php the_title_attribute(); ?>">Read more</a></p>
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