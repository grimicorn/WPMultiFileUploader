<?php
/**
 *	@version 1.1.0
 * 	@since 1.0.0
 *	@author Dan Holloran
 *	@copyright GPLv2 (or later)
 */

/**
 * Create WPMFU Form Post Type
 */
function create_wpmfu_form_post_type()
{
	// Setup the wpmfu form post type labels
		$labels = array(
			'name' => _x('WPMFU Forms', 'post type general name', 'wpmfu'),
			'singular_name' => _x('WPMFU Form', 'post type singular name', 'wpmfu'),
			'add_new' => _x('Add New', 'wpmfu form', 'wpmfu'),
			'add_new_item' => __('Add New WPMFU Form', 'wpmfu'),
			'edit_item' => __('Edit WPMFU Form', 'wpmfu'),
			'new_item' => __('New WPMFU Form', 'wpmfu'),
			'all_items' => __('All WPMFU Forms', 'wpmfu'),
			'view_item' => __('View WPMFU Form', 'wpmfu'),
			'search_items' => __('Search WPMFU Forms', 'wpmfu'),
			'not_found' =>  __('No wpmfu forms found', 'wpmfu'),
			'not_found_in_trash' => __('No wpmfu forms found in Trash', 'wpmfu'),
			'parent_item_colon' => '',
			'menu_name' => __('WPMFU Forms', 'wpmfu')
		);
	// Setup the wpmfu form post type arguments
		$args = array(
			'labels' => $labels,
			'description' => 'WP Multi File Uploader forms',
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_nav_menus'	=>TRUE,
			'show_in_admin_bar'	=>	TRUE,
			'exclude_from_search' => FALSE,
			'query_var' => true,
			'rewrite' => array( 'slug' => _x( 'wpmfu forms', 'URL slug', 'wpmfu-forms' ) ),
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			'register_meta_box_cb' => '',
			'taxonomies' => array(),
			'menu_icon'	=>	null,
			'menu_position' => null,
			'supports' => array('title')
		);
	// Register the WPMFU Forms post type
	register_post_type('wpmfu_forms_type', $args);
} // create_wpmfu_form_post_type()
add_action( 'init', 'create_wpmfu_form_post_type' );