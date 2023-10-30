<?php

use Elementor\Widget_Base;

class FANA_Product_Carousel_Widget extends Widget_Base
{
  public static $slug = 'elementor-fana-product-carousel';
  static $postType = 'product';

  public function __construct($data = [], $args = null)
  {
    parent::__construct($data, $args);
  }

  public function get_name()
  {
    return self::$slug;
  }

  public function get_title()
  {
    return __('Product Carousel', THEME_DOMAIN);
  }

  public function get_icon()
  {
    return 'eicon-slider-3d';
  }

  public function get_categories()
  {
    return ['boxgates'];
  }

  protected function register_controls()
  {
    $this->start_controls_section(
      'content_section',
      [
        'label' => __('Setting', THEME_DOMAIN),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );
    $this->add_control(
      'limit',
      [
        'label'   => __('Limit', THEME_DOMAIN),
        'type'     => \Elementor\Controls_Manager::NUMBER,
        'min'     => 1,
        'max'     => 20,
        'default' => 3
      ]
    ); //slides_per_view
    $this->add_control(
      'show_arrow',
      [
        'label'        => __('Display Arrow', THEME_DOMAIN),
        'type'          => \Elementor\Controls_Manager::SWITCHER,
        'label_on'      => __('Show', THEME_DOMAIN),
        'label_off'    => __('Hide', THEME_DOMAIN),
        'return_value' => 'yes',
        'default'      => 'no',
      ]
    );

    $this->add_control(
      'text_align',
      [
        'label'   => __('Alignment', THEME_DOMAIN),
        'type'     => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
          'left'   => [
            'title' => __('Left', THEME_DOMAIN),
            'icon'   => 'eicon-text-align-left',
          ],
          'center'   => [
            'title'   => __('Center', THEME_DOMAIN),
            'icon'     => 'eicon-text-align-center',
          ],
          'right'   => [
            'title'   => __('Right', THEME_DOMAIN),
            'icon'     => 'eicon-text-align-right',
          ],
        ],
        'default' => 'center',
        'toggle'   => true,
        'selectors' => [
          '{{WRAPPER}} .product-content .caption' => 'text-align: {{VALUE}};',
          '{{WRAPPER}} .product-content .price' => 'text-align: {{VALUE}}; display: block;',
          '{{WRAPPER}} .brand-name-wrap' => 'justify-content: {{VALUE}};',
        ],
      ]
    );

    $this->add_control(
      'show_tab',
      [
        'label'        => __('Show Category By Tab', THEME_DOMAIN),
        'type'          => \Elementor\Controls_Manager::SWITCHER,
        'label_on'      => __('Show', THEME_DOMAIN),
        'label_off'    => __('Hide', THEME_DOMAIN),
        'return_value' => 'yes',
        'default'      => 'no',
      ]
    );

    $options       = [];
    $product_cat   = get_terms(array(
      'taxonomy'    => 'product_cat',
    ));

    if ($product_cat) {
      foreach ($product_cat as $cate) {
        $options[$cate->term_id] = $cate->name;
      }
    }
    $this->add_control(
      'category',
      [
        'label'       => __('Category', THEME_DOMAIN),
        'type'         => \Elementor\Controls_Manager::SELECT2,
        'multiple'     => true,
        'label_block' => true,
        'options'     => $options
      ]
    );
    $optionTerm = [];
    $tags   = get_terms(array(
      'taxonomy'    => 'product_tag',
    ));

    if ($tags) {
      foreach ($tags as $t) {
        $optionTerm[$t->term_id] = $t->name;
      }
    }
    $this->add_control(
      'tags',
      [
        'label'       => __('Tags', THEME_DOMAIN),
        'type'        => \Elementor\Controls_Manager::SELECT2,
        'multiple'     => true,
        'label_block' => true,
        'options'     => $optionTerm
      ]
    );

    $listSizeImage = [];
    $sizeImage = get_intermediate_image_sizes();
    foreach ($sizeImage as $size => $value) {
      $listSizeImage[$value] = $value;
    }

    $this->add_control(
      'size_image',
      [
        'label'       => __('Size Image', THEME_DOMAIN),
        'type'         => \Elementor\Controls_Manager::SELECT,
        'multiple'     => true,
        'label_block' => true,
        'default'      => 'thumbnail',
        'options'     => $listSizeImage
      ]
    );


    $this->add_control(
      'product_sort',
      [
        'label'         => __('Sort By', 'clotya'),
        'type'          => \Elementor\Controls_Manager::SELECT,
        'default'       => '',
        'options'       => [
          'popularity'  => __('Popularity', 'clotya'),
          'latest'      => __('Latest', 'clotya'),
          'price_asc'   => __('Low To High', 'clotya'),
          'price_desc'  => __('High To Low', 'clotya'),
          'rating'      => __('Rating', 'clotya'),
          'rand'        => __('Random', 'clotya'),
        ]
      ]
    );

    $this->add_control(
      'slider_enable',
      [
        'label'         => __('Slider Enable', THEME_DOMAIN),
        'type'           => \Elementor\Controls_Manager::SWITCHER,
        'label_on'       => __('Show', THEME_DOMAIN),
        'label_off'     => __('Hide', THEME_DOMAIN),
        'return_value'   => 'yes',
        'default'       => 'yes',
      ]
    );
    $this->end_controls_section();
    $this->start_controls_section(
      'swiper_section',
      [
        'label'     => __('Slider Setting', THEME_DOMAIN),
        'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
          'slider_enable' => 'yes'
        ],
      ]
    );

