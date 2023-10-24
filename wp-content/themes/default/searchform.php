<!-- <div class="search_form">
  <form class="search-form" id="search-form" action="<?php echo esc_url(home_url('/')); ?>" method="get">
    <input class="form_control" type="text" name="s" placeholder="<?php esc_attr_e('Search...', 'clotya') ?>" autocomplete="off">
    <button type="submit"><i class="klbth-icon-search"></i></button>
  </form>
</div>

<form role="search" method="get" class="search-form-offcanvas position-relative top-50 start-50" action="https://demo.casethemes.net/bixol/">
  <div class="searchform-wrap"> <input type="text" placeholder="Enter Keywords..." id="search" name="s" class="search-field">
    <button type="submit" class="search-submit"><i class="fa-solid fa-magnifying-glass"></i></button>
  </div>
</form> -->

<!-- <form action="/" method="get">
  <label for="search">Search in <?php echo home_url('/'); ?></label>
  <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
  <input type="image" alt="Search" src="<?php bloginfo('template_url'); ?>/images/search.png" />
</form>


<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
  <div class="searchform-wrap">
    <input type="text" placeholder="Search..." name="s" class="search-field">
    <button type="submit" class="search-submit"><i class="fa-solid fa-magnifying-glass"></i></button>
  </div>
</form> -->



<?php
echo($args['test']);