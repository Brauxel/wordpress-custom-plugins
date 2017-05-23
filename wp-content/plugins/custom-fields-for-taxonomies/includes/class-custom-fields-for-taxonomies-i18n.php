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
 * @package    Custom_Fields_For_Taxonomies
 * @subpackage Custom_Fields_For_Taxonomies/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Custom_Fields_For_Taxonomies
 * @subpackage Custom_Fields_For_Taxonomies/includes
 * @author     Stocks Digital <Aakash Bhatia> <aakash@stocksdigital.com>
 */
class Custom_Fields_For_Taxonomies_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'custom-fields-for-taxonomies',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
