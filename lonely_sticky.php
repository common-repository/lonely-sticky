<?php if ( ! defined( 'ABSPATH' ) ) die( 'Forbidden' );

/**
 * Plugin Name: Lonely Sticky
 * Description: Allow only one (or more) sticky post(s) at a time.
 * Version: 1.2
 * Author: Evolve
 * Author URI: https://justevolve.it
 * License: GPL2
 * Text Domain: lonely-sticky
 *
 * Lonely Sticky is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Lonely Sticky is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA.
 *
 * @package   Lonely Sticky
 * @version   1.2
 * @author 	  Evolve <evolvesnc@gmail.com>
 * @copyright Copyright (c) 2018, Evolve Snc
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Bootstrap the plugin.
 *
 * @since 1.0.0
 */
function lonely_sticky_load() {
	/* Main plugin constant. */
	define( 'LONELY_STICKY', true );

	/* Plugin version. */
	define( 'LONELY_STICKY_VERSION', '1.2' );

	/* Plugin main file. */
	define( 'LONELY_STICKY_MAIN_FILE', __FILE__ );

	/* Plugin folder. */
	define( 'LONELY_STICKY_FOLDER', trailingslashit( dirname( __FILE__ ) ) );

	/* Plugin URI. */
	define( 'LONELY_STICKY_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

	/* Plugin assets URI. */
	define( 'LONELY_STICKY_ASSETS_URI', trailingslashit( LONELY_STICKY_URI . 'assets' ) );

	/* Plugin configuration. */
	require_once trailingslashit( dirname( __FILE__ ) ) . 'config/config.php';
}

add_action( 'plugins_loaded', 'lonely_sticky_load' );
