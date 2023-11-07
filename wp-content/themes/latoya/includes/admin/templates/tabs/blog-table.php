<table id="blog-table" class="form-table" role="presentation">
  <tbody>
    <!-- Sidebar -->
    <tr>
      <th scope="row">
        <label for="theme_options_blog_sidebar">
          <?php esc_html_e('Sidebar', THEME_OPTIONS_DOMAIN); ?>
        </label>
      </th>
      <td>
        <select id="theme_options_blog_sidebar" name="theme_options_blog_sidebar">
          <option value="left" <?php echo ($theme_options_config['blog_sidebar'] == 'left' ? 'selected="selected"' : ""); ?>><?php esc_html_e('Left', THEME_OPTIONS_DOMAIN); ?></option>
          <option value="right" <?php echo ($theme_options_config['blog_sidebar'] == 'right' ? 'selected="selected"' : ""); ?>><?php esc_html_e('Right', THEME_OPTIONS_DOMAIN); ?></option>
          <option value="full-width" <?php echo ($theme_options_config['blog_sidebar'] == 'full-width' ? 'selected="selected"' : ""); ?>><?php esc_html_e('Full Width', THEME_OPTIONS_DOMAIN); ?></option>
        </select>
      </td>
    </tr>
    <!-- End Sidebar -->

    <!-- Post row -->
    <tr>
      <th scope="row">
        <label for="theme_options_post_row">
          <?php esc_html_e('Post Row', THEME_OPTIONS_DOMAIN); ?>
        </label>
      </th>
      <td>
        <?php

        ?>
        <select id="theme_options_post_row" name="theme_options_post_row">
          <option value="1" <?php echo ($theme_options_config['post_row'] == '1' ? 'selected="selected"' : ""); ?>><?php esc_html_e('1', THEME_OPTIONS_DOMAIN); ?></option>
          <option value="2" <?php echo ($theme_options_config['post_row'] == '2' ? 'selected="selected"' : ""); ?>><?php esc_html_e('2', THEME_OPTIONS_DOMAIN); ?></option>
          <option value="3" <?php echo ($theme_options_config['post_row'] == '3' ? 'selected="selected"' : ""); ?>><?php esc_html_e('3', THEME_OPTIONS_DOMAIN); ?></option>
          <option value="4" <?php echo ($theme_options_config['post_row'] == '4' ? 'selected="selected"' : ""); ?>><?php esc_html_e('4', THEME_OPTIONS_DOMAIN); ?></option>
        </select>
      </td>
    </tr>
    <!-- End Post row -->
  </tbody>
</table>