    $this->add_control(
      'loop',
      [
        'label'         => __('Infinite Loop', THEME_DOMAIN),
        'type'           => \Elementor\Controls_Manager::SWITCHER,
        'label_on'       => __('Show', THEME_DOMAIN),
        'label_off'     => __('Hide', THEME_DOMAIN),
        'return_value'   => 'yes',
        'default'       => 'yes',
      ]
    ); //Infinite Loop
    $this->add_responsive_control(
      'slides_per_view',
      [
        'label'   => __('Slide per view', THEME_DOMAIN),
        'type'    => \Elementor\Controls_Manager::NUMBER,
        'min'     => 1,
        'max'     => 10,
        'devices' => ['desktop', 'tablet', 'mobile'],
        'default' => 4
      ]
    ); //slides_per_view
    $this->add_responsive_control(
      'slides_per_column',
      [
        'label'           => __('Slide per column', THEME_DOMAIN),
        'type'             => \Elementor\Controls_Manager::NUMBER,
        'min'             => 1,
        'max'             => 10,
        'devices'         => ['desktop', 'tablet', 'mobile'],
        'default'         => 1,
        'desktop_default' => 1,
        'tablet_default'   => 1,
        'mobile_default'   => 1
      ]
    ); //slides_per_column
    $this->add_responsive_control(
      'space_between',
      [
        'label'           => __('Space between', THEME_DOMAIN),
        'type'             => \Elementor\Controls_Manager::NUMBER,
        'min'             => 0,
        'max'             => 100,
        'devices'         => ['desktop', 'tablet', 'mobile'],
        'default'         => 10,
        'desktop_default' => 10,
        'tablet_default'   => 10,
        'mobile_default'   => 10
      ]
    ); //space_between
    $this->end_controls_section();

