<?php
/*
* Enqueue JavaScript
*
*/

if ( ! function_exists( 'itslides_enqueue_js' ) ) {
	function itslides_enqueue_js( $plugin_version ) {
		//automatically fetch version number
		$file_data = get_file_data( __FILE__, array( 'version' => 'Version' ) );
		//use minified JavaScript, if not in DEBUG mode
		$maybe_min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '-min';

		//register the script
		wp_register_script(
			$handle = 'unslider',
			$src = plugins_url( "../js/unslider$maybe_min.js", __FILE__ ),
			$deps = array( 'jquery' ),
			$ver = $file_data['version'],
			$in_footer = true
		);

		wp_enqueue_script(
			$handle = 'unslider'
		);

		wp_register_script(
			$handle = 'itslides',
			$src = plugins_url( "../js/itslides$maybe_min.js", __FILE__ ),
			$deps = array( 'unslider' ),
			$ver = $file_data['version'],
			$in_footer = true
		);

		wp_enqueue_script(
			$handle = 'itslides'
		);


	}
}
