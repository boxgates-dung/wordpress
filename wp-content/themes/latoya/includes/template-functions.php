<?php

/**
 * Get page id
 *
 * @return int $page_id Page id
 */
function latoya_get_page_id()
{
  $page_id = get_queried_object_id();

  if (class_exists('woocommerce')) {
    if (is_shop()) {
      $page_id = get_option('woocommerce_shop_page_id');
    } elseif (is_product_category()) {
      $page_id = false;
    }
  }

  return $page_id;
}

/**
 * Check Elementor active
 *
 * @return bool
 */
function latoya_is_elementor_activated()
{
  return defined('ELEMENTOR_VERSION');
}

/**
 * Detect Elementor Page editor with current page
 *
 * @param int $page_id The page id.
 *
 * @return     bool
 */
function latoya_is_elementor_page($page_id = false)
{
  if (!latoya_is_elementor_activated()) {
    return false;
  }

  if (!$page_id) {
    $page_id = latoya_get_page_id();
  }

  $is_elementor_page = get_post_meta($page_id, '_elementor_edit_mode', true);
  $is_elementor_page = 'builder' === $is_elementor_page ? true : false;

  // Priority first.
  if (in_array(get_post_type($page_id), array('hf_builder', 'mega_menu'), true)) {
    return $is_elementor_page;
  }

  if (!$page_id || is_tax() || is_singular('product')) {
    $is_elementor_page = false;
  }

  return $is_elementor_page;
}

/**
 * Pagination layout
 * @param array  $args {
 *     (Optional) Array of arguments for generating paginated links for archives.
 *
 *     @type string $base               Base of the paginated url. Default empty.
 *     @type string $format             Format for the pagination structure. Default empty.
 *     @type int    $total              The total amount of pages. Default is the value WP_Query's
 *                                      `max_num_pages` or 1.
 *     @type int    $current            The current page number. Default is 'paged' query var or 1.
 *     @type string $aria_current       The value for the aria-current attribute. Possible values are 'page',
 *                                      'step', 'location', 'date', 'time', 'true', 'false'. Default is 'page'.
 *     @type bool   $show_all           Whether to show all pages. Default false.
 *     @type int    $end_size           How many numbers on either the start and the end list edges.
 *                                      Default 1.
 *     @type int    $mid_size           How many numbers to either side of the current pages. Default 2.
 *     @type bool   $prev_next          Whether to include the previous and next links in the list. Default true.
 *     @type bool   $prev_text          The previous page text. Default '&laquo;'.
 *     @type bool   $next_text          The next page text. Default '&raquo;'.
 *     @type string $type               Controls format of the returned value. Possible values are 'plain',
 *                                      'array' and 'list'. Default is 'array'.
 *     @type array  $add_args           An array of query args to add. Default false.
 *     @type string $add_fragment       A string to append to each link. Default empty.
 *     @type string $before_page_number A string to appear before the page number. Default empty.
 *     @type string $after_page_number  A string to append after the page number. Default empty.
 *     @type string $screen_reader_text Screen reader text for the nav element. Default 'Posts navigation'.
 * }
 * @param string $class                 (Optional) Classes to be added to the <ul> element. Default 'pagination'.
 */
function posts_pagination($args = array(), $class = 'posts-pagination')
{

  if (!$GLOBALS['wp_query'] instanceof WP_Query || (!isset($args['total']) && $GLOBALS['wp_query']->max_num_pages <= 1)) {
    return;
  }

  $args = wp_parse_args(
    $args,
    array(
      'mid_size'           => 2,
      'prev_next'          => true,
      'prev_text'          => _x('<i class="fa-solid fa-angle-left"></i>', 'previous set of posts', LATOYA_THEME_DOMAIN),
      'next_text'          => _x('<i class="fa-solid fa-angle-right"></i>', 'next set of posts', LATOYA_THEME_DOMAIN),
      'current'            => max(1, get_query_var('paged')),
      'screen_reader_text' => __('Posts navigation', LATOYA_THEME_DOMAIN),
    )
  );

  // Make sure we always get an array.
  $args['type'] = 'array';

  /**
   * Array of paginated links.
   *
   * @var array<int,string>
   */
  $links = paginate_links($args);
  if (empty($links)) {
    return;
  }

  echo '<nav aria-labelledby="posts-nav-label">';
  echo '<h2 id="posts-nav-label" class="screen-reader-text">' . esc_html($args['screen_reader_text']) . '</h2>';
  echo '<ul class="' . esc_attr($class) . '">';
  foreach ($links as $link) {
    $search  = array('page-numbers', 'dots');
    $replace = array('page-link', 'disabled dots');

    echo '<li class="page-item ' . (strpos($link, 'current') ? 'active' : '') . '">' . str_replace($search, $replace, $link) . '</li>';
  }
  echo '</ul>';
  echo '</nav>';
}