<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width">
  <title><?php wp_title('-', true, 'right'); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header class="header d-none d-lg-block">
    <?php
    $footer_static_id = get_static_template('theme_header_part');
    if ($footer_static_id) {
      $ele = Elementor\Plugin::instance();
      echo $ele->frontend->get_builder_content_for_display($footer_static_id);
    }
    ?>
  </header>

  <?php //get_template_part('template-parts/mobile', 'header-nav'); 
  ?>

  <header class="header d-none">
    <div class="header-wrap">

      <div class="header-middle d-none">
        <div class="container">
          <div class="row">
            <div class="header-branding">
              <div class="header-branding-inner">
                <a class="logo-dark" href="https://demo.casethemes.net/bixol/" title="Bixol" rel="home"><img src="https://demo.casethemes.net/bixol/wp-content/uploads/2020/11/logo-dark-black.png" alt="Bixol"></a>
                <!-- <a class="logo-mobile" href="https://demo.casethemes.net/bixol/" title="Bixol" rel="home"><img src="https://demo.casethemes.net/bixol/wp-content/themes/bxlo/assets/images/logo-mobile.png" alt="Bixol"></a> -->
              </div>

            </div>

            <div class="header-holder">
              <div class="middle-item">
                <div class="middle-icon"><i class="flaticon flaticon-mail"></i></div>
                <div class="middle-meta"> <label>envato@gmail.com</label> <span>Mail to us</span></div> <a href="mailto:envato@gmail.com" class="middle-link"></a>
              </div>
              <div class="middle-item">
                <div class="middle-icon"><i class="flaticon flaticon-phone"></i></div>
                <div class="middle-meta"> <label>Call for help:</label> <span>(+123) 5462 3257</span></div> <a href="tel:+12354623257" class="middle-link"></a>
              </div>
              <div class="middle-item">
                <div class="middle-icon"><i class="flaticon flaticon-alarm-clock"></i></div>
                <div class="middle-meta"> <label>Sunday - Friday:</label> <span>9am - 8pm</span></div>
              </div>
              <div class="middle-item">
                <div class="middle-icon"><i class="flaticon flaticon-pin"></i></div>
                <div class="middle-meta"> <label>380 Albert St, Melbourne</label> <span>Australia</span></div> <a href="https://www.google.com/maps?q=380+St+Kilda+Road,+Melbourne,+Australia" class="middle-link"></a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="header-main scroll-down">

        <div id="menu-mobile" class="d-lg-none">
          <span class="btn-nav-mobile open-menu"> <span></span> </span>
        </div>

        <div id="mobile-logo" class="mobile-logo d-lg-none">
          <div class="header-branding">
            <div class="header-branding-inner">
              <a class="logo-dark" href="https://demo.casethemes.net/bixol/" title="Bixol" rel="home"><img src="https://demo.casethemes.net/bixol/wp-content/uploads/2020/11/logo-dark-black.png" alt="Bixol"></a>
            </div>
          </div>
        </div>

        <div id="mobile-search" class="mobile-search d-lg-none">
          <a href="" class="btn-search-mobile">
            <svg class="svgSearch styler-svg-icon" width="512" height="512" fill="currentColor" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xmlns="http://www.w3.org/2000/svg">
              <g>
                <path d="m40.2850342 37.4604492-6.4862061-6.4862061c1.9657593-2.5733643 3.0438843-5.6947021 3.0443115-8.9884033 0-3.9692383-1.5458984-7.7011719-4.3530273-10.5078125-2.8066406-2.8066406-6.5380859-4.3525391-10.5078125-4.3525391-3.9692383 0-7.7011719 1.5458984-10.5078125 4.3525391-5.7939453 5.7944336-5.7939453 15.222168 0 21.015625 2.8066406 2.8071289 6.5385742 4.3530273 10.5078125 4.3530273 3.2937012-.0004272 6.4150391-1.0785522 8.9884033-3.0443115l6.4862061 6.4862061c.3901367.390625.9023438.5859375 1.4140625.5859375s1.0239258-.1953125 1.4140625-.5859375c.78125-.7807617.78125-2.0473633 0-2.828125zm-25.9824219-7.7949219c-4.234375-4.234375-4.2338867-11.1245117 0-15.359375 2.0512695-2.0507813 4.7788086-3.1806641 7.6796875-3.1806641 2.9013672 0 5.628418 1.1298828 7.6796875 3.1806641 2.0512695 2.0512695 3.1811523 4.7788086 3.1811523 7.6796875 0 2.9013672-1.1298828 5.628418-3.1811523 7.6796875s-4.7783203 3.1811523-7.6796875 3.1811523c-2.9008789.0000001-5.628418-1.1298827-7.6796875-3.1811523z"></path>
              </g>
            </svg>
          </a>
        </div>

        <div class="container d-none d-lg-flex">
          <div class="row">
            <div class="header-branding">
              <div class="header-branding-inner">
                <a class="logo-dark" href="https://demo.casethemes.net/bixol/" title="Bixol" rel="home"><img src="https://demo.casethemes.net/bixol/wp-content/uploads/2020/11/logo-dark-black.png" alt="Bixol"></a>
              </div>
            </div>

            <div class="header-navigation">
              <nav class="main-navigation">
                <div class="main-navigation-inner">
                  <!-- <div class="logo-mobile"> <a href="" title="" rel="home"><img src="https://demo.casethemes.net/bixol/wp-content/themes/bxlo/assets/images/logo-mobile.png" alt=""></a></div> -->
                  <!-- <div class="header-mobile-search">
                    <form role="search" method="get" action="https://demo.casethemes.net/bixol/"> <input type="text" placeholder="Search..." name="s" class="search-field"> <button type="submit" class="search-submit"><i class="fac fac-search"></i></button></form>
                  </div> -->
                  <!-- nav -->
                  <?php wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => '',
                    'menu_class' => 'primary-menu-nav',
                  ]) ?>
                  <!-- end nav -->
                </div>
              </nav>
            </div>

            <div class="header-meta">
              <div class="header-right-item h-btn-search">
                <i class="fa-solid fa-magnifying-glass"></i>
              </div>
            </div>

            <div class="header-social">
              <a href="#" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#" target="_blank"><i class="fa-brands fa-twitter"></i></a>
              <a href="#" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
              <a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </header>


  <div class="mobile-top-nav d-lg-none position-fixed top-0 start-0 w-100">
    <div class="row align-items-center">
      <div class="w-auto">
        <span class="btn-nav-mobile" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMobileSidebar">
          <span></span>
        </span>
      </div>

      <div class="mobile-logo w-auto flex-fill text-center d-none">
        <?php if (get_custom_logo()) { ?>
          <?php echo get_custom_logo(); ?>
        <?php } else { ?>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-logo-link">
            <span>
              <?php echo get_bloginfo('name'); ?>
            </span>
          </a>
        <?php } ?>
      </div>

      <div class="w-auto flex-fill text-center">
        <div class="search-form-mobile">

          <form role="search" method="get" action="#" class="position-relative">
            <input type="text" placeholder="Search..." name="s" class="search-field w-100">
            <button type="submit" class="search-submit position-absolute top-0 end-0">
              <svg class="svgSearch styler-svg-icon" width="30" height="30" fill="currentColor" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                <g>
                  <path d="m40.2850342 37.4604492-6.4862061-6.4862061c1.9657593-2.5733643 3.0438843-5.6947021 3.0443115-8.9884033 0-3.9692383-1.5458984-7.7011719-4.3530273-10.5078125-2.8066406-2.8066406-6.5380859-4.3525391-10.5078125-4.3525391-3.9692383 0-7.7011719 1.5458984-10.5078125 4.3525391-5.7939453 5.7944336-5.7939453 15.222168 0 21.015625 2.8066406 2.8071289 6.5385742 4.3530273 10.5078125 4.3530273 3.2937012-.0004272 6.4150391-1.0785522 8.9884033-3.0443115l6.4862061 6.4862061c.3901367.390625.9023438.5859375 1.4140625.5859375s1.0239258-.1953125 1.4140625-.5859375c.78125-.7807617.78125-2.0473633 0-2.828125zm-25.9824219-7.7949219c-4.234375-4.234375-4.2338867-11.1245117 0-15.359375 2.0512695-2.0507813 4.7788086-3.1806641 7.6796875-3.1806641 2.9013672 0 5.628418 1.1298828 7.6796875 3.1806641 2.0512695 2.0512695 3.1811523 4.7788086 3.1811523 7.6796875 0 2.9013672-1.1298828 5.628418-3.1811523 7.6796875s-4.7783203 3.1811523-7.6796875 3.1811523c-2.9008789.0000001-5.628418-1.1298827-7.6796875-3.1811523z"></path>
                </g>
              </svg>
            </button>
          </form>

        </div>
      </div>

      <div class="w-auto">
        <span class="btn-search-mobile btn-closes d-block">
          <svg class="svgSearch styler-svg-icon" width="30" height="30" fill="currentColor" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xmlns="http://www.w3.org/2000/svg">
            <g>
              <path d="m40.2850342 37.4604492-6.4862061-6.4862061c1.9657593-2.5733643 3.0438843-5.6947021 3.0443115-8.9884033 0-3.9692383-1.5458984-7.7011719-4.3530273-10.5078125-2.8066406-2.8066406-6.5380859-4.3525391-10.5078125-4.3525391-3.9692383 0-7.7011719 1.5458984-10.5078125 4.3525391-5.7939453 5.7944336-5.7939453 15.222168 0 21.015625 2.8066406 2.8071289 6.5385742 4.3530273 10.5078125 4.3530273 3.2937012-.0004272 6.4150391-1.0785522 8.9884033-3.0443115l6.4862061 6.4862061c.3901367.390625.9023438.5859375 1.4140625.5859375s1.0239258-.1953125 1.4140625-.5859375c.78125-.7807617.78125-2.0473633 0-2.828125zm-25.9824219-7.7949219c-4.234375-4.234375-4.2338867-11.1245117 0-15.359375 2.0512695-2.0507813 4.7788086-3.1806641 7.6796875-3.1806641 2.9013672 0 5.628418 1.1298828 7.6796875 3.1806641 2.0512695 2.0512695 3.1811523 4.7788086 3.1811523 7.6796875 0 2.9013672-1.1298828 5.628418-3.1811523 7.6796875s-4.7783203 3.1811523-7.6796875 3.1811523c-2.9008789.0000001-5.628418-1.1298827-7.6796875-3.1811523z"></path>
            </g>
          </svg>
        </span>
      </div>
    </div>


  </div>

  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMobileSidebar" aria-labelledby="offcanvasMobileSidebarLabel">
    <div class="offcanvas-header">
      <!-- <h5 id="offcanvasRightLabel">Offcanvas right</h5> -->
      <a href="javascript:;" class="offcanvas-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="tb-icon tb-icon-cross"></i></a>
    </div>
    <div class="offcanvas-body">
      <!-- Render menu -->
      <?php wp_nav_menu([
        'theme_location' => 'primary',
        'container' => '',
        'menu_class' => 'primary-mobile-menu-nav',
      ]) ?>
      <!-- End render menu -->
    </div>
  </div>