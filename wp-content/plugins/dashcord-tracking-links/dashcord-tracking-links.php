<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://stocksdigital.com/
 * @since             1.0.0
 * @package           Dashcord_Tracking_Links
 *
 * @wordpress-plugin
 * Plugin Name:       Dashcord Tracking for WP
 * Plugin URI:        http://stocksdigital.com/
 * Description:       This plugin automatically inserts a dashcord tracking tags on the post based on a pre-populated list
 * Version:           1.0.0
 * Author:            Stocks Digital <Aakash Bhatia>
 * Author URI:        http://stocksdigital.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dashcord-tracking-links
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dashcord-tracking-links-activator.php
 */
function activate_dashcord_tracking_links() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dashcord-tracking-links-activator.php';
	Dashcord_Tracking_Links_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dashcord-tracking-links-deactivator.php
 */
function deactivate_dashcord_tracking_links() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dashcord-tracking-links-deactivator.php';
	Dashcord_Tracking_Links_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dashcord_tracking_links' );
register_deactivation_hook( __FILE__, 'deactivate_dashcord_tracking_links' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dashcord-tracking-links.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dashcord_tracking_links() {

	$plugin = new Dashcord_Tracking_Links();
	$plugin->run();	
}
run_dashcord_tracking_links();
