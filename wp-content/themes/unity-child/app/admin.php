<?php

namespace App;

/**
 * ACF Local JSON
 * @source https://www.advancedcustomfields.com/resources/local-json/
 */
add_filter('acf/settings/save_json', function() {
  return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function($paths) {
  if (is_child_theme()) {
    $paths[] = get_template_directory() . '/acf-json';
  }

  return $paths;
});

/**
 * ACF Theme Options
 */
if ( function_exists('acf_add_options_page') ) {
  acf_add_options_sub_page([
    'page_title' 	=> __('Settings', 'sage'),
    'menu_title'	=> __('Settings', 'sage'),
    'parent_slug'	=> 'edit.php',
  ]);
}
