<div class="header-branding w-full md:w-auto text-center md:text-left">
  <?php if (has_custom_logo()) { ?>
    <div class="max-w-[200px] h-auto">
      <?php the_custom_logo(); ?>
    </div>
  <?php } else { ?>
    <a href="<?php echo get_bloginfo('url'); ?>" class="site-text font-semibold text-lg">
      <?php echo get_bloginfo('name'); ?>
    </a>
    <p class="text-sm font-light text-gray-600">
      <?php echo get_bloginfo('description'); ?>
    </p>
  <?php } ?>
</div>