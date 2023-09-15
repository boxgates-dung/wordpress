<?php

namespace WPEmailMarketing\Models;
require_once WP_EMAIL_MARKETING_PLUGIN_PATH . '/utilities/validate-email.php';
use WPEmailMarketing\Utilities\ValidateEmail;

class SubcriberModel
{
  protected $wpdb;
  protected $table_name;

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
    global $wpdb;

    $this->wpdb = $wpdb;
    $this->table_name = $wpdb->prefix . 'abc_table';
    $this->_init_table();
  }

  protected function _init_table(): void
  {
    $charset_collate = $this->wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $this->table_name (
      `id` INT NOT NULL AUTO_INCREMENT,
      `email` VARCHAR(255) NOT NULL,
      `phone` VARCHAR(255),
      `first_name` VARCHAR(255),
      `last_name` VARCHAR(255),
      `avatar` VARCHAR(255),
      `age` INT NOT NULL DEFAULT 0,
      `gender` INT NOT NULL DEFAULT 0,
      `location` VARCHAR(255),
      `desc` TEXT,
      `note` TEXT,
      `url` VARCHAR(255) DEFAULT '' NOT NULL,
      `status` INT NOT NULL DEFAULT 0,
      `date_added` DATETIME NOT NULL DEFAULT NOW() ,
      PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }

  public function insert($args = array()): int
  {
    // Set the new timezone
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = date('d-m-y h:i:s');

    if (isset($args) && ValidateEmail::get_instance()->validate($args['email'])) {

      $result = $this->wpdb->insert(
        $this->table_name,
        array(
          'email'       => $args['email'],
          'phone'       => $args['phone'],
          'first_name'  => $args['first_name'],
          'last_name'   => $args['last_name'],
          'avatar'      => $args['avatar'],
          'age'         => $args['age'],
          'gender'      => $args['gender'],
          'location'    => $args['location'],
          'desc'        => $args['desc'],
          'note'        => $args['note'],
          'url'         => $args['url'],
          'status'      => $args['status'],
          'date_added'  => $date
        )
      );
      
      $this->wpdb->flush();
      return $result;
    } else {
      return 0;
    }
  }

  public function update($args = array(), $condition): void
  {
    $result = $this->wpdb->update(
      $this->table_name,
      array(
        'first_name'  => $args['first_name'],
      ),
      array('officerId' => $condition),
      array('%d', '%s', '%s', '%s'),
      array('%d')
    );

    if ($result > 0) {
      echo "Successfully Updated";
    } else {
      exit(var_dump($this->wpdb->last_query));
    }
    $this->wpdb->flush();
  }

  public function get_all(): void
  {
  }

  public function filter(): void
  {
  }

  public function delete($id): void
  {
    $this->wpdb->delete($this->table_name, array('id' => $id));
    $this->wpdb->flush();
  }
}
