<?php

/**
 * Latoya Product Ajax Search Class
 *
 * @package Product Ajax Search
 */

defined('ABSPATH') || exit;

class Product_Ajax_Search
{
  public static $instance;

  public static function get_instance()
  {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function __construct()
  {
    add_shortcode('product_search_form', [$this, 'product_search_form']);
    add_action('wp_footer', [$this, 'product_search_form_script']);

    add_action('wp_ajax_ajax_search_products', [$this, 'ajax_search_products']);
    add_action('wp_ajax_nopriv_ajax_search_products', [$this, 'ajax_search_products']);
  }

  /**
   * Product search form
   * 
   */
  public function product_search_form()
  {
    $args = array(
      'taxonomy'     => 'product_cat',
      'orderby'      => 'name',
      'show_count'   => 0,
      'pad_counts'   => 0,
      'hierarchical' => 1,
      'title_li'     => '',
      'hide_empty'   => true
    );
    $product_cats = get_categories($args);

    echo '<form action="' . esc_url(get_home_url()) . '" data-ajax_action="' . esc_url(admin_url('admin-ajax.php')) . '" method="get" class="search-form ajax-search show-category">';
    echo '<div class="form-group">';
    echo '<div class="input-group">';

    echo '<div class="select-category order-3 w-100">';
    echo '<select name="product_cat" class="latoya-dropdown dropdown_product_cat border-0 rounded-0 position-relative">';
    echo '<option value="" selected="selected">' . __('All Categories', LATOYA_THEME_DOMAIN) . '</option>';
    foreach ($product_cats as $cat) {
      echo '<option class="level-0" value="' . $cat->slug . '">' . $cat->name . '&nbsp;&nbsp;(' . $cat->count . ')</option>';
    }
    echo '</select>';
    echo '</div>';

    echo '<button type="submit" class="button-search btn btn-sm border-0 shadow-none>"><i class="tb-icon tb-icon-search-normal"></i></button>';
    echo '<input type="text" placeholder="' . __('Search in 20.000+ products...', LATOYA_THEME_DOMAIN) . '" name="s" required="" class="form-control input-sm border-0 px-1 shadow-none" autocomplete="off">';
    echo '<input type="hidden" name="post_type" value="product" class="post_type">';

    echo '<div class="search-results-wrapper"> <div class="search-results position-absolute bg-white d-none"> </div></div>';
    echo '</div>';
    echo '</div>';
    echo '</form>';
  }

  /**
   * Script action product search form
   * 
   */
  public function product_search_form_script()
  {
?>
    <script type="application/javascript">
      jQuery(document).ready(function($) {
        /**
         * Contains the searched product
         * */
        const product_search_cache = {}

        /**
         * @param search_key String
         * @param product_cat String
         * @param url_api String
         * @param action String
         * @param this_form element
         * @return html string
         * */
        function product_search_ajax(search_key, product_cat, url_api, action, this_form) {
          if (search_key.length > 1) {
            this_form.find('.search-results').removeClass('d-none')
            let obj_key = search_key + product_cat
            if (obj_key in product_search_cache) {
              this_form.find('.search-results').html(product_search_cache[obj_key])
            } else {
              $.ajax({
                url: url_api,
                method: 'GET',
                dataType: 'json',
                data: {
                  action: action,
                  s: search_key,
                  cat: product_cat,
                },
                beforeSend: function() {
                  this_form.addClass('loading')
                },
                success: function(data) {
                  const html = data.data
                  this_form.removeClass('loading')
                  product_search_cache[obj_key] = html
                  this_form.find('.search-results').html(html)
                },
                error: function(xhr) {
                  this_form.removeClass('loading')
                  console.log(xhr)
                },
              })
            }
          } else {
            this_form.find('.search-results').addClass('d-none').html('')
          }
        }

        /**
         * Action product search ajax
         * */
        let globalTimeout = null
        $('.search-form.ajax-search input[type="text"]').keyup(function() {
          const _self = $(this)
          const this_form = _self.parents('form')
          const search_key = _self.val()
          const url_api = this_form.data('ajax_action')
          const action = 'ajax_search_products'
          const product_cat = this_form.find('select[name="product_cat"]').val()

          if (globalTimeout != null) {
            clearTimeout(globalTimeout)
          }
          globalTimeout = setTimeout(function() {
            globalTimeout = null

            product_search_ajax(
              search_key,
              product_cat,
              url_api,
              action,
              this_form
            )
          }, 200)
        })

        $('.search-form.ajax-search select[name="product_cat"]').change(function() {
          const _this_form = $(this).parents('.search-form')
          const search_form_input = _this_form.find('input[name="s"]')
          const keywork = search_form_input.val()
          search_form_input.val(keywork).trigger('keyup')
        })

        $('.search-form.ajax-search input[type="text"], .search-results').click(
          function() {
            $('.search-results').removeClass('d-none')
          }
        )

        $(document).mouseup(function(e) {
          let container = $('.search-results, .latoya-dropdown-wrap .select-box')

          // If the target of the click isn't the container
          if (!container.is(e.target) && container.has(e.target).length === 0) {
            $('.search-results').addClass('d-none')
          }
        })
      })
    </script>
<?php
  }

  public function ajax_search_products()
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
}

Product_Ajax_Search::get_instance();