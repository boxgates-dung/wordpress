<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['theme_options_general']) && wp_verify_nonce($_POST['theme_options_general'], 'theme_options_general_action')) {
    $siteConfigs = [];
    if (!empty($_POST['theme_options_async_data_to_strapi'])) {
      update_option('theme_options_async_data_to_strapi', true);
    } else {
      update_option('theme_options_async_data_to_strapi', false);
    }

    $siteConfigs = [
      'header-and-footer_tag_id'     => $_POST['theme_options_header-and-footer_tag_id'] ?? '',
      'header-and-footer_tag_code'   => $_POST['theme_options_header-and-footer_tag_code'] ?? '',
      'fb_app_id'         => $_POST['theme_options_fb_app_id'] ?? '',
      'fb_page_id'         => $_POST['theme_options_fb_page_id'] ?? '',
      'display_fb_chat'   => $_POST['theme_options_display_fb_chat'] ?? '',
      'sendy_list'         => $_POST['theme_options_sendy_list'] ?? '',
      'media_cdn_url'     => $_POST['theme_options_media_cdn_url'] ?? '',
      'header-and-footer_site_verify'     => $_POST['theme_options_header-and-footer_site_verify'] ?? '',
      'enable_generate_sku'   => !empty($_POST['theme_options_enable_generate_sku']) ? 1 : 0,
      'enable_custom_login'   => !empty($_POST['theme_options_enable_custom_login']) ? 1 : 0,
      'enable_referral'       => !empty($_POST['theme_options_enable_referral_code']) ? 1 : 0,
      'microsoft_bing_ads_id' => $_POST['theme_options_microsoft_bing_ads_id'] ?? '',
      'enable_limit_cart' => (isset($_POST['theme_options_enable_limit_cart']) && $_POST['theme_options_enable_limit_cart']) ? 1 : 0,
      'number_limit_cart' => $_POST['theme_options_number_limit_cart'] ?? '',
      'enable_log_activity' => !empty($_POST['theme_options_enable_log_activity']) ? 1 : 0,
      'enable_new_price' => !empty($_POST['theme_options_enable_new_price']) ? 1 : 0,
    ];

    update_option('theme_options_site_config', $siteConfigs);
  }
}
$theme_optionsSiteConfig = get_option('theme_options_site_config', [
  'header-and-footer_tag_id'   => '',
  'header-and-footer_tag_code' => '',
  'fb_app_id'       => '',
  'fb_page_id'       => '',
  'display_fb_chat' => '',
  'sendy_list'       => '',
  'media_cdn_url'   => '',
  'header-and-footer_site_verify'     => '',
  'enable_generate_sku'   => 0,
  'microsoft_bing_ads_id' => '',
  'enable_custom_login'   => 0,
  'enable_referral'       => 0,
  'enable_limit_cart' => '',
  'number_limit_cart' => 1,
  'enable_log_activity' => 0,
]);

// Lấy tab đang active từ pảm
$tab      = isset($_GET['tab']) ? $_GET['tab'] : null;
$pageSlug = 'theme-options';
?>

<div class="wrap">
  <!-- Tiêu đề trang -->
  <h1>Theme Options</h1>
  <!-- Tab trang -->
  <nav class="nav-tab-wrapper">
    <a href="?page=<?php echo $pageSlug; ?>&tab=general-table" class="nav-tab <?php echo $tab == 'general-table' || $tab === null ? 'nav-tab-active' : '' ?>">General</a>
    <a href="?page=<?php echo $pageSlug; ?>&tab=header-and-footer-table" class="nav-tab <?php echo $tab == 'header-and-footer-table' ? 'nav-tab-active' : '' ?>">Header and Footer</a>
  </nav>

  <form id="general-form" class="form-dashboard form-active" method="post" novalidate="novalidate">
    <?php wp_nonce_field('theme_options_general_action', 'theme_options_general'); ?>
    <!-- General table -->
    <table id="general-table" class="form-table  <?php echo $tab == 'general-table' || $tab === null ? 'table-active' : '' ?>" role="presentation">
      <tbody>
        <!-- General -->
        <tr>
          <th scope="row">
            <label for="theme_options_media_cdn_url">Media CDN</label>
          </th>
          <td>
            <input type="text" id="theme_options_media_cdn_url" value="<?php echo $theme_optionsSiteConfig['media_cdn_url'] ?>" name="theme_options_media_cdn_url" />
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="theme_options_sendy_list">Sendy List</label>
          </th>
          <td>
            <input type="text" id="theme_options_sendy_list" value="<?php echo $theme_optionsSiteConfig['sendy_list'] ?>" name="theme_options_sendy_list" />
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <hr>
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="theme_options_enable_log_activity">Enable Trigger Log Activity</label>
          </th>
          <td>
            <input type="checkbox" id="theme_options_enable_log_activity" value="1" <?php echo $theme_optionsSiteConfig['enable_log_activity'] == 1 ? 'checked' : '' ?> name="theme_options_enable_log_activity" />
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="theme_options_enable_generate_sku">Enable Generate SKU</label>
          </th>
          <td>
            <input type="checkbox" id="theme_options_enable_generate_sku" <?php echo $theme_optionsSiteConfig['enable_generate_sku'] == 1 ? 'checked' : '' ?> name="theme_options_enable_generate_sku" />
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="theme_options_enable_custom_login">Enable Custom Login</label>
          </th>
          <td>
            <input type="checkbox" id="theme_options_enable_custom_login" <?php echo $theme_optionsSiteConfig['enable_custom_login'] == 1 ? 'checked' : '' ?> name="theme_options_enable_custom_login" />
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="theme_options_enable_referral_code">Enable Referral Code</label>
          </th>
          <td>
            <input type="checkbox" id="theme_options_enable_referral_code" <?php echo $theme_optionsSiteConfig['enable_referral'] == 1 ? 'checked' : '' ?> name="theme_options_enable_referral_code" />
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="theme_options_enable_limit_cart">Enable Limit Cart</label>
          </th>
          <td>
            <input type="checkbox" id="theme_options_enable_limit_cart" <?php echo (isset($theme_optionsSiteConfig['enable_limit_cart']) && $theme_optionsSiteConfig['enable_limit_cart'] == 1) ? 'checked' : '' ?> name="theme_options_enable_limit_cart" />
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="theme_options_number_limit_cart">Number limit</label>
          </th>
          <td>
            <input type="text" id="theme_options_number_limit_cart" value="<?php echo (isset($theme_optionsSiteConfig['number_limit_cart'])) ? $theme_optionsSiteConfig['number_limit_cart'] : '' ?>" name="theme_options_number_limit_cart" />
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label for="theme_options_enable_new_price">Enable Badge "New Price"</label>
          </th>
          <td>
            <input type="checkbox" id="theme_options_enable_new_price" <?php echo (isset($theme_optionsSiteConfig['enable_new_price']) && $theme_optionsSiteConfig['enable_new_price'] == 1) ? 'checked' : '' ?> name="theme_options_enable_new_price" />
          </td>
        </tr>
        <!-- End General -->
      </tbody>
    </table>
    <!-- End General table -->

    <!-- header-and-footer table -->
    <table id="header-and-footer-table" class="form-table <?php echo $tab == 'header-and-footer-table' ? 'table-active' : '' ?>" role="presentation">
      <tbody>
       
      </tbody>
    </table>
    <!-- End header-and-footer table -->

    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
  </form>

</div>