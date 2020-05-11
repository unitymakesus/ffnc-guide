<?php

namespace App;

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
  $title = $title ?: __('Sage &rsaquo; Error', 'sage');
  $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
  $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
  wp_die($message, $title);
};

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
  // Enqueue files for child theme (which include the core assets as imports)
  wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);

  if (class_exists('FLBuilderModel') && (\FLBuilderModel::is_builder_active())) {
    // Don't load theme js if Beaver Builder is active
  } else {
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
    // Set array of theme customizations for JS
    wp_localize_script( 'sage/main.js', 'simple_options', array('fonts' => get_theme_mod('theme_fonts'), 'colors' => get_theme_mod('theme_color')) );
  }
}, 100);

/**
 * REMOVE WP EMOJI
 */
 remove_action('wp_head', 'print_emoji_detection_script', 7);
 remove_action('wp_print_styles', 'print_emoji_styles');
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Enable plugins to manage the document title
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
 */
add_theme_support('title-tag');

/**
 * Register navigation menus
 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
 */
register_nav_menus([
    'primary_navigation' => __('Primary Navigation', 'sage'),
    'social_links' => __('Social Links', 'sage')
]);

/**
 * Enable post thumbnails
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 */
add_theme_support('post-thumbnails');

/**
 * Enable HTML5 markup support
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
 */
add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

/**
 * Enable selective refresh for widgets in customizer
 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
 */
add_theme_support('customize-selective-refresh-widgets');

/**
* Add support for Gutenberg.
*
* @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
*/
add_theme_support( 'align-wide' );
add_theme_support( 'disable-custom-colors' );
add_theme_support( 'wp-block-styles' );

/**
 * Enqueue editor styles for Gutenberg
 */
// function simple_editor_styles() {
//   wp_enqueue_style( 'simple-gutenberg-style', asset_path('styles/main.css') );
// }
// add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\\simple_editor_styles' );

/**
 * Add image quality
 */
add_filter('jpeg_quality', function($arg){return 100;});

/**
 * Enable logo uploader in customizer
 */
add_image_size('simple-logo', 200, 200, false);
add_image_size('simple-logo-2x', 400, 400, false);
add_theme_support('custom-logo', array(
  'size' => 'simple-logo-2x'
));

/**
 * Set image sizes
 */
update_option( 'thumbnail_size_w', 300 );
update_option( 'thumbnail_size_h', 300 );
update_option( 'thumbnail_crop', 1 );
update_option( 'medium_size_w', 600 );
update_option( 'medium_size_h', 600 );
add_image_size('tiny-thumbnail', 80, 80, true);
add_image_size('small-thumbnail', 150, 150, true);
add_image_size('medium-square-thumbnail', 400, 400, true);
add_image_size('card', 800, 600, ['center', 'center']);

add_filter( 'image_size_names_choose', function( $sizes ) {
  return array_merge( $sizes, array(
    'tiny-thumbnail' => __( 'Tiny Thumbnail' ),
    'small-thumbnail' => __( 'Small Thumbnail' ),
    'medium-square-thumbnail' => __( 'Medium Square Thumbnail' ),
  ) );
} );

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer-Left', 'sage'),
        'id'            => 'footer-left'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer-Center', 'sage'),
        'id'            => 'footer-center'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer-Right', 'sage'),
        'id'            => 'footer-right'
    ] + $config);
});

/**
 * Add case studies post type
 */
