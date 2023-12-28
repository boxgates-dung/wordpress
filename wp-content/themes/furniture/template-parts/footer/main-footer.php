<footer id="colophon" class="site-footer bg-gray-50 py-8" role="contentinfo">

  <?php do_action('tailpress_footer'); ?>

  <div class="container">
    <div class="grid grid-rows-3 md:grid-flow-col">
      <div class="row-span-1 bg-black">01</div>
      <div class="row-span-1 bg-blue-500">03</div>
      <div class="row-span-1 bg-black">03</div>
    </div>
  </div>

  <div class="container mx-auto text-center text-gray-500">
    &copy; <?php echo date_i18n('Y'); ?> - <?php echo get_bloginfo('name'); ?>
  </div>

</footer>