<?php

class Metabox_Demo
{
  public static $instance;
  public $id            = 'demo-meta';
  public $title         = 'Demo metabox';
  public $post_type     = 'test';
  public $position      = 'side'; // "normal", "side"
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
      add_meta_box($this->id, $this->title, [$this, 'callback'], $this->post_type, $this->position);
    });

    add_action('save_post', [$this, 'save']);
  }

  public function callback($post)
  {
    $link_download = get_post_meta($post->ID, '_link_download', true);
    wp_nonce_field($this->verify_nonce, $this->verify_nonce);
    // Tạo trường Link Download
    echo ('<label for="link_download">Link Download: </label>');
    echo ('<input type="text" id="link_download" name="link_download" value="' . esc_attr($link_download) . '" />');

    echo ('
    <select name="wc_order_action">
			<option value="">Choose an action...</option>
			<option value="send_order_details">Email invoice / order details to customer</option>
      <option value="send_order_details_admin">Resend new order notification</option>
			<option value="regenerate_download_permissions">Regenerate download permissions</option>
		</select>
    ');
  }

  public function save($post_id)
  {
    $conditional_nonce = $_POST[$this->verify_nonce];
    // Checks if the nonce has not been assigned a value
    if( !isset( $conditional_nonce ) ) {
     return;
    }
    // Check nonce if not match
    if( !wp_verify_nonce( $conditional_nonce, $this->verify_nonce ) ) {
     return;
    }
   
    // Save data
    $link_download = sanitize_text_field( $_POST['link_download'] );
    update_post_meta( $post_id, '_link_download', $link_download );
  }
}

Metabox_Demo::get_instance();
