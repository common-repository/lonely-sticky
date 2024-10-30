<?php if ( ! defined( 'LONELY_STICKY' ) ) die( 'Forbidden' );

/* Plugin helper functions. */
require_once trailingslashit( dirname( __FILE__ ) ) . 'helpers.php';

/* Plugin installation. */
require_once trailingslashit( dirname( __FILE__ ) ) . 'install.php';

/* Settings page. */
require_once LONELY_STICKY_FOLDER . 'settings/class-settings-page.php';

( new LonelySticky_Settings_Page( 'lonely-sticky', array(
	'sections' => array(
		'general' => array(
			'label' => __( 'General settings', 'lonely-sticky' ),
			'fields' => array(
				'lonely_sticky_num' => array(
					'type'     => 'number',
					'label'    => __( 'Number of sticky posts', 'lonely-sticky' ),
					'sanitize' => 'absint',
					'help'     => array(
						__( 'Defines the maximum number of sticky posts that should be present at once.', 'lonely-sticky' ),
						__( 'Set to <code>0</code> to completely disable sticky posts.', 'lonely-sticky' )
					),
					'after' => __( 'posts', 'lonely-sticky' )
				),
			)
		)
	)
) ) );

/**
 * Setup the plugin.
 *
 * @since 1.2
 */
function lonely_sticky_setup() {
	/* Make the plugin available for translation. */
	load_plugin_textdomain( 'lonely-sticky', false, dirname( plugin_basename( LONELY_STICKY_MAIN_FILE ) ) . '/languages/' );
}

add_action( 'init', 'lonely_sticky_setup' );

/**
 * Enqueue the plugin admin assets.
 *
 * @since 1.0.0
 */
function lonely_sticky_enqueue_admin_assets() {
	/* Admin stylesheet. */
	wp_enqueue_style( 'lonely_sticky-admin-style', LONELY_STICKY_ASSETS_URI . 'css/backend.css' );

	/* Admin script. */
	wp_enqueue_script( 'lonely_sticky-admin-script', LONELY_STICKY_ASSETS_URI . 'js/backend/script.js', array( 'jquery' ), LONELY_STICKY_VERSION, true );
}

add_action( 'admin_enqueue_scripts', 'lonely_sticky_enqueue_admin_assets' );
