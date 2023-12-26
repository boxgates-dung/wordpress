<?php
class Custom_Post_Type_Display_Admin
{
  public static $instance;
  public $post_type = 'test';

  public static function  get_instance()
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  public function __construct()
  {
    // Add Post Thumbnail support
    add_theme_support('post-thumbnails');

    // Add styles to control column width
    add_action('admin_head', function () {
      echo '<style>
        .fixed #featured_thumb {
          width:10%
        }
      </style>';
    });

    // Add the posts and pages columns filter. They both use the same function.
    add_filter('manage_posts_columns', [$this, 'add_post_column'], 2);
    add_filter('manage_pages_columns', [$this, 'add_post_column'], 2);

    // Manage Post and Page Admin Panel Columns
    add_action('manage_posts_custom_column', [$this, 'show_post_column'], 5, 2);
    add_action('manage_pages_custom_column', [$this, 'show_post_column'], 5, 2);
  }

  // Add the column
  public function add_post_column($columns)
  {
    // Check if post type is 'Product'
    global $pagenow, $typenow;
    if ($this->post_type === $typenow && 'edit.php' === $pagenow) {


      $new = array();
      foreach ($columns as $key => $title) {
        if ($key == 'title') // Put the Thumbnail column before the Author column
        {
          $new['featured_thumb'] = __('Featured Image');
        }

        $new[$key] = $title;
      }
      return $new;
    } else {
      return $columns;
    }
  }

  // Get featured-thumbnail size post thumbnail and display it
  public function show_post_column($theme_columns, $theme_id)
  {

    // Check if post type is 'Product'
    global $pagenow, $typenow;
    if ($this->post_type === $typenow && 'edit.php' === $pagenow) {


      switch ($theme_columns) {
        case 'featured_thumb':
          if (function_exists('the_post_thumbnail')) {

            $permalink = get_edit_post_link();

            $thumb = get_the_post_thumbnail_url(null, 'thumbnail');

            echo '<a href="' . $permalink . '"><img src="' . $thumb . '" style="width:80px"></a>';
          } else {
            echo 'Your theme doesn\'t support featured image…';
          }

          break;
      }
    } else {


      return $theme_columns;
    }
  }
}

Custom_Post_Type_Display_Admin::get_instance();
