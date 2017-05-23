<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://thebrauxelcode.com/
 * @since      1.0.0
 *
 * @package    Related_Posts_Sd
 * @subpackage Related_Posts_Sd/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Related_Posts_Sd
 * @subpackage Related_Posts_Sd/includes
 * @author     Aakash Bhatia <akash.bhatia1184@gmail.com>
 */
class Related_Posts_Sd_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		delete_post_meta_by_key( '_my_related_posts' );
	}

}
