<table id="blog-table" class="form-table" role="presentation">
  <tbody>
    <!-- Heading -->
    <tr>
      <th colspan="2">
        <h3><?php esc_html_e('Blog', THEME_OPTIONS_DOMAIN); ?></h3>
      </th>
    </tr>
    <!-- End Heading -->

    <!-- Sidebar -->
    <tr>
      <th scope="row">
        <label for="theme_options_blog_archive_layout">
          <?php esc_html_e('Blog Archive Layout', THEME_OPTIONS_DOMAIN); ?>
        </label>
      </th>
      <td>
        <select id="theme_options_blog_archive_layout" name="theme_options_blog_archive_layout">
          <option value="left-main" <?php echo ($theme_options_config['blog_archive_layout'] == 'left-main' ? 'selected="selected"' : ""); ?>><?php esc_html_e('Left Main', THEME_OPTIONS_DOMAIN); ?></option>
          <option value="right-main" <?php echo ($theme_options_config['blog_archive_layout'] == 'right-main' ? 'selected="selected"' : ""); ?>><?php esc_html_e('Right Main', THEME_OPTIONS_DOMAIN); ?></option>
          <option value="main" <?php echo ($theme_options_config['blog_archive_layout'] == 'main' ? 'selected="selected"' : ""); ?>><?php esc_html_e('Main', THEME_OPTIONS_DOMAIN); ?></option>
        </select>
      </td>
    </tr>
    <!-- End Sidebar -->

    <!-- Post row -->
    <tr>
      <th scope="row">
        <label for="theme_options_blog_columns">
          <?php esc_html_e('Blog Columns', THEME_OPTIONS_DOMAIN); ?>
        </label>
      </th>
      <td>
        <select id="theme_options_blog_columns" name="theme_options_blog_columns">
          <option value="1" <?php echo ($theme_options_config['blog_columns'] == '1' ? 'selected="selected"' : ""); ?>><?php esc_html_e('1', THEME_OPTIONS_DOMAIN); ?></option>
          <option value="2" <?php echo ($theme_options_config['blog_columns'] == '2' ? 'selected="selected"' : ""); ?>><?php esc_html_e('2', THEME_OPTIONS_DOMAIN); ?></option>
          <option value="3" <?php echo ($theme_options_config['blog_columns'] == '3' ? 'selected="selected"' : ""); ?>><?php esc_html_e('3', THEME_OPTIONS_DOMAIN); ?></option>
          <option value="4" <?php echo ($theme_options_config['blog_columns'] == '4' ? 'selected="selected"' : ""); ?>><?php esc_html_e('4', THEME_OPTIONS_DOMAIN); ?></option>
        </select>
      </td>
    </tr>
    <!-- End Post row -->

    <!-- Layout Blog -->
    <tr>
      <th scope="row">
        <label for="theme_options_layout_blog">
          <?php esc_html_e('Layout Blog', THEME_OPTIONS_DOMAIN); ?>
        </label>
      </th>
      <td>
        <select id="theme_options_layout_blog" name="theme_options_layout_blog">
          <option value="layout_blog_1" <?php echo ($theme_options_config['layout_blog'] == 'layout_blog_1' ? 'selected="selected"' : ""); ?>><?php esc_html_e('Layout Blog 1', THEME_OPTIONS_DOMAIN); ?></option>
          <option value="layout_blog_2" <?php echo ($theme_options_config['layout_blog'] == 'layout_blog_2' ? 'selected="selected"' : ""); ?>><?php esc_html_e('Layout Blog 2', THEME_OPTIONS_DOMAIN); ?></option>
        </select>
      </td>
    </tr>
    <!-- End Layout Blog -->

    <!-- Div -->
    <tr>
      <th colspan="2">
        <hr>
        <h3><?php esc_html_e('Single Blog', THEME_OPTIONS_DOMAIN); ?></h3>
      </th>
    </tr>
    <!-- End div -->
  </tbody>
</table>