<header class="site-header header-type1 bg-transparent">
  <?php get_template_part('template-parts/header/models/topbar'); ?>

  <div class="container m-auto h-20 flex justify-between items-center">
    <?php get_template_part('template-parts/header/models/header-branding'); ?>

    <div class="header-nav">
      <?php
      wp_nav_menu(
        array(
          'container_id'    => 'primary-menu',
          'container_class' => 'hidden bg-gray-100 mt-4 p-4 h-full lg:mt-0 lg:p-0 lg:bg-transparent lg:block',
          'menu_class'      => 'lg:flex lg:-mx-4',
          'theme_location'  => 'primary',
          'li_class'        => 'lg:mx-4',
          'fallback_cb'     => false,
        )
      );
      ?>
    </div>

    <?php get_template_part('template-parts/header/models/header-icon'); ?>
  </div>
</header>