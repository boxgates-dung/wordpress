<?php
/**
 * Single product
 * */ 
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 8 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 6 );
