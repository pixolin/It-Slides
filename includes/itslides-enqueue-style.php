<?php
/*
* Enqueue Style
*
*/

if ( ! function_exists( 'itslides_enqueue_style' ) ) {
	function itslides_enqueue_style( $plugin_version ) {
		//automatically fetch version number
		$file_data = get_file_data( __FILE__, array( 'version' => 'Version' ) );

		wp_register_style(
		  $handle = 'unslider-style',
			$src = plugins_url( "../css/dist/unslider.css", __FILE__ ),
			$deps = false,
			$ver = $file_data['version'],
			$media = 'all'
		);

		wp_enqueue_style(
			$handle = 'unslider-style'
		);

		wp_register_style(
			$handle = 'unslider-dots',
			$src = plugins_url( "../css/dist/unslider-dots.css", __FILE__ ),
			$deps = array( 'unslider-style' ),
			$ver = $file_data['version'],
			$media = 'all'
		);

		wp_enqueue_style(
			$handle = 'unslider-dots'
		);


	}
}
