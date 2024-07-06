<?php
/**
 * Plugin Name:       uniweb for WP
 * Plugin URI:        https://wordpress.org/plugins/uniweb-for-wp
 * Description:       By using this plugin and service, you can create an accessible WordPress site without doing anything.
 * Version:           1.0.0
 * Author:            Shohei Tanaka
 * Author URI:        https://ssec.shop//
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       uniweb-for-wp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'UNIWEB_FOR_WP_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-uniweb-for-wp-activator.php
 */
function uniweb_for_wp_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-uniweb-for-wp-activator.php';
	Uniweb_For_Wp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-uniweb-for-wp-deactivator.php
 */
function uniweb_for_wp_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-uniweb-for-wp-deactivator.php';
	Uniweb_For_Wp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'uniweb_for_wp_activate' );
register_deactivation_hook( __FILE__, 'uniweb_for_wp_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-uniweb-for-wp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function uniweb_for_wp_run() {

	$plugin = new Uniweb_For_Wp();
	$plugin->run();

}
uniweb_for_wp_run();
