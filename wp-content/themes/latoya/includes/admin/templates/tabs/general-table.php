<table id="general-table" class="form-table" role="presentation">
  <tbody>
    <!-- Enable back to Config -->
    <tr>
      <th scope="row">
        <label for="theme_options_back_to_top_button">
          <?php esc_html_e('Show button back to top', THEME_OPTIONS_DOMAIN); ?>
        </label>
      </th>
      <td>
        <label for="theme_options_back_to_top_button">
          <input name="theme_options_back_to_top_button" id="theme_options_back_to_top_button" type="checkbox" <?php echo $theme_options_config['back_to_top_button'] == 1 ? 'value="1" checked="checked"' : 'value="1"';?>>
          <?php esc_html_e('Enable button back to top', THEME_OPTIONS_DOMAIN); ?>
        </label>
      </td>
    </tr>
    <!-- End Header Config -->

    <!-- Background back to Config -->
    <!-- <tr>
      <th scope="row">
        <label for="background_back_to_top_button">
          <?php esc_html_e('Background button back to top', THEME_OPTIONS_DOMAIN); ?>
        </label>
      </th>
      <td>
        <input type="color" id="background_back_to_top_button" name="background_back_to_top_button" value="#ff0000">
      </td>
    </tr> -->
    <!-- End Background back to Config -->
  </tbody>
</table>