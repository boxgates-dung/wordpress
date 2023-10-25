<!-- Offcanvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMobileSidebar" aria-labelledby="offcanvasMobileSidebarLabel">
  <div class="offcanvas-header">
    <!-- <h5 id="offcanvasRightLabel">Offcanvas right</h5> -->
    <a href="javascript:;" class="offcanvas-close btn-offcanvas-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></a>
  </div>
  <div class="offcanvas-body">
    <!-- Render menu -->
    <?php 
    // wp_nav_menu([
    //   'theme_location'  => 'primary',
    //   'container'       => '',
    //   'menu_class'      => 'primary-mobile-menu-nav',
    // ]);

    // wp_nav_menu(array(
    //   'theme_location'  => 'primary',
    //   "walker"          => new Mobile_Nav_Walker('primary-mobile-menu'),
    // )); 
    
    ?>
    <!-- End render menu -->
  </div>
</div>

<div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasSearch" aria-labelledby="offcanvasSearchLabel">
  <div class="offcanvas-header">
    <a href="javascript:;" class="offcanvas-close btn-offcanvas-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></a>
  </div>
  <div class="offcanvas-body po">
    <?php //get_search_form(); ?>
  </div>
</div>
<!-- End Offcanvas -->