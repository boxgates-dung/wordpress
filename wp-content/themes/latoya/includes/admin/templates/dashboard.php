<?php
$tab_active        = isset($_GET['tab']) ? $_GET['tab'] : null;
$page_slug  = '/wp-admin/admin.php?page=theme_options';

$tabs = array(
  array(
    'name'    => 'General',
    'slug'    => 'general-table',
    'page_id' => ''
  ),
  array(
    'name'    => 'Layout',
    'slug'    => 'layout-table',
    'page_id' => ''
  ),
  array(
    'name'    => 'Header & Footer',
    'slug'    => 'hf-table',
    'page_id' => ''
  ),
  array(
    'name'    => 'Shop Page',
    'slug'    => 'shop-table',
    'page_id' => ''
  ),
  array(
    'name'    => 'Single Product',
    'slug'    => 'single-product-table',
    'page_id' => ''
  ),
  array(
    'name'    => 'Blog',
    'slug'    => 'blog-table',
    'page_id' => ''
  ),
  array(
    'name'    => 'Single Blog',
    'slug'    => 'single-blog-table',
    'page_id' => ''
  ),
  array(
    'name'    => 'Search Ajax',
    'slug'    => 'search-table',
    'page_id' => ''
  ),
);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['theme_options_general']) && wp_verify_nonce($_POST['theme_options_general'], 'theme_options_general_action')) {
    $theme_options = [];

    $theme_options = [
      'header_id'     => $_POST['theme_options_header_id'] ?? '',
      'footer_id'     => $_POST['theme_options_footer_id'] ?? '',
    ];

    update_option('theme_options_config', $theme_options);
  }
}

$theme_options_config = get_option('theme_options_config', [
  'header_id'   => '',
  'footer_id'   => '',
]);
?>

<div class="wrap theme-option-wrap">
  <h1><?php esc_html_e('Theme Options', THEME_OPTIONS_DOMAIN); ?></h1>

  <nav class="nav-tab-wrapper">
    <?php foreach ($tabs as $index => $tab) {
      if ($tab_active === null && $index == 0) {
        echo '<a href="' . $page_slug . '&tab=' . $tab['slug'] . '" data-page_id="' . $tab['page_id'] . '" class="nav-tab nav-tab-active">' . $tab['name'] . '</a>';
      } else {
        echo '<a href="' . $page_slug . '&tab=' . $tab['slug'] . '" data-page_id="' . $tab['page_id'] . '" class="nav-tab' . ($tab_active == $tab['slug'] ? ' nav-tab-active' : '') . '">' . $tab['name'] . '</a>';
      }
    } ?>
  </nav>

  <form id="general-form" class="form-dashboard form-active" method="post" novalidate="novalidate">
    <?php wp_nonce_field('theme_options_general_action', 'theme_options_general'); ?>

    <!-- HF Table -->
    <table id="hf-table" class="form-table <?php echo $tab_active == 'hf-table' ? 'table-active' : '' ?>" role="presentation">
      <tbody>
        <!-- Header Config -->
        <tr>
          <th scope="row">
            <label for="theme_options_header_id"><?php esc_html_e('Header Template', THEME_OPTIONS_DOMAIN);?></label>
          </th>
          <td>
            <select id="theme_options_header_id" name="theme_options_header_id">
              <option value="0"><?php esc_html_e('— Select —', THEME_OPTIONS_DOMAIN);?></option>

              <?php
              $args = array(
                'posts_per_page'  => -1,
                'orderby'         => 'name',
                'order'           => 'ASC',
                'post_type'       => 'hf_builder',
              );
              $items = get_posts($args);

              foreach ($items as $item) {
                echo  '<option value="' . $item->ID . '" ' . ($theme_options_config['header_id'] == $item->ID ? 'selected="selected"' : "") . '  >' . $item->post_title . '</option>';
              }
              ?>
            </select>
            <p><?php esc_html_e('Add new header', THEME_OPTIONS_DOMAIN); ?> <a href="/wp-admin/edit.php?post_type=hf_builder">template</a></p>
          </td>
        </tr>
        <!-- End Header Config -->

        <!-- Footer Config -->
        <tr>
          <th scope="row">
            <label for="theme_options_footer_id"><?php esc_html_e('Footer Template', THEME_OPTIONS_DOMAIN);?></label>
          </th>
          <td>
            <select id="theme_options_footer_id" name="theme_options_footer_id">
              <option value="0"><?php esc_html_e('— Select —', THEME_OPTIONS_DOMAIN);?></option>

              <?php
              $args = array(
                'posts_per_page'  => -1,
                'orderby'         => 'name',
                'order'           => 'ASC',
                'post_type'       => 'hf_builder',
              );
              $items = get_posts($args);

              foreach ($items as $item) {
                echo  '<option value="' . $item->ID . '" ' . ($theme_options_config['footer_id'] == $item->ID ? 'selected="selected"' : "") . '  >' . $item->post_title . '</option>';
              }
              ?>
            </select>

            <p> <?php esc_html_e('Add new footer', THEME_OPTIONS_DOMAIN);?> <a href="/wp-admin/edit.php?post_type=hf_builder">template</a></p>
          </td>
        </tr>
        <!-- End Footer Config -->

      </tbody>
    </table>
    <!-- End HF Table -->

    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
  </form>

</div>