    // Style tab setting
    $this->start_controls_section(
      'fana_styling',
      [
        'label' => esc_html__(' Style', THEME_DOMAIN),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        'condition' => [
          'show_tab' => 'yes'
        ],
      ]
    );
    $this->add_responsive_control(
      'btn_padding',
      [
        'label' => esc_html__('Margin', THEME_DOMAIN),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px'],
        'selectors' => ['{{WRAPPER}} .tab-product-carousel-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
      ]
    );
    $this->add_control(
      'title_heading',
      [
        'label' => esc_html__('TITLE', THEME_DOMAIN),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before'
      ]
    );
    $this->add_control(
      'title_color',
      [
        'label' => esc_html__('Title Color', THEME_DOMAIN),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '',
        'selectors' => ['{{WRAPPER}} .tablinks' => 'color: {{VALUE}};']
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'btn_border',
        'label' => esc_html__('Border', THEME_DOMAIN),
        'selector' => '{{WRAPPER}} .tablinks.active',
        // 'selectors' => ['{{WRAPPER}} .tablinks' => 'color: {{VALUE}};'],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'title_typo',
        'label' => esc_html__('Typography', THEME_DOMAIN),
        'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .tablinks',
      ]
    );
    $this->end_controls_section();

    // Style slide
    $this->start_controls_section(
      'fana_styling_slide',
      [
        'label' => esc_html__('Slide Style', THEME_DOMAIN),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'title_heading_item',
      [
        'label' => esc_html__('TITLE', THEME_DOMAIN),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before'
      ]
    );
    $this->add_control(
      'title_color_item',
      [
        'label' => esc_html__('Title Color', THEME_DOMAIN),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '',
        'selectors' => ['{{WRAPPER}} .product-name a' => 'color: {{VALUE}};']
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'title_typo_item',
        'label' => esc_html__('Typography', THEME_DOMAIN),
        'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .product-name',
      ]
    );

    $this->add_control(
      'price_heading_item',
      [
        'label' => esc_html__('PRICE', THEME_DOMAIN),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before'
      ]
    );
    $this->add_control(
      'price_color_item',
      [
        'label' => esc_html__('Price Color', THEME_DOMAIN),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '',
        'selectors' => ['{{WRAPPER}} .price ins span, .product-content .caption .amount' => 'color: {{VALUE}};']
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'price_typo_item',
        'label' => esc_html__('Typography', THEME_DOMAIN),
        'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .price ins span, .product-content .caption .amount',
      ]
    );

    $this->add_control(
      'price_del_color_item',
      [
        'label' => esc_html__('Price Del Color', THEME_DOMAIN),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '',
        'selectors' => ['{{WRAPPER}} .price del span' => 'color: {{VALUE}};']
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'price_del_typo_item',
        'label' => esc_html__('Typography price del', THEME_DOMAIN),
        'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .price del span',
      ]
    );

    $this->end_controls_section();
    // End Style slide
  }

  public function show_product($categories)
  {
    $settings = $this->get_settings_for_display();

    $productTag = array();
    if (!empty($settings['tags'])) {
      foreach ($settings['tags'] as $tag) {
        array_push($productTag, get_term($tag, 'product_tag')->slug);
      }
    }

    $Filter = $settings['product_sort'];
    $ProductFilter = [
      'limit'     =>  $settings['limit'],
      'status'    =>  'publish',
      'category'  =>  $categories,
      'tag'       =>  $productTag,

    ];

    if ($Filter == 'popularity') {
      $ProductFilter['orderby']   = 'post_views';
      $ProductFilter['order']     = 'DESC';
    }
    if ($Filter == 'rating') {
      $ProductFilter['orderby']   = 'meta_value_key';
      $ProductFilter['meta_key']  = '_wc_average_rating';
      $ProductFilter['order']     = 'DESC';
    }
    if ($Filter == 'price_asc') {
      $ProductFilter['orderby']   = 'meta_value_num';
      $ProductFilter['meta_key']  = '_price';
      $ProductFilter['order']     = 'asc';
    }
    if ($Filter == 'price_desc') {
      $ProductFilter['orderby']   = 'meta_value_num';
      $ProductFilter['meta_key']  = '_price';
      $ProductFilter['order']     = 'desc';
    }
    if ($Filter == 'rand') {
      $ProductFilter['orderby']   = 'rand';
    }
    if ($Filter == 'latest') {
      $ProductFilter['orderby']   = 'modified';
      $ProductFilter['order']     = 'DESC';
    }

    $query = new WC_Product_Query($ProductFilter);
    $products = $query->get_products();
?>
    <div <?php $this->print_render_attribute_string('slider_config'); ?>>
      <?php
      echo ($settings['slider_enable'] == 'yes') ? '<div class="swiper-wrapper">' : '<div class="row">';
      foreach ($products as $product) {
        $attachment_ids = $product->get_gallery_image_ids();
        // Lấy url ảnh sản phẩm
        $thumbnail = wp_get_attachment_image_url($product->get_data()['image_id'], $settings['size_image']);

        $secound_thumbnail = '';
        if (count($attachment_ids) > 0) {
          $secound_thumbnail = wp_get_attachment_image_url($attachment_ids[0], $settings['size_image']);
        } else {
          $secound_thumbnail = $thumbnail;
        }

        // Tính phần trăm sale
        $discountPercentage = '';
        $badge = get_post_meta(get_the_ID(), 'product_badge', true);
        if ($product->is_on_sale() && $product->is_type('variable')) {
          $percentage = '-' . ceil(100 - ($product->get_variation_sale_price() / $product->get_variation_regular_price('min')) * 100);
          //	        $discountPercentage = '<span class="wrapper-onsale-featured onsale">';
          $discountPercentage .= '<span class="saled">' . $percentage . '%</span>';
          //	        $discountPercentage .= '</span>';
        } elseif ($product->is_on_sale() && $product->get_regular_price()  && !$product->is_type('grouped')) {
          $percentage = '-' . ceil(100 - ($product->get_sale_price() / $product->get_regular_price()) * 100);
          //          $discountPercentage .= '<span class="wrapper-onsale-featured onsale">';
          if ($badge) {
            $discountPercentage .= '<span class="trending">' . esc_html($badge) . '</span>';
          } else {
            $discountPercentage .= '<span class="saled">' . $percentage . '%</span>';
          }
          //          $discountPercentage .= '</span>';
        }

        // $siteConfig = \BoxGates\Utils::getConfig();
        if (!empty($siteConfig['enable_new_price']) && $siteConfig['enable_new_price'] == 1) {
          $discountPercentage .= '<span class="onnewprice">' . esc_html__('New Price!', 'woocommerce') . '</span>';
        }

        if (!empty($discountPercentage)) {
          $discountPercentage = '<span class="wrapper-onsale-featured onsale">' . $discountPercentage . '</span>';
        }

        // Lấy thuộc tính brand
        $productBrand = get_the_terms($product->get_id(), 'product_brand');
        $brandName = '';

        if ($productBrand && !is_wp_error($productBrand)) {
          foreach ($productBrand as $brand) {
            $brandName .= '<h4><a href="' . get_term_link($brand) . '" class="brand-name"> ' . $brand->name . ' </a></h4>';

            // Không hiện dấu - trên item cuối cùng
            if (next($productBrand)) {
              $brandName .= '-';
            }
          }
        }

      ?>
        <div <?php $this->print_render_attribute_string('post_item'); ?>>

          <div class="product-content product-<?php echo $product->get_id() ?>">
            <!-- Thumbnail and utility buntton -->
            <div class="block-inner">
              <figure class="image ">
                <a title="<?php echo $product->get_title() ?>" href="<?php echo $product->get_permalink() ?>" class="product-image">
                  <img width="480" height="638" src="<?php echo $thumbnail; ?>" class="attachment-shop_catalog image-effect lazyloaded" alt="" decoding="async" loading="lazy" data-ll-status="loaded">
                  <img width="480" height="638" src="<?php echo $secound_thumbnail; ?>" class="image-hover lazyloaded" alt="" decoding="async" loading="lazy" data-ll-status="loaded">
                </a>
              </figure>

              <!-- Utility button -->
              <div class="group-buttons">
                <a href="#" class="qview-button d-none" title="Quick View" data-effect="mfp-move-from-top" data-product_id="<?php echo $product->get_id() ?>">
                  <i class="tb-icon tb-icon-search-normal"></i>
                  <span>Quick View</span>
                </a>
                <a href="?add_to_wishlist=<?php echo $product->get_id() ?>" class="add_to_wishlist single_add_to_wishlist" aria-label="<?php echo $product->get_title() ?>" data-product-id="<?php echo $product->get_id() ?>" data-product-type="<?php echo $product->get_type() ?>" data-original-product-id="<?php echo $product->get_id() ?>" data-title="Add to wishlist" rel="nofollow">
                  <i class="tb-icon tb-icon-heart"></i> <span>Add to wishlist</span>
                </a>
                <a href="/fana/shop/?action=yith-woocompare-add-product&amp;id=18&amp;_wpnonce=7df77f41fb" title="Compare" class="compare d-none" data-product_id="18">
                  <i class="tb-icon tb-icon-compare"></i>
                  <span>Add to compare</span>
                </a>
              </div>

              <!-- Group add to cart -->
              <div class="group-add-to-cart">
                <?php if ($product->get_type() == 'simple') { ?>
                  <div class="add-cart" title="Add to cart">
                    <a href="?add-to-cart=<?php echo $product->get_id() ?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo $product->get_id() ?>" data-product_sku="<?php echo $product->get_sku() ?>" aria-label="<?php echo $product->get_title() ?>" rel="nofollow">
                      <i class="tb-icon tb-icon-bag"></i>
                      <span class="title-cart">Add to cart</span>
                    </a>
                  </div>
                <?php } else { ?>
                  <div class="add-cart" title="Select options">
                    <a href="<?php echo $product->get_permalink() ?>" data-quantity="1" class="button product_type_variable add_to_cart_button" data-product_id="<?php echo $product->get_id() ?>" data-product_sku="<?php echo $product->get_sku() ?>" aria-label="<?php echo $product->get_title() ?>”" rel="nofollow">
                      <i class="tb-icon tb-icon-bag"></i>
                      <span class="title-cart">Select options</span></a>
                  </div>
                <?php } ?>
              </div>
            </div>

            <!-- Button onsale -->
            <?php echo $discountPercentage; ?>

            <!-- Caption -->
            <div class="caption">
              <div class="brand-name-wrap d-flex gap-3">
                <?php echo $brandName; ?>
              </div>
              <h3 class="product-name"><a href="<?php echo $product->get_permalink() ?>"> <?php echo $product->get_title() ?></a></h3>
              <span class="price"><?php echo $product->get_price_html() ?></span>
              <div class="group-content d-none">
                <div class="rating">
                  <?php echo wc_get_rating_html($product->get_average_rating()); ?>
                  <span class="count"><?php echo $product->get_review_count(); ?></span>
                </div>
              </div>
            </div>

            <!-- Swatches -->

            <?php
            if ($product->is_type('variable')) {
              foreach ($product->get_variation_attributes() as $attribute_name  => $options) {

                $hasSize = false;
                $hasColor = false;
                if ($attribute_name == 'pa_color') {
                  $hasColor = true;
                }
                if ($attribute_name == 'pa_size') {
                  $hasSize = true;
                }

                if ($attribute_name == 'pa_color') { ?>
                  <div class="swatches-wrapper">
                    <ul data-attribute_name="attribute_pa_color" class="active">

                      <?php
                      foreach ($options as $attr_color) {
                        $terms = get_term_by('slug', $attr_color, 'pa_color');
                        $attr_color_value = get_term_meta($terms->term_id, 'pa_color_picker', true);
                        $style = 'style="background-color:' . strtolower($attr_color) . '"';
                        if (!empty($attr_color_value)) {
                          $style = 'style="background-color:' . $attr_color_value . '"';
                        }

                        $attribute = '';
                        // Lấy variation id
                        foreach ($product->get_available_variations() as $v) {
                          if ($v["attributes"]["attribute_pa_color"] == $attr_color) {
                            $attribute = $v;
                          }
                        }
                        // variation default id
                        $default_variations_id = wp_list_pluck($product->get_available_variations(), 'variation_id');

                        $img_url = $attribute ? $attribute['image']['thumb_src'] : '';
                        $variation_id = $attribute ? $attribute['variation_id'] : $default_variations_id[0];
                      ?>

                        <li class="swatch-item variable-item-color">
                          <div class="variable-item-contents">
                            <a href="#" class="swatch-item-tbay swatch-has-image variable-item-span-color swatch swatch-black" data-product_id="<?php echo $product->get_id(); ?>" data-value="<?php echo $terms->slug; ?>" data-name="<?php echo $terms->name; ?>" data-variable_id="<?php echo $variation_id; ?>" <?php echo $style; ?> data-image-src="<?php echo $img_url; ?>" data-image-srcset="" title="Black">
                            </a>
                          </div>
                        </li>

                      <?php } ?>
                    </ul>
                  </div>
              <?php
                }
              }
              ?>
              <input type="hidden" class="condition-add-to-cart" value="<?php echo $hasSize ? 'has-size' : '' ?>">
            <?php } ?>
          </div>

        </div>
      <?php
      }
      echo '</div>';
      if ($settings['slider_enable'] == 'yes' && $settings['show_arrow'] == 'yes') {
      ?>
        <div class="product-carousel-swiper-button-next tb-icon tb-icon-arrow-right"></div>
        <div class="product-carousel-swiper-button-prev tb-icon tb-icon-arrow-left"></div>
      <?php } ?>
    </div>

  <?php
    // return ['boxgates'];
  }

  protected function render()
  {
    $settings = $this->get_settings_for_display();
    $attributeSlider = ['class' => $settings['slider_enable'] == 'yes' ? 'swiper fana-products fana-products__swiper' : 'fana-products'];

    if ($settings['slider_enable'] == 'yes') {
      $attributeSlider['data-slider'] = json_encode([
        'loop'                     => $settings['loop'],
        'slides_per_view'          => $settings['slides_per_view'],
        'slides_per_view_tablet'   => $settings['slides_per_view_tablet'] ?? $settings['slides_per_view'],
        'slides_per_view_mobile'   => $settings['slides_per_view_mobile'] ?? $settings['slides_per_view'],

        'slides_per_column'        => $settings['slides_per_column'],
        'slides_per_column_tablet' => $settings['slides_per_column_tablet'] ?? $settings['slides_per_column'],
        'slides_per_column_mobile' => $settings['slides_per_column_mobile'] ?? $settings['slides_per_column'],

        'space_between'            => $settings['space_between'],
        'space_between_tablet'     => $settings['space_between_tablet'] ?? 10,
        'space_between_mobile'     => $settings['space_between_mobile'] ?? 10,
      ]);
    }
    $this->add_render_attribute('slider_config', $attributeSlider);

    $this->add_render_attribute('post_item', [
      'class' => $settings['slider_enable'] == 'yes' ? 'swiper-slide product-carousel-item' : 'col-6 col-lg-3 product-carousel-item'
    ]);

    $filter = [
      'post_type'   => self::$postType,
      'numberposts' => $settings['limit'],
      'status'      => 'publish',
    ];

    if (!empty($settings['tags'])) {
      $filter['tax_query'] = [
        [
          'taxonomy' => 'post_tag',
          'field'    => 'term_id',
          'terms'    => $settings['tags'],
        ]
      ];
    }

    $arrayCat = array();
    if (!empty($settings['category'])) {
      foreach ($settings['category'] as $category) {
        array_push($arrayCat, get_term($category, 'product_cat')->slug);
      }
    }

    $element = rand();
  ?>
    <?php if ($settings['show_tab'] === 'yes') { ?>
      <div class="tab-product-carousel-header">
        <?php if (!empty($settings['category'])) {
          foreach ($settings['category'] as $key => $category) {
            // array_push($arrayCat, get_term($category, 'product_cat')->slug); active
            $active_tab = $key === array_key_first($settings['category']) ? 'active' : '';

            echo '<button class="tablinks ' . $active_tab . '" data-tab-content="tab-' . get_term($category, 'product_cat')->slug . '" data-element="' . $element . '">' . get_term($category, 'product_cat')->name . '</button>';
            // echo $arrayCat;
          }
        };
        ?>
      </div>
      <div class="tab-product-carousel-content" id="tab-<?php echo $element; ?>">
        <?php if (!empty($settings['category'])) {
          foreach ($settings['category'] as $key => $category) {
            $active_tab = $key === array_key_first($settings['category']) ? '' : 'd-none';

            echo '<div class="tab-product-content ' . $active_tab . '" id="tab-' . get_term($category, 'product_cat')->slug . '">';
            $this->show_product(array(get_term($category, 'product_cat')->slug));
            echo '</div>';
          }
        } ?>
      </div>
<?php } else {
      $this->show_product($arrayCat);
    }
  }
}
