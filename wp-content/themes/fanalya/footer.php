</main>

<?php do_action('tailpress_content_end'); ?>

</div>

<?php do_action('tailpress_content_after'); ?>
<?php get_template_part('template-parts/footer/main-footer'); ?>
</div>

<?php wp_footer(); ?>

<!-- Popup modals -->
<?php get_template_part('template-parts/popup/popup-quickcart'); ?>
<?php get_template_part('template-parts/popup/popup-quickview'); ?>
<?php get_template_part('template-parts/popup/popup-wishlist'); ?>

<!-- Offcanvas -->
<?php get_template_part('template-parts/offcanvas/offcanvas-sidebar-mobile'); ?>

</body>

</html>