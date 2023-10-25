<!-- Offcanvas mobile sidebar-->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMobileSidebar" aria-labelledby="offcanvasMobileSidebarLabel">
  <a href="javascript:;" class="offcanvas-close btn-offcanvas-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></a>
  <div class="offcanvas-body">
    <div class="mobile-logo w-100 text-center mt-4 mb-2">
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

    <!-- Render menu -->
    <?php
    wp_nav_menu(array(
      'theme_location'  => 'primary',
      'container'       => '',
      'menu_class'      => 'primary-mobile-menu-nav',
      "walker"          => new Custom_Walker_Nav_Menu(),
    ));
    ?>
    <!-- End render menu -->
  </div>
</div>
<!-- End offcanvas mobile sidebar-->

<!-- Search Offcanvas -->
<div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasSearch" aria-labelledby="offcanvasSearchLabel">
  <div class="offcanvas-header">
    <a href="javascript:;" class="offcanvas-close btn-offcanvas-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></a>
  </div>
  <div class="offcanvas-body">
    <div class="d-flex w-100 h-100 align-items-center justify-content-center">
      <?php get_search_form(); ?>
    </div>
  </div>
</div>
<!-- End Search Offcanvas -->