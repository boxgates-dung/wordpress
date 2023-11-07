<?php
$tab_active = isset($_GET['tab']) ? $_GET['tab'] : null;
$page_slug  = '/wp-admin/admin.php?page=theme_options';

$tabs = array(
  array(
    'name'    => 'General',
    'slug'    => 'general-table',
    'page_id' => '',
    'content' => 'tabs/general-table.php'
  ),
  array(
    'name'    => 'Layout',
    'slug'    => 'layout-table',
    'page_id' => '',
    'content' => ''
  ),
  array(
    'name'    => 'Header & Footer',
    'slug'    => 'hf-table',
    'page_id' => '',
    'content' => 'tabs/hf-table.php'
  ),
  array(
    'name'    => 'Shop Page',
    'slug'    => 'shop-table',
    'page_id' => '',
    'content' => ''
  ),
  array(
    'name'    => 'Single Product',
    'slug'    => 'single-product-table',
    'page_id' => '',
    'content' => ''
  ),
  array(
    'name'    => 'Blog',
    'slug'    => 'blog-table',
    'page_id' => '',
    'content' => 'tabs/blog-table.php'
  ),
  array(
    'name'    => 'Search Ajax',
    'slug'    => 'search-table',
    'page_id' => '',
    'content' => 'tabs/ajax-search-table.php'
  ),
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['theme_options_general']) && wp_verify_nonce($_POST['theme_options_general'], 'theme_options_general_action')) {
    $theme_options = [];

    $theme_options = [
      // General
      'back_to_top_button'  => $_POST['theme_options_back_to_top_button'] ?? '',

      // Header footer
      'top_header_id'       => $_POST['theme_options_top_header_id'] ?? '',
      'header_id'           => $_POST['theme_options_header_id'] ?? '',
      'footer_id'           => $_POST['theme_options_footer_id'] ?? '',

      // Blog
      'blog_sidebar'        => $_POST['theme_options_blog_sidebar'] ?? '',
      'post_row'            => $_POST['theme_options_post_row'] ?? '',
    ];

    update_option('theme_options_config', $theme_options);
  }
}

$theme_options_config = get_option('theme_options_config', [
  'back_to_top_button'  => '',

  'top_header_id'       => '',
  'header_id'           => '',
  'footer_id'           => '',

  'blog_sidebar'        => '',
  'post_row'            => '',
]);
?>

<div class="wrap theme-option-wrap">
  <h1><?php esc_html_e('Theme Options', THEME_OPTIONS_DOMAIN); ?></h1>

  <!-- Tabs header -->
  <nav class="nav-tab-wrapper">
    <?php foreach ($tabs as $index => $tab) {
      if ($tab_active === null && $index == 0) {
        echo '<a href="' . $page_slug . '&tab=' . $tab['slug'] . '" data-page_id="' . $tab['page_id'] . '" class="nav-tab nav-tab-active">' . $tab['name'] . '</a>';
      } else {
        echo '<a href="' . $page_slug . '&tab=' . $tab['slug'] . '" data-page_id="' . $tab['page_id'] . '" class="nav-tab' . ($tab_active == $tab['slug'] ? ' nav-tab-active' : '') . '">' . $tab['name'] . '</a>';
      }
    } ?>
  </nav>
  <!-- End tabs header -->

  <!-- Tabs Content -->
  <form id="general-form" class="form-dashboard form-active" method="post" novalidate="novalidate">
    <?php wp_nonce_field('theme_options_general_action', 'theme_options_general'); ?>
    <?php
    foreach ($tabs as $index => $tab) {
      if ($tab_active === null && $index == 0) {
        if (!empty($tab['content'])) {
          include $tab['content'];
        }
      } else {
        if (!empty($tab['content'])) {
          echo '<div ' . ($tab_active == $tab['slug'] ? '' : 'style="display:none"') . '>';
          include $tab['content'];
          echo '</div>';
        }
      }
    }
    ?>
    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
  </form>
  <!-- End Tabs Content -->
</div>