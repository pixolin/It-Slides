<?php
/*
 * Adds Shortcode [itslides]
 */

 /* Quit */
 defined('ABSPATH') OR exit;

if(! class_exists( 'Itslides_SC' ) ) :
class Itslides_SC {

	function shortcode() {
		$out = '
			<div class="itslides">
				<ul>
					<li>
						<img src="http://itslides.dev/wp-content/uploads/2016/05/blume1.jpeg" alt="" />
					</li>
					<li>
						<img src="http://itslides.dev/wp-content/uploads/2016/05/blume2.jpeg" alt="" />
					</li>
				</ul>
			</div>';
		return $out;
	}
}

endif; // End Check Class Exists
