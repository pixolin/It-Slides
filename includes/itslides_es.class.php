<?php
/*
* Enqueue JavaScript
*
*/

/* Quit */
defined('ABSPATH') OR exit;

if(! class_exists( 'Itslides_ES' ) ) :
class Itslides_ES {

	function enqueue_js( $plugin_version ) {
		//automatically fetch version number
		$file_data = get_file_data( __FILE__, array( 'version' => 'Version' ) );
		//use minified JavaScript, if not in DEBUG mode
		$maybe_min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '-min';

		wp_register_script(
			$handle = 'unslider',
			$src = plugins_url( "../js/unslider$maybe_min.js", __FILE__ ),
			$deps = array( 'jquery' ),
			$ver = $file_data['version'],
			$in_footer = true
		);

		wp_register_script(
			$handle = 'itslides',
			$src = plugins_url( "../js/itslides$maybe_min.js", __FILE__ ),
			$deps = array( 'unslider' ),
			$ver = $file_data['version'],
			$in_footer = true
		);

		wp_register_style(
			$handle = 'unslider-style',
			$src = plugins_url( "../css/dist/unslider.css", __FILE__ ),
			$deps = false,
			$ver = $file_data['version'],
			$media = 'all'
		);

		wp_register_style(
			$handle = 'unslider-dots',
			$src = plugins_url( "../css/dist/unslider-dots.css", __FILE__ ),
			$deps = array( 'unslider-style' ),
			$ver = $file_data['version'],
			$media = 'all'
		);

		wp_enqueue_script( 'unslider' );
		wp_enqueue_script( 'itslides'	);
		wp_enqueue_style( 'unslider-style' );
		wp_enqueue_style( 'unslider-dots' );

	}

	function admin_scripts() {
		wp_enqueue_media();
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}
	function admin_styles() {
		wp_enqueue_style('thickbox');
	}
}
endif; // End Check Class Exists
