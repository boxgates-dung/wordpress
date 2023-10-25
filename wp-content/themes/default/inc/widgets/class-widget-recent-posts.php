<?php

/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class Theme_Widget_Recent_Posts extends WP_Widget
{

  function __construct()
  {
    $widget_ops = array('classname' => 'widget_recent_posts', 'description' => __("The most recent posts on your site"));
    parent::__construct('recent-posts', __('Recent Posts'), $widget_ops);
    $this->alt_option_name = 'widget_recent_entries';

    add_action('save_post', array($this, 'flush_widget_cache'));
    add_action('deleted_post', array($this, 'flush_widget_cache'));
    add_action('switch_theme', array($this, 'flush_widget_cache'));
  }

  function widget($args, $instance)
  {
    $cache = wp_cache_get('widget_recent_posts', 'widget');

    if (!is_array($cache))
      $cache = array();

    if (!isset($args['widget_id']))
      $args['widget_id'] = $this->id;

    if (isset($cache[$args['widget_id']])) {
      echo $cache[$args['widget_id']];
      return;
    }

    ob_start();
    extract($args);

    $title  = (!empty($instance['title'])) ? $instance['title'] : __('Recent Posts');
    $title  = apply_filters('widget_title', $title, $instance, $this->id_base);
    $number = (!empty($instance['number'])) ? absint($instance['number']) : 10;
    if (!$number)
      $number = 10;
    $show_date = isset($instance['show_date']) ? $instance['show_date'] : false;

    $r = new WP_Query(apply_filters('widget_posts_args', array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true)));
    if ($r->have_posts()) {
      echo $before_widget;
      if ($title) echo $before_title . $title . $after_title;

      echo '<div class="posts-list">';
      while ($r->have_posts()) {
        $r->the_post();

        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnaill');
        if ($thumbnail) {
          $thumbnail = $thumbnail[0];
        } else {
          $thumbnail = THEME_URI . '/assets/images/empty-image.png';
        }

        echo '<div class="entry-brief">';
        echo '<div class="entry-media"><a href="' . get_the_permalink() . '"><img src="' . $thumbnail . '" alt="' . get_the_title() . '"></a></div>';
        echo '<div class="entry-content">';
        echo '<h4 class="entry-title"><a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h4>';
        echo $show_date ? '<div class="item-date">' . get_the_date() . '</div>' : '';
        echo '</div>';
        echo '</div>';
      };
      echo '</div>';
      echo $after_widget;

      // Reset the global $the_post as this query will have stomped on it
      wp_reset_postdata();
    };

    $cache[$args['widget_id']] = ob_get_flush();
    wp_cache_set('widget_recent_posts', $cache, 'widget');
  }

  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['number'] = (int) $new_instance['number'];
    $instance['show_date'] = (bool) $new_instance['show_date'];
    $this->flush_widget_cache();

    $alloptions = wp_cache_get('alloptions', 'options');
    if (isset($alloptions['widget_recent_entries']))
      delete_option('widget_recent_entries');

    return $instance;
  }

  function flush_widget_cache()
  {
    wp_cache_delete('widget_recent_posts', 'widget');
  }

  function form($instance)
  {
    $title     = isset($instance['title']) ? esc_attr($instance['title']) : '';
    $number    = isset($instance['number']) ? absint($instance['number']) : 5;
    $show_date = isset($instance['show_date']) ? (bool) $instance['show_date'] : false;
?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>

    <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
      <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
    </p>

    <p><input class="checkbox" type="checkbox" <?php checked($show_date); ?> id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" />
      <label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e('Display post date?'); ?></label>
    </p>
<?php
  }
}
