<?php
add_action('wp_ajax_latoya_product_search', 'latoya_product_search');
add_action('wp_ajax_nopriv_latoya_product_search', 'latoya_product_search');
function latoya_product_search()
{
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $search_key   = (isset($_GET['search_key'])) ? esc_attr($_GET['search_key']) : '';
    $product_cat  = (isset($_GET['product_cat'])) ? esc_attr($_GET['product_cat']) : '';

    $products = wc_get_products([
      'page' => 1
    ]);
  
    $output = '';
    ob_start();
  
    if ($products) {
      echo '<div class="suggestion-header"><span><span class="count">' . count($products) . '</span> results found with <span class="keywork">"'.$search_key.'"</span></span></div>';
  
      foreach ($products as $index => $product) {
        echo '<div class="autocomplete-suggestion" data-index="' . $index . '">';
        echo '<div class="suggestion-thumb">';
        echo '<a href="' . $product->get_permalink() . '">' . $product->get_image('thumbnail') . '</a>';
        echo '</div>';
        echo '<div class="suggestion-content">';
        echo '<div class="suggestion-title"><a href="' . $product->get_permalink() . '">' . $product->get_title() . '</a></div>';
        echo '<div class="suggestion-price">' . $product->get_price_html() . '</div>';
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo '<div class="suggestion-title no-found-msg">No products found.</div>';
    }
  
    $output = ob_get_contents();
    ob_clean();
    ob_end_flush();
  
    wp_send_json_success($output);
    wp_die();
  }
}




function ajax_search_products() {
  global $woocommerce;

  $search_keyword =  $_REQUEST['query'];

  $ordering_args = $woocommerce->query->get_catalog_ordering_args( 'title', 'asc' );
  $suggestions   = array();

  $args = array(
      's'                   => apply_filters( 'yith_wcas_ajax_search_products_search_query', $search_keyword ),
      'post_type'           => 'product',
      'post_status'         => 'publish',
      'ignore_sticky_posts' => 1,
      'orderby'             => $ordering_args['orderby'],
      'order'               => $ordering_args['order'],
      'posts_per_page'      => apply_filters( 'yith_wcas_ajax_search_products_posts_per_page', get_option( 'yith_wcas_posts_per_page' ) ),
      'suppress_filters'    => false,
      'meta_query'          => array(
          array(
              'key'     => '_visibility',
              'value'   => array( 'search', 'visible' ),
              'compare' => 'LIKE'
          )
      )
  );

  if ( isset( $_REQUEST['product_cat'] ) ) {
      $args['tax_query'] = array(
          'relation' => 'AND',
          array(
              'taxonomy' => 'product_cat',
              'field'    => 'slug',
              'terms'    => $_REQUEST['product_cat']
          ) );
  }

  $products = get_posts( $args );

  if ( !empty( $products ) ) {
      foreach ( $products as $post ) {
          $product = wc_get_product( $post );

          $suggestions[] = apply_filters( 'yith_wcas_suggestion', array(
              'id'    => $product->id,
              'value' => strip_tags($product->get_title()),
              'url'   => $product->get_permalink()
          ), $product );
      }
      
  }
  else {
      $suggestions[] = array(
          'id'    => - 1,
          'value' => __( 'No results', 'yith-woocommerce-ajax-search' ),
          'url'   => '',
      );
  }
  wp_reset_postdata();

  $suggestions = array(
      'suggestions' => $suggestions
  );

}