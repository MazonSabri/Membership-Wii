<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mostaql.com/u/mazonsabri
 * @since             1.0.0
 * @package           Membership_Wii
 *
 * @wordpress-plugin
 * Plugin Name:       Membership Wii
 * Plugin URI:        https://mostaql.com/u/mazonsabri
 * Description:       Membership Wii plugin from mazen sabri.
 * Version:           1.0.0
 * Author:            Mazen Sabri
 * Author URI:        https://mostaql.com/u/mazonsabri
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       membership-wii
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
define( 'MEMBERSHIP_WII_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-membership-wii-activator.php
 */
function activate_membership_wii() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-membership-wii-activator.php';
	Membership_Wii_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-membership-wii-deactivator.php
 */
function deactivate_membership_wii() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-membership-wii-deactivator.php';
	Membership_Wii_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_membership_wii' );
register_deactivation_hook( __FILE__, 'deactivate_membership_wii' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-membership-wii.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_membership_wii() {

	$plugin = new Membership_Wii();
	$plugin->run();

}
run_membership_wii();
