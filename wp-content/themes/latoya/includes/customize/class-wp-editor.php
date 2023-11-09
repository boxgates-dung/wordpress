<?php
if (class_exists('WP_Customize_Control')) {
  class WP_Customize_TinyMCE_Control extends WP_Customize_Control
  {
    /**
     * The type of control being rendered
     */
    public $type = 'tinymce_editor';

    /**
     * Pass our TinyMCE toolbar config to JavaScript
     */
    public function to_json()
    {
      parent::to_json();

      $this->json['tinymce_toolbar1']      = isset($this->input_attrs['toolbar1']) ? esc_attr($this->input_attrs['toolbar1']) : 'bold italic bullist numlist alignleft aligncenter alignright link';
      $this->json['tinymce_toolbar2']      = isset($this->input_attrs['toolbar2']) ? esc_attr($this->input_attrs['toolbar2']) : '';
      $this->json['tinymce_media_buttons'] = isset($this->input_attrs['mediaButtons']) && ($this->input_attrs['mediaButtons'] === true) ? true : false;
      $this->json['tinymce_height']        = isset($this->input_attrs['height']) ? esc_attr($this->input_attrs['height']) : 200;
    }

    /**
     * Render the control in the customizer
     */
    public function render_content()
    {
?>
      <div class="tinymce-control">
        <span class="customize-control-title">
          <?php echo esc_html($this->label); ?>
        </span>

        <?php if (!empty($this->description)) { ?>
          <span class="customize-control-description">
            <?php echo esc_html($this->description); ?>
          </span>
        <?php }; ?>

        <textarea id="<?php echo esc_attr($this->id); ?>" class="customize-control-tinymce-editor" <?php $this->link(); ?>><?php echo esc_attr($this->value()); ?></textarea>
        <script>
          jQuery(document).ready(function($) {
            function tinyMCE_setup() {
              var tinyMCEToolbar1 = _wpCustomizeSettings.controls[$(this).attr('id')].tinymce_toolbar1;
              var tinyMCEToolbar2 = _wpCustomizeSettings.controls[$(this).attr('id')].tinymce_toolbar2;
              var tinyMCEMediaButtons = _wpCustomizeSettings.controls[$(this).attr('id')].tinymce_media_buttons;
              var tinyMCEheight = _wpCustomizeSettings.controls[$(this).attr('id')].tinymce_height;

              wp.editor.initialize($(this).attr('id'), {
                tinymce: {
                  wpautop: true,
                  plugins: 'charmap colorpicker hr lists paste tabfocus textcolor fullscreen wordpress wpautoresize wpeditimage wpemoji wpgallery wplink wptextpattern',
                  toolbar1: tinyMCEToolbar1,
                  toolbar2: tinyMCEToolbar2,
                  textarea_rows: 20,
                  height: tinyMCEheight
                },
                quicktags: {buttons: 'strong,em,link,block,del,ins,img,ul,ol,li,code,more,close'},
                mediaButtons: tinyMCEMediaButtons,
              });
            }

            function initialize_tinyMCE(event, editor) {
              editor.on('change', function() {
                tinyMCE.triggerSave();
                $("#".concat(editor.id)).trigger('change');
              });
            }

            $(document).on('tinymce-editor-init', initialize_tinyMCE);
            $('.customize-control-tinymce-editor').each(tinyMCE_setup);
          });
        </script>
      </div>
<?php
    }
  }
}
