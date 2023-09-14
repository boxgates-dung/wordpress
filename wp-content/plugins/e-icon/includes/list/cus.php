<?php

namespace Eicon\List;

require_once E_PLUGIN_DIR . 'models/list-model.php';
require_once E_PLUGIN_DIR . 'utils/validate-email.php';

use Eicon\Models\ListModel;
use Eicon\Utils\ValidateEmail;

class cus
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
    // Add
    add_action('wp_ajax_add_item_x', [$this, 'add']);
  }

  public function add()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email      = $_POST['email'] ?? '';
      $phone      = $_POST['phone'] ?? '';
      $first_name = $_POST['first_name'] ?? '';
      $last_name  = $_POST['last_name'] ?? '';
      $avatar     = $_POST['avatar'] ?? '';
      $age        = (int)$_POST['age'] ?? 0;
      $gender     = (int)$_POST['gender'] ?? 0;
      $location   = $_POST['location'] ?? '';
      $desc       = $_POST['desc'] ?? '';
      $note       = $_POST['note'] ?? '';
      $url        = $_POST['url'] ?? '';
      $status     = (int)$_POST['status'] ?? 0;

      // $result = ListModel::get_instance()->insert(array(
      //   'email'       => $email,
      //   'phone'       => $phone,
      //   'first_name'  => $first_name,
      //   'last_name'   => $last_name,
      //   'avatar'      => $avatar,
      //   'age'         => $age,
      //   'gender'      => $gender,
      //   'location'    => $location,
      //   'desc'        => $desc,
      //   'note'        => $note,
      //   'url'         => $url,
      //   'status'      => $status,
      // ));

      $em = ValidateEmail::get_instance()->validate($email);



      if (true) {
        wp_send_json_success(array(
          'msg'       => 'User is added',
          'email'       => $email,
          'first_name'  => $first_name,
          'last_name'   => $last_name,
          'avatar'      => $avatar,
          'age'         => $age,
          'gender'      => $gender,
          'location' => $location,
          'desc' => $desc,
          'note' => $note,
          'url' => $em,
          // 'status' => $result,
        ));
        die();
      } else {
      }
    }
  }
}
