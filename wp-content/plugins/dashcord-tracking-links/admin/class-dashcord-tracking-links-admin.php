<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://stocksdigital.com/
 * @since      1.0.0
 *
 * @package    Dashcord_Tracking_Links
 * @subpackage Dashcord_Tracking_Links/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Dashcord_Tracking_Links
 * @subpackage Dashcord_Tracking_Links/admin
 * @author     Stocks Digital <Aakash Bhatia> <akash.bhatia1184@gmail.com>
 */

class Dashcord_Tracking_Links_Admin {
	

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		// If admin then continue with the plugin else exit the function			
		if ( !is_admin() )
			return;
			
		// Hooks for the plots
		add_action( 'admin_menu', 'dashcord_tracking_links_menu' );
		
		$this->construct_table();
	}
	
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dashcord_Tracking_Links_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dashcord_Tracking_Links_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dashcord-tracking-links-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dashcord_Tracking_Links_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dashcord_Tracking_Links_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dashcord-tracking-links-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	// This private function is initially called to create a table (wp_trackers) that stores our trackers
	private function construct_table() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		
		$table_name = 'wp_trackers';
		
		$sql = "CREATE TABLE $table_name (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  name tinytext NOT NULL,
		  slug tinytext NOT NULL,
		  description text,
		  UNIQUE KEY id (id)
		) $charset_collate;";
		
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );		
	}
	
	// This function updates the table 'wp_trackers' with the unique ID, title, and slug of the tracker (from admin\partials\dashcord-tracking-links-admin-display)
	public function add_rows($leadField, $slug, $description) {
		global $wpdb;
		
		if ( empty($description) ) {
			$description = NULL;
		}
		
		// Auto Gernerate Slug if not entered
		if ( empty($slug) ) {
			$slug = $leadField; // Copy lead field to slug to edit
			$slug = preg_replace('~[^\\pL\d]+~u', '-', $slug); // replace non letter or digits by -
			$slug = trim($slug, '-'); // trim
			$slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug); // transliterate
			$slug = strtolower($slug); // lowercase
			$slug = preg_replace('~[^-\w]+~', '', $slug); // remove unwanted characters
		}
		
		// wpdb insert's a new row into the table 'wp_trackers' with a unique ID
		$wpdb->insert(
			'wp_trackers', 
			array(
				'name' => $leadField, 
				'slug' => $slug,
				'description' => $description
			),
			array(
				'%s',
				'%s',
				'%s'
			)
		);
	}
	
	public function pull_rows($id) {
		global $wpdb;
		
		if ( empty($id) ) {
			$rows = $wpdb->get_results( 'SELECT * FROM wp_trackers' );
		} else {
			//$rows = $wpdb->get_row( "SELECT * FROM wp_trackers WHERE id = %d", $id);
			$rows = $wpdb->get_row( $wpdb->prepare("SELECT * FROM wp_trackers WHERE id=%s", $id));
		}
		
		return $rows;
	}
	
	public function update_rows($id, $leadField, $slug, $description) {
		global $wpdb;
		
		$wpdb->update( 
			'wp_trackers', 
			array(
				'name' => $leadField,
				'slug' => $slug,
				'description' => $description
			), 
			array( 'ID' => $id ),
			array( 
				'%s', // 'name' is a string
				'%s', // 'slug' is a string
				'%s' // 'description' is a string
			),
			array( '%d' )
		);
	}
	
	public function delete_rows($id) {
		global $wpdb;
		
		$wpdb->delete( 'wp_trackers', array( 'id' => $id ) );
	}
}

function dashcord_tracking_links_menu() {
	add_options_page( 'Dashcord Tracking Links Options', 'Dashcord Tracking for WP', 'manage_options', 'dashcord-tracking-links-menu', 'dashcord_tracking_links_options' );
}
	
function dashcord_tracking_links_options() {
		// Check to see if current user has the required permission
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		
		include('partials/dashcord-tracking-links-admin-display.php');
}