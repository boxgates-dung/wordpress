<?php
define("THEME_URL", get_template_directory_uri());
define("THEME_PATH", get_template_directory());
define("THEME_DOMAIN", 'elessi');

require_once 'elementor/elementor.php';

function setup_theme(): void
{
  load_theme_textdomain(THEME_DOMAIN, THEME_PATH . '/languages');
  add_theme_support('post-thumbnails');
  add_theme_support('woocommerce');
  set_post_thumbnail_size(800, 1022, true);
  register_nav_menus(
    array(
      'primary' => __('Primary', THEME_DOMAIN),
      'footer' => __('Footer Menu', THEME_DOMAIN),
      'social' => __('Social Links Menu', THEME_DOMAIN),
      'sidebar' => __('Sidebar', THEME_DOMAIN),

      'language'  => __('Language', THEME_DOMAIN),
      'currency'  => __('Currency', THEME_DOMAIN),
    )
  );
  add_theme_support('align-wide');
  add_theme_support(
    'custom-logo',
    array(
      'height' => 190,
      'width' => 190,
      'flex-width' => true,
      'flex-height' => true,
    )
  );
  // Add support for editor styles.
  add_theme_support('editor-styles');
  // Enqueue editor styles.
  add_editor_style('style-editor.css');
  remove_theme_support('widgets-block-editor');
}
add_action('after_setup_theme', 'setup_theme');

