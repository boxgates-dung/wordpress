<?php
/**
 * Product ajax search
 * */ 
add_action('wp_ajax_ajax_search_products', 'ajax_search_products');
add_action('wp_ajax_nopriv_ajax_search_products', 'ajax_search_products');
function ajax_search_products()
{
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $search_keyword   = (isset($_GET['s'])) ? esc_attr($_GET['s']) : '';
    $product_cat  = (isset($_GET['cat'])) ? esc_attr($_GET['cat']) : '';

    global $woocommerce;
    $ordering_args = $woocommerce->query->get_catalog_ordering_args('title', 'asc');

    $args = array(
      's'                   => esc_attr($search_keyword),
      'posts_per_page'      => 6,
      'post_type'           => 'product',
      'post_status'         => 'publish',
      'suppress_filters'    => false,
      'ignore_sticky_posts' => 1,
      'orderby'             => $ordering_args['orderby'],
      'order'               => $ordering_args['order'],
      'meta_query'          => array(
        array(
          'compare' => 'LIKE'
        )
      )
    );

    if (isset($product_cat) && !empty($product_cat)) {
      $args['tax_query'] = array(
        'relation'   => 'AND',
        array(
          'taxonomy' => 'product_cat',
          'field'    => 'slug',
          'terms'    => array($product_cat), // @Param is array
        )
      );
    }

    $products_query = new WP_Query($args);

    $output = '';
    ob_start();

    if ($products_query->have_posts()) {
      echo '<div class="suggestion-products">';
      echo '<div class="suggestion-header">';
      echo '<span><span class="count">' . $products_query->post_count . '</span>' . __('results found with', LATOYA_THEME_DOMAIN) . '<span class="keywork">"' . $search_keyword . '"</span></span>';
      echo '</div>';

      while ($products_query->have_posts()) {
        $products_query->the_post();

        echo '<div class="suggestion-item" data-index="' . $products_query->current_post . '">';
        echo '<div class="suggestion-thumb">';
        echo '<a href="' . get_the_permalink() . '">' . get_the_post_thumbnail(null, 'thumbnail') . '</a>';
        echo '</div>';
        echo '<div class="suggestion-content">';
        echo '<div class="suggestion-title"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></div>';
        echo '<div class="suggestion-price">' . wc_price(get_post_meta(get_the_ID(), '_price', true)) . '</div>';
        echo '</div>';
        echo '</div>';
      }
      echo '</div>';
    } else {
      echo '<div class="suggestion-products"><div class="suggestion-header no-found-msg">' . __('No products found.', LATOYA_THEME_DOMAIN) . '</div></div>';
    }

    $output = ob_get_contents();
    ob_clean();
    ob_end_flush();

    wp_send_json_success($output);
    wp_die();
  }
}
