<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @link       https://ssec.shop/
 * @since      1.0.0
 *
 * @package    Uniweb_For_Wp
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
delete_option( 'uniweb-code' );