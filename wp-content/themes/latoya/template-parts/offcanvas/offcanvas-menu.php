<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
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
      "walker"          => new Latoya_Walker_Menu(),
    ]) ?>
    <!-- End render menu -->
  </div>
</div>