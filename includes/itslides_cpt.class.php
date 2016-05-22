<?php
/*
 * Creates a Custom Post Type Slider
 * which allows to set up different sliders
 */

 /* Quit */
 defined('ABSPATH') OR exit;

if ( ! class_exists( 'Itslides_CPT') ) :
class Itslides_CPT {

	// Register Custom Post Type itslider
	public static function create_post_type() {

		$labels = array(
			'name'                  => _x( 'Sliders', 'Post Type General Name', 'itslides' ),
			'singular_name'         => _x( 'Slider', 'Post Type Singular Name', 'itslides' ),
			'menu_name'             => __( 'Slider', 'itslides' ),
			'name_admin_bar'        => __( 'Slider', 'itslides' ),
			'all_items'             => __( 'Sliders', 'itslides' ),
			'add_new_item'          => __( 'Add New Slider', 'itslides' ),
			'add_new'               => __( 'Add New', 'itslides' ),
			'new_item'              => __( 'New Slider', 'itslides' ),
			'edit_item'             => __( 'Edit Slider', 'itslides' ),
			'update_item'           => __( 'Update Slider', 'itslides' ),
			'view_item'             => __( 'View Slider', 'itslides' ),
			'search_items'          => __( 'Search Slider', 'itslides' ),
			'not_found'             => __( 'Not found', 'itslides' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'itslides' ),
			'items_list'            => __( 'Sliders list', 'itslides' ),
			'items_list_navigation' => __( 'Sliders list navigation', 'itslides' ),
			'filter_items_list'     => __( 'Filter Sliders list', 'itslides' ),
		);
		$args = array(
			'label'                 => __( 'Slider', 'itslides' ),
			'description'           => __( 'Make it slide: Create a new slider.', 'itslides' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'metaboxes' ),
			'hierarchical'          => false,
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => 'themes.php',
			'menu_position'         => 60,
			'menu_icon'             => 'dashicons-slides',
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'itslider', $args );
	}
}
endif; // End Check Class Exists
