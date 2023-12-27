<?php

class Metabox_Demo
{
  public static $instance;
  public $id            = 'metabox-edit';
  public $title         = 'Edit';
  public $post_type     = 'sanphamss';
  public $context       = 'normal'; // "normal", "side"
  public $priority      = 'high'; // "high"
  public $verify_nonce  = 'save_thongtin';

  // Field
  public $field_number;

  public static function get_instance()
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {
    add_action('add_meta_boxes', function () {
      add_meta_box($this->id, $this->title, [$this, 'callback'], $this->post_type, $this->context, $this->priority);
    });

    add_action('save_post', [$this, 'save']);
  }

  public function callback($post)
  {
    wp_nonce_field($this->verify_nonce, $this->verify_nonce);

    echo '<link href="https://cdn.jsdelivr.net/npm/grapesjs@0.14.52/dist/css/grapes.min.css" rel="stylesheet" />';
    echo '<script src="https://cdn.jsdelivr.net/combine/npm/grapesjs@0.14.52,npm/grapesjs-mjml@0.0.31/dist/grapesjs-mjml.min.js"></script>';

    // echo '
    // <div id="gjs" style="max-height:calc(100vh - 56px); height:0; width:100%; overflow:hidden">
    //   <mjml>
    //     <mj-body>
    //       <mj-container>
    //         <mj-section background-color="#f0f0f0">
    //           <mj-column>
    //             <mj-text font-size="50" color="#626262">
    //               MJML
    //             </mj-text>
    //           </mj-column>
    //         </mj-section>
    //       </mj-container>
    //     </mj-body>
    //   </mjml>
    // </div>
    // ';
?>
    <script type="text/javascript">
      jQuery(document).ready(function($) {

        // -- SETUP
        var editor = grapesjs.init({
          height: '500px',
          container: '#gjs',
          fromElement: true,
          storageManager: {
            id: 'gjs-', // Prefix identifier that will be used on parameters
            type: 'local', // Type of the storage
            autosave: true, // Store data automatically
            autoload: true, // Autoload stored data on init
            stepsBeforeSave: 1, // If autosave enabled, indicates how many changes are necessary before store method is triggered
          },
          plugins: [
            'grapesjs-mjml'
          ],
          pluginsOpts: {
            'grapesjs-mjml': {
              resetDevices: false // so we can use the device buttons
            }
          }
        });

        // ---- Save Button
        editor.Panels.addButton('options', {
          id: 'save-db',
          className: 'fa fa-floppy-o',
          command: (editor, sender) => {
            sender && sender.set('active'); // turn off the button
            editor.store()
          },
          attributes: {
            title: 'Save DB'
          }
        });

        // save additional data to grapesjs storage
        editor.on('storage:start:store', (objectToStore) => {
          // check if we use mjml plugin
          if (editor.getConfig().plugins.includes('grapesjs-mjml')) {
            // save converted html from mjml
            // see LocalStorage on what is saved.
            objectToStore.mjml = editor.runCommand('mjml-get-code').html;
          }
        });


        editor.addComponents(`<div>
          <span data-gjs-type="custom-component" data-gjs-prop="someValue" title="foo">
            Hello!
          </span>
        </div>`);

      })
    </script>
<?php



  }

  public function save($post_id)
  {
    $conditional_nonce = $_POST[$this->verify_nonce];
    // Checks if the nonce has not been assigned a value
    if (!isset($conditional_nonce)) {
      return;
    }
    // Check nonce if not match
    if (!wp_verify_nonce($conditional_nonce, $this->verify_nonce)) {
      return;
    }

    // Save data
    $link_download = sanitize_text_field($_POST['link_download']);
    update_post_meta($post_id, '_link_download', $link_download);
  }
}

Metabox_Demo::get_instance();
