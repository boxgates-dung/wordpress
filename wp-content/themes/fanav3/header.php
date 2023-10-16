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
    <!-- Top nav -->
    <div class="nav-top text-center">
      <div class="container">
        <div class="header-logo">
          <?php if (get_custom_logo()) { ?>
            <?php echo get_custom_logo(); ?>
          <?php } else { ?>
            <a href="<?php echo get_home_url() ?>" class="custom-logo-link">
              <span>
                <?php echo get_bloginfo('name'); ?>
              </span>
            </a>
          <?php } ?>
        </div>
      </div>
    </div>
    <!-- End top nav -->

    <!-- Main nav -->
    <div class="main-nav">
      <div class="container">
        <div class="row">
          <div class="nav-left col-3 d-flex justify-content-start align-items-center">
            <!-- Search -->
            <div class="d-search-form w-100">
              <form action="/" method="get" class="search-form w-100">
                <div class="form-group">
                  <div class="input-group position-relative">
                    <input type="text" placeholder="I’m looking for ..." name="s" required="" class="border-0 flex-grow-1 d-inline-block align-middle shadow-none">
                    <button type="submit" class="button-search d-flex border-0 align-items-center float-right rounded-circle text-light"><i aria-hidden="true" class="tb-icon tb-icon-search-normal"></i></button>
                    <input type="hidden" name="post_type" value="product" class="post_type">

                    <!-- Search result -->
                    <div class="search-results-wrapper d-none">
                      <div class="fana-search-results">
                        <div class="autocomplete-suggestions" style="position: absolute;width: 100%;z-index: 9999;">
                          <div class="autocomplete-suggestion" data-index="0">
                            <div class="suggestion-title no-found-msg">No products found.</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End search result -->
                  </div>
                </div>
              </form>
            </div>
            <!-- End search -->
          </div>

          <div class="nav-menu col-6">
            <div class="primary-menu">
              <?php wp_nav_menu([
                'theme_location' => 'primary',
                'container' => '',
                'menu_class' => 'primary-menu-nav',
              ]) ?>
            </div>
          </div>

          <div class="nav-right col-3 d-flex justify-content-end align-items-center">
            <div class="d-flex justify-content-end align-items-center">
              <?php if (class_exists('WooCommerce')) { ?>
                <!-- My account -->
                <div class="header-icon header-account">
                  <a data-toggle="modal" data-target="#loginModal" href="<?php echo is_user_logged_in() ? wc_get_account_endpoint_url('dashboard') : 'javascript:void(0)'; ?>">
                    <i aria-hidden="true" class="tb-icon tb-icon-user"></i>
                  </a>
                </div>
                <!-- End my account -->

                <!-- Recently viewed -->
                <div class="header-icon header-product-recently-viewed">
                  <a class="product-recently-viewed" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="javascript:void(0);" title="View your shopping cart">
                    <span class="recently-viewed-icon">
                      <i aria-hidden="true" class="tb-icon tb-icon-recently-viewed"></i>
                    </span>
                  </a>

                  <div class="content-view ">
                    <div class="list-recent">
                    </div>
                  </div>
                </div>
                <!-- End Recently viewed -->

                <!-- Wishlist -->
                <div class="header-icon header-wishlist">
                  <a href="/wishlist/" class="wishlist">
                    <span class="wishlist-icon d-flex position-relative align-items-center">
                      <i aria-hidden="true" class="tb-icon tb-icon-heart"></i>
                      <span class="wishlist-items position-absolute"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                    </span>
                  </a>
                </div>
                <!-- End wishlist -->

                <div class="divider"></div>

                <!-- Mini cart -->
                <div class="header-icon header-cart popup">
                  <div class="cart-dropdown cart-popup dropdown">
                    <a class="dropdown-toggle mini-cart" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="javascript:void(0);" title="View your shopping cart">
                      <span class="cart-icon">
                        <i class="tb-icon tb-icon-bag"></i>
                        <span class="mini-cart-items"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                      </span>
                      <span class="text-cart"> <span class="subtotal"> <?php echo WC()->cart->get_cart_total(); ?> </span> </span>
                    </a>

                    <div class="dropdown-menu">
                      <div class="widget_shopping_cart_content">
                        <!-- Render shopping cart content -->
                        <?php woocommerce_mini_cart(); ?>
                        <!-- End render shopping cart content -->
                      </div>
                    </div>

                  </div>
                </div>
                <!-- End mini cart -->
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Main nav -->
  </header>

  <?php
  $footer_static_id = get_static_template('theme_header_part');
  if ($footer_static_id) {
    $ele = Elementor\Plugin::instance();
    echo $ele->frontend->get_builder_content_for_display($footer_static_id);
  }
  ?>
  <?php get_template_part('template-parts/mobile', 'header-nav'); ?>