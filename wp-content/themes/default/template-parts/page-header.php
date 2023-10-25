<?php if (!is_front_page()) { ?>
  <?php
  if (is_single()) {
    $background_img = get_the_post_thumbnail_url(null, 'full');
  } else if (is_page()) {
    $background_img = get_the_post_thumbnail_url(null, 'full');
  } else {
    $background_img = get_the_post_thumbnail_url(get_option('page_for_posts'), 'full');
  }
  ?>
  <div id="pageHeader" class="page-header bg-image" style="background-image: url('<?php echo $background_img; ?>');">
    <div class="container">
      <div class="page-title-inner">
        <div class="page-title-holder">
          <h1 class="page-title">
            <?php
            if (is_single()) {
              the_title();
            } else if (is_page()) {
              the_title();
            } else if (is_archive()) {
              the_archive_title();
            } else if (is_search()) {
              esc_html_e('Search results', THEME_DOMAIN);
            } else {
              esc_html_e(single_post_title(), THEME_DOMAIN);
            }
            ?>
          </h1>
        </div>
        <?php if (function_exists('yoast_breadcrumb')) yoast_breadcrumb('<div id="breadcrumbs">', '</div>'); ?>
      </div>
    </div>
  </div>
<?php } ?>