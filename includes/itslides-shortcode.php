<?php
/*
 * Adds Shortcode [itslides]
 */
class ItslidesSC {
	function __construct() {
		add_shortcode( 'itslides', array( $this, 'shortcode') );
	}
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