function add_post_type() {
 $argsCaseStudies = array(
   'labels' => array(
				'name' => 'Case Studies',
				'singular_name' => 'Case Study',
				'add_new' => 'Add New',
				'add_new_item' => 'Add New Case Study',
				'edit' => 'Edit',
				'edit_item' => 'Edit Case Study',
				'new_item' => 'New Case Study',
				'view_item' => 'View Case Study',
				'search_items' => 'Search Case Studies',
				'not_found' =>  'Nothing found in the Database.',
				'not_found_in_trash' => 'Nothing found in Trash',
				'parent_item_colon' => ''
   ),
   'public' => true,
   'exclude_from_search' => false,
   'publicly_queryable' => true,
   'show_ui' => true,
   'show_in_nav_menus' => false,
   'show_in_rest' => true,
   'menu_position' => 20,
   'menu_icon' => 'dashicons-megaphone',
   'capability_type' => 'page',
   'hierarchical' => false,
   'taxonomies' => array(
     'category',
   ),
   'supports' => array(
     'title',
     'editor',
     'revisions',
     'page-attributes',
     'thumbnail'
   ),
   'has_archive' => 'case-studies',
   'rewrite' => array(
     'slug' => 'case-study'
   )
 );
 register_post_type( 'ff-case-study', $argsCaseStudies );

 $argsCompanies = array(
   'labels' => array(
				'name' => 'Companies',
				'singular_name' => 'Company',
				'add_new' => 'Add New',
				'add_new_item' => 'Add New Company',
				'edit' => 'Edit',
				'edit_item' => 'Edit Company',
				'new_item' => 'New Company',
				'view_item' => 'View Company',
				'search_items' => 'Search Companies',
				'not_found' =>  'Nothing found in the Database.',
				'not_found_in_trash' => 'Nothing found in Trash',
				'parent_item_colon' => ''
   ),
   'public' => true,
   'exclude_from_search' => false,
   'publicly_queryable' => true,
   'show_ui' => true,
   'show_in_nav_menus' => false,
   'menu_position' => 21,
   'menu_icon' => 'dashicons-groups',
   'capability_type' => 'page',
   'hierarchical' => false,
   'supports' => array(
     'title',
     'revisions',
     'page-attributes',
   ),
   'has_archive' => 'directory',
   'rewrite' => true
 );
 register_post_type( 'ff-company', $argsCompanies );
}
add_action( 'init', __NAMESPACE__.'\\add_post_type' );


//  Manually 404 the individual company pages in directory
add_action(
    'template_redirect',
    function () {
        if (is_singular('ff-company')) {
           global $wp_query;
           $wp_query->posts = [];
           $wp_query->post = null;
           $wp_query->set_404();
           status_header(404);
           nocache_headers();
        }
    }
);


// Order directory companies by name
add_filter('pre_get_posts', function($query) {
  if (is_post_type_archive('ff-company')) {
    $query->set('posts_per_page', -1);
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    return;
  }
});


// Get rid of archive title label
add_filter( 'get_the_archive_title', function( $title ) {
  if ( is_category() ) {
    $title = single_cat_title( '', false );
  } elseif ( is_tag() ) {
    $title = single_tag_title( '', false );
  } elseif ( is_author() ) {
    $title = '<span class="vcard">' . get_the_author() . '</span>';
  } elseif ( is_post_type_archive() ) {
    $title = post_type_archive_title( '', false );
  } elseif ( is_tax() ) {
    $title = single_term_title( '', false );
  }

  return $title;
});

/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 */
add_filter( 'get_search_form', function( $form ) {
    $form = '<form role="search" method="get" class="search-form" action="' . home_url( '/' ) . '" >
			<label>
				<span class="screen-reader-text">Search Site:</span>
				<input type="search" class="search-field" placeholder="Search …" value="" name="s">
			</label>
			<input type="submit" class="search-submit disabled" aria-label="Submit search" />
		</form>';
    return $form;
} );

/**
 * Filter search results to show highlighted terms
 */

function searchwp_term_highlight_auto_excerpt( $excerpt ) {
 	global $post;
 	if ( ! is_search() ) {
 		return $excerpt;
 	}
 	// prevent recursion
 	remove_filter( 'get_the_excerpt', __NAMESPACE__ . '\\searchwp_term_highlight_auto_excerpt' );
 	$global_excerpt = searchwp_term_highlight_get_the_excerpt_global( $post->ID, null, get_search_query() );
 	add_filter( 'get_the_excerpt', __NAMESPACE__ . '\\searchwp_term_highlight_auto_excerpt' );
 	return wp_kses_post( $global_excerpt );
}
add_filter( 'get_the_excerpt', __NAMESPACE__ . '\\searchwp_term_highlight_auto_excerpt' );


// Before cast studies are displayed
add_action( 'pre_get_posts', function($query){
  if ( is_admin() || ! $query->is_main_query() )
        return;

  if ( is_post_type_archive( 'ff-case-study' ) ) {
      // Display 50 posts for a custom post type called 'movie'
      $query->set( 'posts_per_page', 20 );
      return;
  }
} );

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
  $file = "../app/{$file}.php";
  if (!locate_template($file, true, true)) {
    $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
  }
}, ['admin', 'archive', 'nav']);
