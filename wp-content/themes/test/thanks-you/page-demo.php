<?php

$order = new WC_Order(78405);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?php echo THEME_URL . "/assets/public/css/vendors.css"; ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="<?php echo THEME_URL . "/assets/public/js/app.min.js"; ?>"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="woocommerce-checkoutx">

  <div class="container">

    <!-- Slider main container -->
    <div class="product-gallery">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
        <!-- Slides -->
        <div class="swiper-slide">
          <a href="https://picsum.photos/1200/1400" class="fancybox product-img--main" data-scale="2.2">
            <div class="product-img--main__image" style="background-image: url(https://picsum.photos/1200/1400);"></div>
          </a>
        </div>
        <div class="swiper-slide">
          <a href="https://picsum.photos/1200/1200" class="fancybox product-img--main" data-scale="2.2">
            <div class="product-img--main__image" style="background-image: url(https://picsum.photos/1200/1200);"></div>
          </a>
        </div>
        <div class="swiper-slide">
          <a href="https://picsum.photos/1200/1300" class="fancybox product-img--main" data-scale="2.2">
            <div class="product-img--main__image" style="background-image: url(https://picsum.photos/1200/1300);"></div>
          </a>
        </div>
        <!-- Slides -->
      </div>

      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>

      <!-- thirt party -->
      <a href="https://www.youtube.com/watch?v=FUz4B4eYa90" class="popup-video" title="Watch Video">
        <i class="at at-video" aria-hidden="true"></i>
        <span class="tooltip-label">Watch Video</span>
      </a>

    </div>

    <div class="product-sub-gallery">
      <div class="swiper-wrapper">
        <?php
        for ($i = 0; $i < 10; $i++) {
          echo '<div class="swiper-slide">';
          echo '<img src="https://picsum.photos/1200/1400" />';
          echo '</div>';
        }
        ?>
      </div>

    </div>


    <div class="row">
      <div class="col-md-4">
        <div id="nav_menu-1558678581777" class="footer-block__item toggle-footer-links">
          <p class="title">QUICK SHOP</p>
          <ul>
            <li><a href="/collections/women-fashion">Fashion</a></li>
            <li><a href="/collections/men">Men</a></li>
            <li><a href="/collections/furniture">Furniture</a></li>
            <li><a href="/collections/modern-home-design">Home Decor</a></li>
            <li><a href="/collections/shoes">Shoes</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-4"></div>
      <div class="col-md-4"></div>
    </div>
  </div>

  <script>
    jQuery(document).ready(function($) {
      /**
       * Image slider
       * **/
      const swiper = new Swiper('.product-gallery', {
        loop: true,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      })

      new Swiper('.product-sub-gallery', {
        spaceBetween: 10,
        slideToClickedSlide: true,
        slidesPerView: 4,
        loopedSlides: 4,
      })

      /**
       * Zoom in and zoom out image product
       * **/
      $('.product-img--main')
        .on('mouseover', function() {
          $(this).children('.product-img--main__image').css({
            'transform': 'scale(' + $(this).attr('data-scale') + ')'
          });
        })
        .on('mouseout', function() {
          $(this).children('.product-img--main__image').css({
            'transform': 'scale(1)'
          });
        })
        .on('mousemove', function(e) {
          $(this).children('.product-img--main__image').css({
            'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 + '%'
          });
        })

      /**
       * Click and zoom slide image product
       * **/
      $('.fancybox').fancybox({
        buttons: ['close'],
        wheel: false,
        transitionEffect: 'slide',
        loop: true,
        toolbar: true,
        clickContent: true,
      })

      $('.toggle-footer-links .title').click(function(){
        $(this).toggleClass('active')
      })
    })
  </script>

  <style>

  </style>
</body>

</html>