// Load styles và scripts
add_action('wp_enqueue_scripts', function () {
  //Remove Gutenberg Block Library CSS from loading on the frontend
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');

  if (is_singular('email')) {
    $allowScript = ['jquery', 'query-monitor', 'admin-bar'];
    $scripts = wp_scripts();
    foreach ($scripts->registered as $handle => $sciprt) {
      $isDequeue = false;
      if (strpos($handle, 'elementor') === false) {
        $isDequeue = true;
      }
      if (!$isDequeue && !in_array($handle, $allowScript)) {
        $isDequeue = false;
      }

      if ($isDequeue) {
        wp_dequeue_script($handle);
      }
    }

    wp_dequeue_style('woocommerce-layout');
    wp_dequeue_style('woocommerce-smallscreen');
    wp_dequeue_style('woocommerce-general');
    wp_dequeue_style('woocommerce-inline');
    wp_dequeue_style('wc-blocks-style');
    wp_dequeue_style('wc-blocks-vendors-style');
    wp_dequeue_style('yoast-seo-adminbar');
    wp_dequeue_style('wp-pagenavi');
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style('e-theme-ui-light');
    wp_dequeue_style('contact-form-7');
  } else {
    $version = filemtime(THEME_PATH . '/assets/public/js/app.min.js');
    wp_enqueue_style('fontawesome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css", [], $version);
    //wp_enqueue_style( 'fontawesome5', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css", [], $version);
    wp_enqueue_style(THEME_DOMAIN . '-vendor', THEME_URL . "/assets/public/css/vendors.css", [], $version);
    wp_enqueue_style(THEME_DOMAIN . '-theme', THEME_URL . "/assets/public/css/theme.css", [THEME_DOMAIN . '-vendor'], $version);
    wp_enqueue_style(THEME_DOMAIN . '-style', THEME_URL . "/style.css", [], $version);
    wp_enqueue_script(THEME_DOMAIN . '-app', THEME_URL . '/assets/public/js/app.min.js', ['jquery'], $version, true);

    //	wp_set_script_translations( THEME_DOMAIN . '-app', THEME_DOMAIN, THEME_PATH . '/languages' );
    wp_localize_script(THEME_DOMAIN . '-app', 'bgx', [
      'ajaxUrl' => admin_url('admin-ajax.php'),
      'isLogged' => is_user_logged_in(),
      'endPoint' => get_site_url() . '/wp-json', //'https://temafes.devboxgates.com/wp-json',
      'CONSUMER_KEY' => 'ck_aca56f578c18eaf60f6db8a5daefe4e1a371e752',
      'CONSUMER_SECRET' => 'cs_943d05b4da2cb4be57802336a5570d8bc97421af'
    ]);
  }
});

// Đăng ký một widget mới
add_action('widgets_init', function () {
  register_sidebar(array(
    'name'          => esc_html__('Blog sidebar', THEME_DOMAIN),
    'id'            => 'blog-sidebar',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ));

  register_sidebar(array(
    'name'          => esc_html__('Shop Sidebar', THEME_DOMAIN),
    'id'            => 'shop-sidebar',
    'description'   => esc_html__('Sidebar on shop page (only sidebar shop layout)', THEME_DOMAIN),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h4 class="widget-title"><span>',
    'after_title'   => '</span></h4>',
  ));

  register_sidebar(array(
    'name'          => esc_html__('Shop Top Sidebar', THEME_DOMAIN),
    'id'            => 'shop-top-sidebar',
    'description'   => esc_html__('Sidebar on shop page (only sidebar shop layout)', THEME_DOMAIN),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h4 class="widget-title"><span>',
    'after_title'   => '</span></h4>',
  ));
});

//add body class
add_filter('body_class', function ($classes) {
  $suffix = '-bgx';
  if (is_home()) {
    $classes[] = 'home' . $suffix;
  }
  if (is_page()) {
    global $post;
    // if(in_array($post->post_name, array('dang-nhap', 'dang-ky'))){
    // 	$classes[] = 'account' . $suffix;
    // }
    if ($post->post_name === 'shop') $classes[] = 'product' . $suffix;
    else {
      $classes[] = $post->post_name . $suffix;
    }
  }
  if (is_singular('product')) {
    $classes[] = 'single-product' . $suffix;
  }
  if (is_archive()) {
    $classes[] = 'product' . $suffix;
  }
  //	var_dump($classes);
  return $classes;
});

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
add_action('woocommerce_sidebar', function () {
  dynamic_sidebar('shop-sidebar');
}, 9, 1);

/** Register static page */
add_action('admin_init', function () {
  /**
   * Register size guide part
   * */
  register_setting(
    'reading',
    'theme_size_guide_part',
    [
      'type'              => 'string',
      'sanitize_callback' => 'sanitize_text_field',
      'default'           => NULL,
    ]
  );

  add_settings_field(
    'theme_size_guide_part',
    __('Size Guide', THEME_DOMAIN),
    function () {
      $staticId = get_option('theme_size_guide_part');
      $args = [
        'posts_per_page'  => -1,
        'orderby'         => 'name',
        'order'           => 'ASC',
        'post_type'       => 'elementor_library',
        'meta_query' => [
          [
            'key'   => '_elementor_template_type',
            'value' => 'section',
          ]
        ]
      ];

      $items = get_posts($args);
      echo '<select id="theme_size_guide_part" name="theme_size_guide_part">';
      echo '<option value="0">' . __('— Select —', THEME_DOMAIN) . '</option>';
      foreach ($items as $item) {
        $selected = ($staticId == $item->ID) ? 'selected="selected"' : '';
        echo '<option value="' . $item->ID . '" ' . $selected . '>' . $item->post_title . '</option>';
      }
      echo '</select>';
    },
    'reading',
    'default',
    array('label_for' => 'theme_size_guide_part')
  );

  /**
   * Register Delivery & Return part
   * */
  register_setting(
    'reading',
    'theme_delivery_return_part',
    [
      'type'              => 'string',
      'sanitize_callback' => 'sanitize_text_field',
      'default'           => NULL,
    ]
  );

  add_settings_field(
    'theme_delivery_return_part',
    __('Delivery & Return', THEME_DOMAIN),
    function () {
      $staticId = get_option('theme_delivery_return_part');
      $args = [
        'posts_per_page'  => -1,
        'orderby'         => 'name',
        'order'           => 'ASC',
        'post_type'       => 'elementor_library',
        'meta_query' => [
          [
            'key'   => '_elementor_template_type',
            'value' => 'section',
          ]
        ]
      ];

      $items = get_posts($args);
      echo '<select id="theme_delivery_return_part" name="theme_delivery_return_part">';
      echo '<option value="0">' . __('— Select —', THEME_DOMAIN) . '</option>';
      foreach ($items as $item) {
        $selected = ($staticId == $item->ID) ? 'selected="selected"' : '';
        echo '<option value="' . $item->ID . '" ' . $selected . '>' . $item->post_title . '</option>';
      }
      echo '</select>';
    },
    'reading',
    'default',
    array('label_for' => 'theme_delivery_return_part')
  );

  /**
   * Register Footer
   * */
  register_setting(
    'reading',
    'theme_footer',
    [
      'type'              => 'string',
      'sanitize_callback' => 'sanitize_text_field',
      'default'           => NULL,
    ]
  );

  add_settings_field(
    'theme_footer',
    __('Footer', THEME_DOMAIN),
    function () {
      $staticId = get_option('theme_footer');
      $args = [
        'posts_per_page'  => -1,
        'orderby'         => 'name',
        'order'           => 'ASC',
        'post_type'       => 'elementor-hf',
      ];

      $items = get_posts($args);
      echo '<select id="theme_footer" name="theme_footer">';
      echo '<option value="0">' . __('— Select —', THEME_DOMAIN) . '</option>';
      foreach ($items as $item) {
        $selected = ($staticId == $item->ID) ? 'selected="selected"' : '';
        echo '<option value="' . $item->ID . '" ' . $selected . '>' . $item->post_title . '</option>';
      }
      echo '</select>';
    },
    'reading',
    'default',
    array('label_for' => 'theme_footer')
  );
});

function bgx_get_static_template($staticName)
{
  $staticId = false;
  if (!is_singular('elementor_library')) {
    $staticId = get_option($staticName);
  }
  return $staticId;
}

// Test
add_action('wp_ajax_quickview', 'quick_view_callback');
add_action('wp_ajax_nopriv_quickview', 'quick_view_callback');

function quick_view_callback()
{
  $product_id = (isset($_GET['product_id'])) ? esc_attr($_GET['product_id']) : '';

  if (empty($product_id)) {
    echo '';
    wp_die();
  } else {
    $loop = new WP_Query(array('post_type' => 'product', 'p' => $product_id));
    while ($loop->have_posts()) {
      $loop->the_post();
      global $product;

      $attachment_ids = $product->get_gallery_image_ids();
      array_unshift($attachment_ids, get_post_thumbnail_id($product->get_id()));

      ob_start();
      // Render
      echo '<div id="quick_view">';
      echo '<div class="row">';
      echo '<div class="col-12 col-md-6"><!-- Product gallery -->';
      echo '<div class="product-gallery">';
      echo '<div class="swiper-wrapper">';
      foreach ($attachment_ids as $attachment_id) {
        echo '<div class="swiper-slide"><img src="' . esc_url(wp_get_attachment_image_url($attachment_id, 'full')) . '" alt="' . esc_attr($product->get_name()) . '"></div>';
      }
      echo '</div>';

      if (count($attachment_ids) > 1) {
        echo '<div class="button-next"></div>';
        echo '<div class="button-prev"></div>';
      }
      echo '<a href="' . get_permalink() . '" class="view-full">View More Details</a>';
      echo '</div>';
      echo '</div><!-- End product gallery -->';
      echo '<!-- Product summary --><div class="col-12 col-md-6">';
      echo '<div class="product_summary">';
      // do_action('woocommerce_single_product_summary');
      woocommerce_template_single_title();

      $brands = get_the_terms($product->get_ID(), 'product_brand');
      if (!is_wp_error($brands) && !empty($brands)) {
        echo '<div class="product-brands">';
        foreach ($brands as $brand) {
          $brandThumbnail = wp_get_attachment_image(get_term_meta($brand->term_id, 'product_brand_thumbnail', true), 'full');
          printf(
            '<a class="brand-item" title="%s" href="%s" rel="tag">%s</a>',
            $brand->name,
            get_term_link($brand->term_id, 'product_brand'),
            $brandThumbnail ? $brandThumbnail : '<span>' . $brand->name . '</span>',
          );
        }
        echo '</div>';
      }

      woocommerce_template_single_price();
      woocommerce_template_single_excerpt();
      woocommerce_template_single_add_to_cart();

      echo '</div>';
      echo '</div><!-- End product summary -->';
      echo '</div>';
      echo '</div>';
      // End render
      $html = ob_get_contents();
      ob_clean();
      ob_end_flush();
    }
    wp_reset_postdata();

    echo $html;
    wp_die();
  }
}

function woocommerce_layered_nav_term_html($term_html, $term, $link, $count)
{
  $attribute_label_name = wc_attribute_label($term->taxonomy);;
  $attribute_id         = wc_attribute_taxonomy_id_by_name($attribute_label_name);
  $attr                 = wc_get_attribute($attribute_id);
  $array                = json_decode(json_encode($attr), true);

  if ($array['type'] == 'color') {
    $color = get_term_meta($term->term_id, 'pa_color_picker', true);
    $term_html = '<div class="type-color"><span class="color-box" style="background-color:' . esc_attr($color) . ';"></span>' . $term_html . '</div>';
  }

  if ($array['type'] == 'button') {
    $term_html = '<div class="type-button"><span class="button-box"></span>' . $term_html . '</div>';
  }

  return $term_html;
};

add_filter('woocommerce_layered_nav_term_html', 'woocommerce_layered_nav_term_html', 10, 4);


// nav item
function clotya_nav_description($item_output, $item, $depth, $args)
{
  if (!empty($item->description)) {
    $item_output = str_replace($args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output);
  }

  return $item_output;
}
add_filter('walker_nav_menu_start_el', 'clotya_nav_description', 10, 4);

// Cart count
add_filter('woocommerce_add_to_cart_fragments', 'add_to_cart_fragment');
function add_to_cart_fragment($fragments)
{
  global $woocommerce;
  ob_start();
  echo '<span class="cart-count count">' . $woocommerce->cart->cart_contents_count . '</span>';
  $fragments['span.cart-count'] = ob_get_clean();
  return $fragments;
}
