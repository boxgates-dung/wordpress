<?php

use Elementor\Widget_Base;

class Latoya_Nav_Widget extends Widget_Base
{
  public static $slug = 'latoya-nav';

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
    return __('Nav', LATOYA_THEME_DOMAIN);
  }

  public function get_icon()
  {
    return 'eicon-nav-menu';
  }

  public function get_categories()
  {
    return ['latoya'];
  }

  protected function register_controls()
  {
    $this->start_controls_section(
      'content_section',
      [
        'label' => __('Setting', LATOYA_THEME_DOMAIN),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );
    $this->add_control(
      'limit',
      [
        'label'   => __('Limit', LATOYA_THEME_DOMAIN),
        'type'     => \Elementor\Controls_Manager::NUMBER,
        'min'     => 1,
        'max'     => 20,
        'default' => 3
      ]
    ); //slides_per_view
    $this->add_control(
      'show_arrow',
      [
        'label'        => __('Display Arrow', LATOYA_THEME_DOMAIN),
        'type'          => \Elementor\Controls_Manager::SWITCHER,
        'label_on'      => __('Show', LATOYA_THEME_DOMAIN),
        'label_off'    => __('Hide', LATOYA_THEME_DOMAIN),
        'return_value' => 'yes',
        'default'      => 'no',
      ]
    );

    $this->add_control(
      'text_align',
      [
        'label'   => __('Alignment', LATOYA_THEME_DOMAIN),
        'type'     => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
          'left'   => [
            'title' => __('Left', LATOYA_THEME_DOMAIN),
            'icon'   => 'eicon-text-align-left',
          ],
          'center'   => [
            'title'   => __('Center', LATOYA_THEME_DOMAIN),
            'icon'     => 'eicon-text-align-center',
          ],
          'right'   => [
            'title'   => __('Right', LATOYA_THEME_DOMAIN),
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
        'label'        => __('Show Category By Tab', LATOYA_THEME_DOMAIN),
        'type'          => \Elementor\Controls_Manager::SWITCHER,
        'label_on'      => __('Show', LATOYA_THEME_DOMAIN),
        'label_off'    => __('Hide', LATOYA_THEME_DOMAIN),
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
        'label'       => __('Category', LATOYA_THEME_DOMAIN),
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
        'label'       => __('Tags', LATOYA_THEME_DOMAIN),
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
        'label'       => __('Size Image', LATOYA_THEME_DOMAIN),
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
        'label'         => __('Slider Enable', LATOYA_THEME_DOMAIN),
        'type'           => \Elementor\Controls_Manager::SWITCHER,
        'label_on'       => __('Show', LATOYA_THEME_DOMAIN),
        'label_off'     => __('Hide', LATOYA_THEME_DOMAIN),
        'return_value'   => 'yes',
        'default'       => 'yes',
      ]
    );
    $this->end_controls_section();
    $this->start_controls_section(
      'swiper_section',
      [
        'label'     => __('Slider Setting', LATOYA_THEME_DOMAIN),
        'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
        'condition' => [
          'slider_enable' => 'yes'
        ],
      ]
    );

    $this->add_control(
      'loop',
      [
        'label'         => __('Infinite Loop', LATOYA_THEME_DOMAIN),
        'type'           => \Elementor\Controls_Manager::SWITCHER,
        'label_on'       => __('Show', LATOYA_THEME_DOMAIN),
        'label_off'     => __('Hide', LATOYA_THEME_DOMAIN),
        'return_value'   => 'yes',
        'default'       => 'yes',
      ]
    ); //Infinite Loop
    $this->add_responsive_control(
      'slides_per_view',
      [
        'label'   => __('Slide per view', LATOYA_THEME_DOMAIN),
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
        'label'           => __('Slide per column', LATOYA_THEME_DOMAIN),
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
        'label'           => __('Space between', LATOYA_THEME_DOMAIN),
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
        'label' => esc_html__(' Style', LATOYA_THEME_DOMAIN),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        'condition' => [
          'show_tab' => 'yes'
        ],
      ]
    );
    $this->add_responsive_control(
      'btn_padding',
      [
        'label' => esc_html__('Margin', LATOYA_THEME_DOMAIN),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px'],
        'selectors' => ['{{WRAPPER}} .tab-product-carousel-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
      ]
    );
    $this->add_control(
      'title_heading',
      [
        'label' => esc_html__('TITLE', LATOYA_THEME_DOMAIN),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before'
      ]
    );
    $this->add_control(
      'title_color',
      [
        'label' => esc_html__('Title Color', LATOYA_THEME_DOMAIN),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '',
        'selectors' => ['{{WRAPPER}} .tablinks' => 'color: {{VALUE}};']
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'btn_border',
        'label' => esc_html__('Border', LATOYA_THEME_DOMAIN),
        'selector' => '{{WRAPPER}} .tablinks.active',
        // 'selectors' => ['{{WRAPPER}} .tablinks' => 'color: {{VALUE}};'],
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'title_typo',
        'label' => esc_html__('Typography', LATOYA_THEME_DOMAIN),
        'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .tablinks',
      ]
    );
    $this->end_controls_section();

    // Style slide
    $this->start_controls_section(
      'fana_styling_slide',
      [
        'label' => esc_html__('Slide Style', LATOYA_THEME_DOMAIN),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_control(
      'title_heading_item',
      [
        'label' => esc_html__('TITLE', LATOYA_THEME_DOMAIN),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before'
      ]
    );
    $this->add_control(
      'title_color_item',
      [
        'label' => esc_html__('Title Color', LATOYA_THEME_DOMAIN),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '',
        'selectors' => ['{{WRAPPER}} .product-name a' => 'color: {{VALUE}};']
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'title_typo_item',
        'label' => esc_html__('Typography', LATOYA_THEME_DOMAIN),
        'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .product-name',
      ]
    );

    $this->add_control(
      'price_heading_item',
      [
        'label' => esc_html__('PRICE', LATOYA_THEME_DOMAIN),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before'
      ]
    );
    $this->add_control(
      'price_color_item',
      [
        'label' => esc_html__('Price Color', LATOYA_THEME_DOMAIN),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '',
        'selectors' => ['{{WRAPPER}} .price ins span, .product-content .caption .amount' => 'color: {{VALUE}};']
      ]
    );
    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'price_typo_item',
        'label' => esc_html__('Typography', LATOYA_THEME_DOMAIN),
        'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .price ins span, .product-content .caption .amount',
      ]
    );

    $this->add_control(
      'price_del_color_item',
      [
        'label' => esc_html__('Price Del Color', LATOYA_THEME_DOMAIN),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '',
        'selectors' => ['{{WRAPPER}} .price del span' => 'color: {{VALUE}};']
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'name' => 'price_del_typo_item',
        'label' => esc_html__('Typography price del', LATOYA_THEME_DOMAIN),
        'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
        'selector' => '{{WRAPPER}} .price del span',
      ]
    );

    $this->end_controls_section();
    // End Style slide
  }

  protected function render()
  {
    $settings = $this->get_settings_for_display();

    echo 'dasdas';
    
  }
}
