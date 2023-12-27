<?php

class CPT_Column_View
{
  public static $instance;
  public $post_type = 'sanpham';

  public static function get_instance()
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function __construct()
  {
    // Add Post Thumbnail support
    add_theme_support('post-thumbnails');

    // Add styles to control column width
    add_action('admin_head', [$this, 'styles']);

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
            $permalink  = get_edit_post_link();
            $thumb      = get_the_post_thumbnail_url(null, 'thumbnail');

            echo '<a href="' . $permalink . '"><img src="' . $thumb . '" style="width:70px"></a>';
          } else {
            echo 'Your theme doesn\'t support featured image…';
          }

          break;
      }
    } else {
      return $theme_columns;
    }
  }

  public function styles()
  {
    echo '<style>
      .fixed #featured_thumb {
        width:120px;
      }
  
      .featured_thumb img {
        width: 70px;
        aspect-ratio: 1/1;
        object-fit: cover;
      }
    </style>';
  }
}

CPT_Column_View::get_instance();
