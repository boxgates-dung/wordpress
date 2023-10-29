<?php

/**
 * Get template elementor id
 * */
function get_static_template($static_name)
{
  $staticId = false;
  if (!is_singular('elementor_library')) {
    $staticId = get_option($static_name);
  }
  return $staticId;
}
