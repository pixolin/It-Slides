<?php
/*
Plugin Name:  It Slides!
Version:      0.1
Plugin URI:   https://github.com/pixolin/https://github.com/pixolin/It-Slides
Description:  Yet another slider. Does what you expect: it slides.
Author:       Bego Mario Garde
Author URI:   https://pixolin.de
License:      GPLv2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Domain Path:  /languages
Text Domain:  itslides

(c) Bego Mario Garde, 2016
It Slides! is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

It Slides! is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Scroll to Anchor. If not, see https://www.gnu.org/licenses/gpl-2.0.html.

Credits:
This plugin is based on Unslider, Version 2.0 by @idiot and friends
which has been published under the WTFPL (http://www.wtfpl.net/)
Repeatable Metabox Fields are based on a Gist by Helen Hou-Sandí
https://gist.github.com/helen/1593065, GPLv2

Thank you for providing your code to the public.
*/

/* Quit */
defined('ABSPATH') OR exit;

/* Konstanten */
define('ITSLIDES_FILE', __FILE__);
define('ITSLIDES_DIR', dirname(__FILE__));
define('ITSLIDES_BASE', plugin_basename(__FILE__));

/* Hooks */
add_action( 'init', array( 'Itslides_CPT', 'create_post_type') );

add_action( 'add_meta_boxes', array( 'Itslides_MB', 'metabox' ) );
add_action( 'save_post', array( 'Itslides_MB', 'save' ) );
add_action( 'wp_enqueue_scripts', array( 'Itslides_ES', 'enqueue_js' ) );

add_action( 'plugins_loaded', 'itslides_load_textdomain' );
add_action('admin_print_scripts', 'admin_scripts');
add_action('admin_print_styles', 'admin_styles');

// register_activation_hook( __FILE__, 'itslides_options' );

/* Autoload Init */
spl_autoload_register( 'itslides_autoload' );

/* Autoload Funktion */
function itslides_autoload( $class ) {
	if ( in_array( $class, array( 'Itslides_CPT', 'Itslides_ES', 'Itslides_MB', 'Itslides_SC') ) ) {
		require_once(
			sprintf(
				'%s/includes/%s.class.php',
				ITSLIDES_DIR,
				strtolower( $class )
			)
		);
	}
}

/*
Use later for options …
if ( is_admin() ) {
	require_once $itslides_plugin_path .'/settings/sta-settings.php'; // Plugin Settings
	require_once $itslides_plugin_path .'/admin/sta-tinymce-button.php'; // TinyMCE Button
};
 */

/*
// Some basic settings upon plugin activation

if ( ! function_exists( 'itslides_initial_options' ) ) {
	function itslides_initial_options() {
		//check if option is already present
		if ( ! get_option( 'itslides' ) ) {
			//not present, so add
			$op = array(
				'speed'    => 5000,
				'distance' => 50,
				'label'    => 'Anchor',
			);
			add_option( 'itslides', $op );
		}
	}
}
*/


//Localize
if ( ! function_exists( 'itslides_load_textdomain' ) ) {
	function itslides_load_textdomain() {
		load_plugin_textdomain( 'itslides', false, plugin_basename( dirname( __FILE__ ) ).'/languages' );
	}
}

function admin_scripts() {
   wp_enqueue_script('media-upload');
   wp_enqueue_script('thickbox');
}
function admin_styles() {
   wp_enqueue_style('thickbox');
}
