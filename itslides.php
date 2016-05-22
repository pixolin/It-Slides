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

defined( 'ABSPATH' ) or die( 'Direct access is not allowed.' );

// store plugin path
$itslides_plugin_path = plugin_dir_path( __FILE__ );
// store plugin basename
$itslides_plugin_base = plugin_basename( __FILE__ );


// Create Custom Post Type itslider
require_once $itslides_plugin_path .'/includes/itslides-cpt.php';
$cpt = new ItslidesCPT();
add_action( 'init', array( $cpt, 'create_post_type') );

// Create Metabox to select slides
require_once $itslides_plugin_path .'/includes/itslides-metabox.php';
$mb = new ItslidesMB();
add_action( 'add_meta_boxes', array( $mb, 'metabox' ) );
add_action( 'save_post', array( $mb, 'save' ) );

// Register and enqueue JavaScript
require_once $itslides_plugin_path .'/includes/itslides-enqueue-scripts.php';
add_action( 'wp_enqueue_scripts', 'itslides_enqueue_js' );

// Register and enqueue JavaScript
require_once $itslides_plugin_path .'/includes/itslides-enqueue-style.php';
add_action( 'wp_enqueue_scripts', 'itslides_enqueue_style' );

// Add Shortcode
require_once $itslides_plugin_path .'/includes/itslides-shortcode.php';
$sc = new ItslidesSC();


/*
Use later for options …
if ( is_admin() ) {
	require_once $itslides_plugin_path .'/settings/sta-settings.php'; // Plugin Settings
	require_once $itslides_plugin_path .'/admin/sta-tinymce-button.php'; // TinyMCE Button
};
 */

/*
// Some basic settings upon plugin activation
register_activation_hook( __FILE__, 'itslides_initial_options' );

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
add_action( 'plugins_loaded', 'itslides_load_textdomain' );

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
if (isset($_GET['post']) ) {
	add_action('admin_print_scripts', 'admin_scripts');
	add_action('admin_print_styles', 'admin_styles');
}
