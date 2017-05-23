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
 * @package           Related_Posts_Plus
 *
 * @wordpress-plugin
 * Plugin Name:       Related Posts ++
 * Plugin URI:        http://stocksdigital.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Aakash Bhatia
 * Author URI:        http://thebrauxelcode.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       related-posts-plus
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-related-posts-plus-activator.php
 */
function activate_related_posts_plus() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-related-posts-plus-activator.php';
	Related_Posts_Plus_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-related-posts-plus-deactivator.php
 */
function deactivate_related_posts_plus() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-related-posts-plus-deactivator.php';
	Related_Posts_Plus_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_related_posts_plus' );
register_deactivation_hook( __FILE__, 'deactivate_related_posts_plus' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-related-posts-plus.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_related_posts_plus() {

	$plugin = new Related_Posts_Plus();
	$plugin->run();

}
run_related_posts_plus();
