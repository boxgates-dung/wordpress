<header class="site-header header-type1 bg-transparent">
  <?php get_template_part('template-parts/header/models/topbar'); ?>

  <div class="container m-auto h-16 md:h-20 flex justify-between items-center">

    <button data-drawer-target="drawer-sidebar-mobile" data-drawer-toggle="drawer-sidebar-mobile" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
      <span class="sr-only">Open sidebar</span>
      <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
      </svg>
    </button>

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

    <!-- Icons -->
    <button data-drawer-target="drawer-sidebar-mobile" data-drawer-toggle="drawer-sidebar-mobile" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
      <svg class="svgUser2 w-6" enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
        <g>
          <g>
            <path d="m256 253.7c-62 0-112.4-50.4-112.4-112.4s50.4-112.4 112.4-112.4 112.4 50.4 112.4 112.4-50.4 112.4-112.4 112.4zm0-195.8c-46 0-83.4 37.4-83.4 83.4s37.4 83.4 83.4 83.4 83.4-37.4 83.4-83.4-37.4-83.4-83.4-83.4z"></path>
          </g>
          <g>
            <path d="m452.1 483.2h-392.2c-8 0-14.5-6.5-14.5-14.5 0-106.9 94.5-193.9 210.6-193.9s210.6 87 210.6 193.9c0 8-6.5 14.5-14.5 14.5zm-377-29.1h361.7c-8.1-84.1-86.1-150.3-180.8-150.3s-172.7 66.2-180.9 150.3z"></path>
          </g>
        </g>
      </svg>
    </button>
    <!-- End Icons-->
  </div>
</header>