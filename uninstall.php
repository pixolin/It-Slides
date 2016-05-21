<?php
/*
 * Uninstall routine to delete the options
 */

// If uninstall isn't called from WordPress, exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

delete_option( 'itslides' );

// Thank you for using my plugin. <3
