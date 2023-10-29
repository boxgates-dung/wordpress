<?php
 /**
 * The template for displaying all elementor preview page.
 *
 * @package Latoya
 */

get_header();

while (have_posts()) { 
  the_post();
  the_content();
};

get_footer();