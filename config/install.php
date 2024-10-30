<?php if ( ! defined( 'LONELY_STICKY' ) ) die( 'Forbidden' );

/**
 * Clean up when deactivating the plugin.
 *
 * @since 1.1.0
 */
function lonely_sticky_deactivation() {
	delete_option( 'lonely_sticky_num' );
}

register_deactivation_hook( LONELY_STICKY_MAIN_FILE, 'lonely_sticky_deactivation' );

/**
 * Operations performed at the uninstall of the plugin.
 *
 * @since 1.0.0
 */
function lonely_sticky_uninstall( $plugin ) {
	delete_option( 'lonely_sticky_num' );
}

register_uninstall_hook( LONELY_STICKY_MAIN_FILE, 'lonely_sticky_uninstall' );
