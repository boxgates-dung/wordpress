<?php get_header(); ?>
<div class="container">
  <div class="row">
    <div class="col-lg-6 mx-auto my-5">
      <div class="img-404">
        <img src="<?php echo esc_url(LATOYA_THEME_URI . '/assets/images/img-404.jpg'); ?>" alt="Img 404" class="lazyloaded">
      </div>
      <section class="error-404 text-center mt-4">
        <h1 class="title-404"><?php esc_html_e('Page Not Found', LATOYA_THEME_DOMAIN); ?></h1>
        <div class="content-404">
          <p class="sub-title mb-4"><?php esc_html_e('We’re very sorry but the page you are looking for doesn’t exist or has been moved.', LATOYA_THEME_DOMAIN); ?></p>
          <a href="<?php echo esc_url(get_home_url()); ?>" class="button back"><?php esc_html_e('home page', LATOYA_THEME_DOMAIN); ?></a>
        </div>
      </section>
    </div>
  </div>
</div>
<?php get_footer(); ?>