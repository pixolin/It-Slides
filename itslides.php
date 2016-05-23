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
*Unslider.js*, Version 2.0 by @idiot and friends, WTFPL (http://www.wtfpl.net/)
*Repeatable Metabox Fields*, Helen Hou-Sandí https://gist.github.com/helen/1593065
*New Media Image Uploader*, Thomas Griffin, hhttps://github.com/thomasgriffin/New-Media-Image-Uploader

Thank you for providing your code to the public.
*/

/* Quit */
defined('ABSPATH') OR exit;

/* Konstanten */
define('ITSLIDES_FILE', __FILE__);
define('ITSLIDES_DIR', dirname(__FILE__));
define('ITSLIDES_BASE', plugin_basename(__FILE__));

/* Require files */
$classes = array( 'Itslides_CPT', 'Itslides_ES', 'Itslides_MB', 'Itslides_LC', 'Itslides_SC');

foreach ($classes as $class) {
	require_once(
		sprintf(
			'%s/includes/%s.class.php',
			ITSLIDES_DIR,
			strtolower( $class )
		)
	);
}

if(! class_exists( 'Itslides' ) ) :
	class Itslides {
		public function __construct() {
			$cpt = new Itslides_CPT;
			$es = new Itslides_ES;
			$mb = new Itslides_MB;
			$sc = new Itslides_SC;
			$lc = new Itslides_LC;

			/* Hooks */
			add_action( 'init', array( $cpt , 'create_post_type') );

			add_action( 'add_meta_boxes', array( $mb, 'metabox' ) );
			add_action( 'save_post', array( $mb, 'save' ) );
			add_action( 'wp_enqueue_scripts', array( $es, 'enqueue_js' ) );

			add_action( 'plugins_loaded', array( $lc, 'load_textdomain' ) );

			add_action('admin_enqueue_scripts', array( $es, 'admin_scripts' ) );
			add_action('admin_print_styles', array( $es, 'admin_styles' ) );

		}
	}
endif;

$itslides = new Itslides();


// register_activation_hook( __FILE__, 'itslides_options' );

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
