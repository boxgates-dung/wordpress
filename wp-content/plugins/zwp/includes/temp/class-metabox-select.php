<?php

class Metabox_Select
{
  public static $instance;
  public $id            = 'metabox-select';
  public $title         = 'Select';
  public $post_type     = 'sanphamss';
  public $context       = 'normal'; // "normal", "side"
  public $priority      = 'default'; // "high"
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

Metabox_Select::get_instance();
