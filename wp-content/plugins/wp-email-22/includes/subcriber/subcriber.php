<?php

namespace WPEmailMarketing\Includes;

require_once WP_EMAIL_MARKETING_PLUGIN_PATH . '/models/subcriber.php';
require_once WP_EMAIL_MARKETING_PLUGIN_PATH . '/utilities/validate-email.php';

use WPEmailMarketing\Models\SubcriberModel;

class Subcriber
{
  public static function get_instance(): static
  {
    static $instance = null;

    if ($instance === null) {
      $instance = new static();
    }

    return $instance;
  }

  public function __construct()
  {
    add_action('wp_ajax_add_new_subcriber', [$this, 'add']);
    add_action('admin_menu', [$this, 'add_subscribers_menu']);
  }

  public function add()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $result = SubcriberModel::get_instance()->insert(array(
        'email'       => $_POST['email'] ?? '',
        'phone'       => $_POST['phone'] ?? '',
        'first_name'  => $_POST['first_name'] ?? '',
        'last_name'   => $_POST['last_name'] ?? '',
        'avatar'      => $_POST['avatar'] ?? '',
        'age'         => (int)$_POST['age'] ?? 0,
        'gender'      => (int)$_POST['gender'] ?? 0,
        'location'    => $_POST['location'] ?? '',
        'desc'        => $_POST['desc'] ?? '',
        'note'        => $_POST['note'] ?? '',
        'url'         => $_POST['url'] ?? '',
        'status'      => (int)$_POST['status'] ?? 0,
      ));

      if ($result) {
        wp_send_json_success(array('msg' => 'User is added'));
        die();
      } else {
        wp_send_json_error(array('msg' => 'Added user Error'));
        die();
      }
    }
  }

  public function add_subscribers_menu(): void
  {
    add_submenu_page(
      'edit.php?post_type=email_campaign',
      'Submenu title',
      'Submenu',
      'manage_options',
      'email_subscribers',
      function () {
        require WP_EMAIL_MARKETING_PLUGIN_PATH . 'templates/subscribers/index.php';
      },
      5
    );
  }
}
