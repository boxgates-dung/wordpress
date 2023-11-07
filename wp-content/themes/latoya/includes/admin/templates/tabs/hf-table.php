<table id="hf-table" class="form-table" role="presentation">
  <tbody>
    <!-- Top Header Config -->
    <tr>
      <th scope="row">
        <label for="theme_options_top_header_id"><?php esc_html_e('Top Header Template', THEME_OPTIONS_DOMAIN); ?></label>
      </th>
      <td>
        <select id="theme_options_top_header_id" name="theme_options_top_header_id">
          <option value="0"><?php esc_html_e('— Select —', THEME_OPTIONS_DOMAIN); ?></option>

          <?php
          $args = array(
            'posts_per_page'  => -1,
            'orderby'         => 'name',
            'order'           => 'ASC',
            'post_type'       => 'hf_builder',
          );
          $items = get_posts($args);

          foreach ($items as $item) {
            echo  '<option value="' . $item->ID . '" ' . ($theme_options_config['top_header_id'] == $item->ID ? 'selected="selected"' : "") . '  >' . $item->post_title . '</option>';
          }
          ?>
        </select>
        <p><?php esc_html_e('Add new top header', THEME_OPTIONS_DOMAIN); ?> <a href="/wp-admin/edit.php?post_type=hf_builder">template</a></p>
      </td>
    </tr>
    <!-- End Top Header Config -->

    <!-- Header Config -->
    <tr>
      <th scope="row">
        <label for="theme_options_header_id"><?php esc_html_e('Header Template', THEME_OPTIONS_DOMAIN); ?></label>
      </th>
      <td>
        <select id="theme_options_header_id" name="theme_options_header_id">
          <option value="0"><?php esc_html_e('— Select —', THEME_OPTIONS_DOMAIN); ?></option>

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
        <label for="theme_options_footer_id"><?php esc_html_e('Footer Template', THEME_OPTIONS_DOMAIN); ?></label>
      </th>
      <td>
        <select id="theme_options_footer_id" name="theme_options_footer_id">
          <option value="0"><?php esc_html_e('— Select —', THEME_OPTIONS_DOMAIN); ?></option>

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

        <p> <?php esc_html_e('Add new footer', THEME_OPTIONS_DOMAIN); ?> <a href="/wp-admin/edit.php?post_type=hf_builder">template</a></p>
      </td>
    </tr>
    <!-- End Footer Config -->

  </tbody>
</table>