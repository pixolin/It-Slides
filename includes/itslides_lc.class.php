<?php
/*
* Localize
*
*/

/* Quit */
defined('ABSPATH') OR exit;

if(! class_exists( 'Itslides_LC' ) ) :
class Itslides_LC {

		function load_textdomain() {
			load_plugin_textdomain( 'itslides', false, plugin_basename( dirname( __FILE__ ) ).'/languages' );
		}

}
endif;
