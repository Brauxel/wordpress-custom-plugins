<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://thebrauxelcode.com/
 * @since      1.0.0
 *
 * @package    Custom_Fields_For_Taxonomies
 * @subpackage Custom_Fields_For_Taxonomies/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Custom_Fields_For_Taxonomies
 * @subpackage Custom_Fields_For_Taxonomies/admin
 * @author     Stocks Digital <Aakash Bhatia> <aakash@stocksdigital.com>
 */
class Custom_Fields_For_Taxonomies_Admin {

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
		 * defined in Custom_Fields_For_Taxonomies_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Fields_For_Taxonomies_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name.'-jquery-ui', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-jquery-ui-structure', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.structure.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custom-fields-for-taxonomies-admin.css', array(), $this->version, 'all' );

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
		 * defined in Custom_Fields_For_Taxonomies_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Fields_For_Taxonomies_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name.'-jquery-ui', plugin_dir_url( __FILE__ ) . 'js/jquery-ui.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/custom-fields-for-taxonomies-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	// This function places the custom fields on the taxonomy 'Company'
	public function set_meta_fields( $term ) {
		$t_id = $term->term_id;
		$term_meta = get_option( "taxonomy_term_$t_id" );
		
		include('partials/custom-fields-for-taxonomies-admin-display.php');
	}
	
	// A callback function to save our extra taxonomy field(s)
	public function update_meta_fields( $term ) {
		global $wpdb;
		if ( isset( $_POST['related_posts'] ) ) {
			$t_id = $term;
			update_term_meta( $t_id, 'ba_related_posts', $_POST['related_posts'] ); // Specifically saves in the termmeta table with the meta_key 'ba_related_posts'
		}
	}
	
	// A callback function to update the company order if a term is deleted
	public function update_pos_collection( $term ) {
		global $wpdb;
		$t_id = $term;
		$i = 0;
		
		$pos_collection = get_option( 'pos_collection' );
		
		foreach( $pos_collection as $pc ) {
			$i++;
			if ( $pc == $t_id )
				unset($pos_collection[$i]);
		}
		
		update_term_meta( $t_id, 'pos_collection', $pos_collection ); // Specifically saves in the termmeta table with the meta_key 'pos_collection'
		
	}
	
	public function custom_fields_for_taxonomies_menu() {
		add_posts_page( 'Related Posts in Taxonomy Options', 'Re-order Companies', 'manage_options', 'custom_fields_for_taxonomies_menu', 'custom_fields_for_taxonomies_options' );
	}
	
	public function company_create( $term ) {
		$pos_collection = get_option( 'pos_collection' );
		array_unshift($pos_collection, $term);
		update_option( 'pos_collection', $pos_collection ); // Specifically saves in the termmeta table with the meta_key 'pos_collection'
	}
	
	public function company_delete( $term ) {
		$pos_collection = get_option( 'pos_collection' );
		if(($key = array_search($term, $pos_collection)) !== false) {
			unset($pos_collection[$key]);
		}
		update_option( 'pos_collection', $pos_collection ); // Specifically saves in the termmeta table with the meta_key 'pos_collection'
	}
}


// This is the function linked to custom_fields_for_taxonomies_menu()
function custom_fields_for_taxonomies_options() {
	// Check to see if current user has the required permission
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	include('partials/custom-fields-for-taxonomies-admin-menu-display.php');
}