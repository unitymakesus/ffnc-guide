<?php

namespace App;

/**
 * Custom query args.
 */
function modify_blog_query($query) {
	if (!is_admin() && $query->is_main_query()) {
    if (is_tax()) {
      return $query;
    }

    /**
     * Main blog (+ case studies)
     */
    if ($query->is_home()) {
      $post_type = (isset($_GET['filter']) && post_type_exists($_GET['filter'])) ? ($_GET['filter']) : ['post', 'ff-case-study'];
      $query->set('post_type', $post_type);
    }

    /**
     * Category archives (+ case studies)
     */
    if ($query->is_category()) {
      $query->set('post_type', ['post', 'ff-case-study']);
    }
  }
  return $query;
}
add_action('pre_get_posts', __NAMESPACE__ . '\\modify_blog_query');
