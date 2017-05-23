<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://thebrauxelcode.com/
 * @since             1.0.0
 * @package           Custom_Fields_For_Taxonomies
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Fields For Taxonomies
 * Plugin URI:        http://stocksdigital.com/
 * Description:       This plugin adds custom built related posts (pertaining to the specific term) to the taxonomy 'Company'
 * Version:           1.0.0
 * Author:            Stocks Digital <Aakash Bhatia>
 * Author URI:        http://thebrauxelcode.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       custom-fields-for-taxonomies
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-custom-fields-for-taxonomies-activator.php
 */
function activate_custom_fields_for_taxonomies() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-fields-for-taxonomies-activator.php';
	Custom_Fields_For_Taxonomies_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-custom-fields-for-taxonomies-deactivator.php
 */
function deactivate_custom_fields_for_taxonomies() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-fields-for-taxonomies-deactivator.php';
	Custom_Fields_For_Taxonomies_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_custom_fields_for_taxonomies' );
register_deactivation_hook( __FILE__, 'deactivate_custom_fields_for_taxonomies' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-custom-fields-for-taxonomies.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_custom_fields_for_taxonomies() {

	$plugin = new Custom_Fields_For_Taxonomies();
	$plugin->run();

}
run_custom_fields_for_taxonomies();
