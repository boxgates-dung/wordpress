<?php
/**
 * Product Categories Widget
 *
 * @package WooCommerce\Widgets
 * @version 2.3.0
 */

//  'show_admin_column' => true

defined('ABSPATH') || exit;

/**
 * Product brand widget class.
 *
 * @extends WC_Widget
 */
class Widget_Product_Brands extends WC_Widget
{
  /**
   * Current Brand.
   *
   * @var bool
   */
  public $current_brand;

  /**
   * Constructor.
   */
  public function __construct()
  {
    $this->widget_cssclass    = 'woocommerce widget_product_brands';
    $this->widget_description = __('A list or dropdown of product brands.', 'woocommerce');
    $this->widget_id          = 'woocommerce_product_brands';
    $this->widget_name        = __('Product Brands', 'woocommerce');
    $this->settings           = array(
      'title'              => array(
        'type'  => 'text',
        'std'   => __('Product brands', 'woocommerce'),
        'label' => __('Title', 'woocommerce'),
      ),
      'orderby'            => array(
        'type'    => 'select',
        'std'     => 'name',
        'label'   => __('Order by', 'woocommerce'),
        'options' => array(
          'order' => __('Brand order', 'woocommerce'),
          'name'  => __('Name', 'woocommerce'),
        ),
      ),
      'count'              => array(
        'type'  => 'checkbox',
        'std'   => 0,
        'label' => __('Show product counts', 'woocommerce'),
      ),

      'hide_empty'         => array(
        'type'  => 'checkbox',
        'std'   => 0,
        'label' => __('Hide empty brands', 'woocommerce'),
      ),
    );

    parent::__construct();
  }

  /**
   * Output widget.
   *
   * @see WP_Widget
   * @param array $args     Widget arguments.
   * @param array $instance Widget instance.
   */
  public function widget($args, $instance)
  {
    global $wp_query, $post;

    $count              = isset($instance['count']) ? $instance['count'] : $this->settings['count']['std'];
    $orderby            = isset($instance['orderby']) ? $instance['orderby'] : $this->settings['orderby']['std'];
    $hide_empty         = isset($instance['hide_empty']) ? $instance['hide_empty'] : $this->settings['hide_empty']['std'];
    $list_args          = array(
      'show_count'  => $count,
      'taxonomy'    => 'product_brand',
      'hide_empty'  => $hide_empty,
      'menu_order'  =>  false,
    );

    if ('order' === $orderby) {
      $list_args['orderby']   = 'meta_value_num';
      $list_args['meta_key']  = 'order';
    }

    $this->current_brand  = false;

    if (is_tax('product_brand')) {
      $this->current_brand    = $wp_query->queried_object;
    }

    if (is_singular('product')) {
      $terms = wc_get_product_terms(
        $post->ID,
        'product_brand',
        array(
          'orderby' => 'parent',
          'order'   => 'DESC',
        )
      );

      if ($terms) {
        $this->current_brand  = $terms[0];
      }
    }

    // Render brands
    $this->widget_start($args, $instance);
    $terms  = get_terms($list_args);
    echo '<ul class="product-brands">';
    foreach ($terms as $term) {
      echo '<li class="brand-item brand-item-' . $term->term_id . ($this->current_brand->term_id ==  $term->term_id ? ' current-brand' : '') . '">';
      echo '<a href="' . get_term_link($term->slug, 'product_brand') . '">' . $term->name . '</a>';
      echo '</li>';
    }
    echo '</ul>';
    $this->widget_end($args);
  }
}

add_action('widgets_init', function () {
  register_widget('Widget_Product_Brands');
});
