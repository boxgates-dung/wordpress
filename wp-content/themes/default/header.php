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
    <div class="header-wrap">
      <div class="header-middle">
        <div class="container">
          <div class="row">
            <div class="header-branding">
              <div class="header-branding-inner">
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

      <div class="header-main">
        <div class="container d-none d-lg-block p-0">
          <div class="d-flex gx-0 justify-content-around">
            <div class="row w-100">
              <div class="header-branding">
                <div class="header-branding-inner">

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
              </div>

              <div class="header-navigation flex-fill w-100">
                <nav class="main-navigation">
                  <div class="main-navigation-inner">
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
                  <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch">
                    <i class="fa-solid fa-magnifying-glass"></i>
                  </a>
                </div>
              </div>

              <div class="header-social">
                <a href="<?php echo esc_url('https://www.facebook.com/sharer/sharer.php?u=' . get_permalink(get_the_ID())); ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="<?php echo esc_url('https://twitter.com/intent/tweet?url=' . get_permalink(get_the_ID())); ?>" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                <a href="<?php echo esc_url('https://www.linkedin.com/shareArticle?mini=true&url=' . get_permalink(get_the_ID())); ?>" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="<?php echo esc_url('https://www.instagram.com/?url=' . get_permalink(get_the_ID())); ?>" target="_blank"><i class="fa-brands fa-instagram"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </header>

  <div class="mobile-top-nav d-lg-none position-fixed top-0 start-0 w-100">
    <div class="position-relative h-100 w-100">
      <div class="row align-items-center">
        <!-- Nav btn hambuger -->
        <div class="w-auto">
          <span class="btn-nav-mobile" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMobileSidebar">
            <span></span>
          </span>
        </div>
        <!-- End btn hambuger  -->

        <!-- Middle mobile nav -->
        <div class="w-auto flex-fill text-center">
          <div class="mobile-nav-middle w-100">
            <div class="mobile-logo w-auto flex-fill text-center">
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

            <div class="search-form-mobile">
              <form role="search" method="get" action="#" class="position-relative">
                <input type="text" placeholder="Search..." name="s" class="search-field">
                <button type="submit" class="search-submit position-absolute text-white top-0 end-0 p-0 shadow-none border-0 bg-transparent">
                  <svg class="svgSearch styler-svg-icon" width="30" height="30" fill="currentColor" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <g>
                      <path d="m40.2850342 37.4604492-6.4862061-6.4862061c1.9657593-2.5733643 3.0438843-5.6947021 3.0443115-8.9884033 0-3.9692383-1.5458984-7.7011719-4.3530273-10.5078125-2.8066406-2.8066406-6.5380859-4.3525391-10.5078125-4.3525391-3.9692383 0-7.7011719 1.5458984-10.5078125 4.3525391-5.7939453 5.7944336-5.7939453 15.222168 0 21.015625 2.8066406 2.8071289 6.5385742 4.3530273 10.5078125 4.3530273 3.2937012-.0004272 6.4150391-1.0785522 8.9884033-3.0443115l6.4862061 6.4862061c.3901367.390625.9023438.5859375 1.4140625.5859375s1.0239258-.1953125 1.4140625-.5859375c.78125-.7807617.78125-2.0473633 0-2.828125zm-25.9824219-7.7949219c-4.234375-4.234375-4.2338867-11.1245117 0-15.359375 2.0512695-2.0507813 4.7788086-3.1806641 7.6796875-3.1806641 2.9013672 0 5.628418 1.1298828 7.6796875 3.1806641 2.0512695 2.0512695 3.1811523 4.7788086 3.1811523 7.6796875 0 2.9013672-1.1298828 5.628418-3.1811523 7.6796875s-4.7783203 3.1811523-7.6796875 3.1811523c-2.9008789.0000001-5.628418-1.1298827-7.6796875-3.1811523z"></path>
                    </g>
                  </svg>
                </button>
              </form>
            </div>
          </div>
        </div>
        <!-- End middle mobile nav -->

        <!-- Btn mobile search -->
        <div class="w-auto">
          <span class="btn-icon-search-mobile d-block">
            <svg class="svgSearch styler-svg-icon" width="30" height="30" fill="currentColor" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xmlns="http://www.w3.org/2000/svg">
              <g>
                <path d="m40.2850342 37.4604492-6.4862061-6.4862061c1.9657593-2.5733643 3.0438843-5.6947021 3.0443115-8.9884033 0-3.9692383-1.5458984-7.7011719-4.3530273-10.5078125-2.8066406-2.8066406-6.5380859-4.3525391-10.5078125-4.3525391-3.9692383 0-7.7011719 1.5458984-10.5078125 4.3525391-5.7939453 5.7944336-5.7939453 15.222168 0 21.015625 2.8066406 2.8071289 6.5385742 4.3530273 10.5078125 4.3530273 3.2937012-.0004272 6.4150391-1.0785522 8.9884033-3.0443115l6.4862061 6.4862061c.3901367.390625.9023438.5859375 1.4140625.5859375s1.0239258-.1953125 1.4140625-.5859375c.78125-.7807617.78125-2.0473633 0-2.828125zm-25.9824219-7.7949219c-4.234375-4.234375-4.2338867-11.1245117 0-15.359375 2.0512695-2.0507813 4.7788086-3.1806641 7.6796875-3.1806641 2.9013672 0 5.628418 1.1298828 7.6796875 3.1806641 2.0512695 2.0512695 3.1811523 4.7788086 3.1811523 7.6796875 0 2.9013672-1.1298828 5.628418-3.1811523 7.6796875s-4.7783203 3.1811523-7.6796875 3.1811523c-2.9008789.0000001-5.628418-1.1298827-7.6796875-3.1811523z"></path>
              </g>
            </svg>
          </span>
        </div>
        <!-- End btn mobile search -->
      </div>
    </div>
  </div>

  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMobileSidebar" aria-labelledby="offcanvasMobileSidebarLabel">
    <div class="offcanvas-header">
      <!-- <h5 id="offcanvasRightLabel">Offcanvas right</h5> -->
      <a href="javascript:;" class="offcanvas-close btn-offcanvas-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></a>
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

  <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasSearch" aria-labelledby="offcanvasSearchLabel">
    <div class="offcanvas-header">
      <a href="javascript:;" class="offcanvas-close btn-offcanvas-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></a>
    </div>
    <div class="offcanvas-body po">


      <form role="search" method="get" class="search-form-offcanvas position-relative top-50 start-50" action="https://demo.casethemes.net/bixol/">
        <div class="searchform-wrap"> <input type="text" placeholder="Enter Keywords..." id="search" name="s" class="search-field">
          <button type="submit" class="search-submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
      </form>


    </div>
  </div>