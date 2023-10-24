<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width">
  <title><?php wp_title('-', true, 'right'); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header class="header d-none d-lg-block">
    <?php
    $footer_static_id = get_static_template('theme_header_part');
    if ($footer_static_id) {
      $ele = Elementor\Plugin::instance();
      echo $ele->frontend->get_builder_content_for_display($footer_static_id);
    }
    ?>
  </header>

  <?php get_template_part('template-parts/mobile', 'header-nav'); ?>