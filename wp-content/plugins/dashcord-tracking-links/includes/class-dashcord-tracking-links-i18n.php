<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://thebrauxelcode.com/
 * @since      1.0.0
 *
 * @package    Dashcord_Tracking_Links
 * @subpackage Dashcord_Tracking_Links/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Dashcord_Tracking_Links
 * @subpackage Dashcord_Tracking_Links/includes
 * @author     Stocks Digital <Aakash Bhatia> <akash.bhatia1184@gmail.com>
 */
class Dashcord_Tracking_Links_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'dashcord-tracking-links',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
